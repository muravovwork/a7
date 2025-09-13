<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class StartController extends AbstractController
{
    #[Route('/start', name: 'app_test', methods: ['GET'])]
    public function test(Request $request): JsonResponse
    {
         $page = $request->query->getInt('page', 1);
        $limit = $request->query->getInt('limit', 12);
        $offset = ($page - 1) * $limit;

        // Здесь ваша логика получения товаров из базы данных
        $products = $this->getProductsFromDatabase($limit, $offset);
        $totalProducts = $this->getTotalProductsCount();

        return $this->json([
            'products' => $products,
            'currentPage' => $page,
            'totalPages' => ceil($totalProducts / $limit),
            'hasMore' => ($page * $limit) < $totalProducts,
            'total' => $totalProducts
        ]);
    }
    
    private function getProductsFromDatabase(int $limit, int $offset): array
    {
        // Пример данных (замените на реальные запросы к БД)
        return [
            [
                'id' => 1,
                'name' => 'Лот номер 1',
                'description' => 'Описание',
                'price' => 89999,
                'image' => 'https://i.postimg.cc/SJGh3Y36/img.png'
            ],
            [
                'id' => 2,
                'name' => 'Лот номер 2',
                'description' => 'Описание',
                'price' => 64999,
                'image' => 'https://i.postimg.cc/PCrjjrnB/property1-1.png'
            ],
            [
                'id' => 2,
                'name' => 'Лот номер 3',
                'description' => 'Описание',
                'price' => 1231,
                'image' => 'https://i.postimg.cc/9D8jF5Wz/property2-3.png'
            ]
            // ... больше товаров
        ];
    }

    private function getTotalProductsCount(): int
    {
        // Возвращает общее количество товаров
        return 50;
    }
}