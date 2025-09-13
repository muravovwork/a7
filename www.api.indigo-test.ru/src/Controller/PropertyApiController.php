<?php
// src/Controller/PropertyApiController.php

namespace App\Controller;

use App\Entity\Property;
use App\Repository\PropertyRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

#[Route('/api/properties')]
class PropertyApiController extends AbstractController
{
    public function __construct(
        private PropertyRepository $repository,
        private SerializerInterface $serializer
    ) {}

    #[Route('', name: 'api_properties_list', methods: ['GET'])]
    public function list(Request $request): JsonResponse
    {
        $page = max(1, (int) $request->query->get('page', 1));
        $limit = max(1, min(50, (int) $request->query->get('limit', 12)));
        $type = $request->query->get('type');
        $category = $request->query->get('category');
        $city = $request->query->get('city');

        $result = $this->repository->findActiveProperties($page, $limit, $type, $category, $city);

        $data = $this->serializer->serialize($result['items'], 'json', [
            'groups' => 'property:read'
        ]);

        return new JsonResponse([
            'success' => true,
            'data' => json_decode($data, true),
            'pagination' => [
                'current_page' => $result['page'],
                'per_page' => $result['limit'],
                'total_items' => $result['total'],
                'total_pages' => $result['totalPages']
            ],
            'filters' => [
                'type' => $type,
                'category' => $category,
                'city' => $city
            ]
        ], Response::HTTP_OK);
    }

    #[Route('/{id}', name: 'api_property_show', methods: ['GET'])]
    public function show(int $id): JsonResponse
    {
        $property = $this->repository->find($id);

        if (!$property) {
            return new JsonResponse([
                'success' => false,
                'error' => 'Объект недвижимости не найден'
            ], Response::HTTP_NOT_FOUND);
        }

        if (!$property->isActive()) {
            return new JsonResponse([
                'success' => false,
                'error' => 'Объект недвижимости не активен'
            ], Response::HTTP_NOT_FOUND);
        }

        $data = $this->serializer->serialize($property, 'json', [
            'groups' => 'property:read'
        ]);

        return new JsonResponse([
            'success' => true,
            'data' => json_decode($data, true)
        ], Response::HTTP_OK);
    }
}