<?php
// src/Controller/NewsApiController.php

namespace App\Controller;

use App\Entity\News;
use App\Repository\NewsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

#[Route('/api/news')]
class NewsApiController extends AbstractController
{
    public function __construct(
        private NewsRepository $repository,
        private SerializerInterface $serializer
    ) {}

    #[Route('', name: 'api_news_list', methods: ['GET'])]
    public function list(Request $request): JsonResponse
    {
        $page = max(1, (int) $request->query->get('page', 1));
        $limit = max(1, min(50, (int) $request->query->get('limit', 10)));
        $search = $request->query->get('search');

        try {
            if ($search) {
                $result = $this->repository->searchNews($search, $page, $limit);
            } else {
                $result = $this->repository->findPublishedNews($page, $limit);
            }

            $data = $this->serializer->serialize($result['items'], 'json', [
                'groups' => 'news:read'
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
                'search' => $search ? [
                    'query' => $search,
                    'results_count' => $result['total']
                ] : null
            ], Response::HTTP_OK);

        } catch (\Exception $e) {
            return new JsonResponse([
                'success' => false,
                'error' => 'Ошибка при загрузке новостей',
                'message' => $e->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    #[Route('/{id}', name: 'api_news_show', methods: ['GET'])]
    public function show(int $id): JsonResponse
    {
        try {
            $news = $this->repository->find($id);

            if (!$news) {
                return new JsonResponse([
                    'success' => false,
                    'error' => 'Новость не найдена'
                ], Response::HTTP_NOT_FOUND);
            }

            if (!$news->isPublished()) {
                return new JsonResponse([
                    'success' => false,
                    'error' => 'Новость не опубликована'
                ], Response::HTTP_NOT_FOUND);
            }

            $data = $this->serializer->serialize($news, 'json', [
                'groups' => 'news:read'
            ]);

            return new JsonResponse([
                'success' => true,
                'data' => json_decode($data, true)
            ], Response::HTTP_OK);

        } catch (\Exception $e) {
            return new JsonResponse([
                'success' => false,
                'error' => 'Ошибка при загрузке новости',
                'message' => $e->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    #[Route('/latest', name: 'api_news_latest', methods: ['GET'])]
    public function latest(Request $request): JsonResponse
    {
        $limit = max(1, min(10, (int) $request->query->get('limit', 5)));

        try {
            $news = $this->repository->findBy(
                ['isPublished' => true],
                ['createdAt' => 'DESC'],
                $limit
            );

            $data = $this->serializer->serialize($news, 'json', [
                'groups' => 'news:read'
            ]);

            return new JsonResponse([
                'success' => true,
                'data' => json_decode($data, true),
                'meta' => [
                    'count' => count($news),
                    'limit' => $limit
                ]
            ], Response::HTTP_OK);

        } catch (\Exception $e) {
            return new JsonResponse([
                'success' => false,
                'error' => 'Ошибка при загрузке последних новостей'
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}