<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class PropertyDetailsController extends AbstractController
{
    #[Route('/property-details/{id}', name: 'app_tes1t', methods: ['GET'])]
    public function test(Request $request, int $id): JsonResponse
    {
         $page = $request->query->getInt('page', 1);
        $limit = $request->query->getInt('limit', 12);
        $offset = ($page - 1) * $limit;

        // Здесь ваша логика получения товаров из базы данных
        $products = $this->getProductsFromDatabase(1);
        $totalProducts = $this->getTotalProductsCount();

        return $this->json([
            'product' => $products,
            'currentPage' => $page,
            'totalPages' => ceil($totalProducts / $limit),
            'hasMore' => ($page * $limit) < $totalProducts,
            'total' => $totalProducts
        ]);
    }
    
    private function getProductsFromDatabase(int $id): array
    {
        // Пример данных (замените на реальные запросы к БД)
        if ($id === 1) {
             return [
        
                'id' => 1,
                'name' => 'Лот номер 1',
                'description' => 'Описание',
                'price' => 89999,
                'image' => 'https://i.postimg.cc/SJGh3Y36/img.png'
            
            ];
        }
         return [[
                'id' => 2,
                'name' => '',
                'description' => '',
                'price' => 89999,
                'image' => ''
            ]];
       
    }

    private function getTotalProductsCount(): int
    {
        // Возвращает общее количество товаров
        return 50;
    }
}