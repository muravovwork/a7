<?php
// src/Repository/NewsRepository.php

namespace App\Repository;

use App\Entity\News;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class NewsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, News::class);
    }

    public function findPublishedNews(int $page = 1, int $limit = 10): array
    {
        $qb = $this->createQueryBuilder('n')
            ->andWhere('n.isPublished = :published')
            ->setParameter('published', true)
            ->orderBy('n.createdAt', 'DESC');

        $query = $qb->getQuery();

        $paginator = new \Doctrine\ORM\Tools\Pagination\Paginator($query);
        $paginator->getQuery()
            ->setFirstResult(($page - 1) * $limit)
            ->setMaxResults($limit);

        return [
            'items' => iterator_to_array($paginator->getIterator()),
            'total' => count($paginator),
            'page' => $page,
            'limit' => $limit,
            'totalPages' => ceil(count($paginator) / $limit)
        ];
    }

    public function searchNews(string $query, int $page = 1, int $limit = 10): array
    {
        $qb = $this->createQueryBuilder('n')
            ->andWhere('n.isPublished = :published')
            ->setParameter('published', true)
            ->andWhere('n.title LIKE :query OR n.description LIKE :query')
            ->setParameter('query', '%' . $query . '%')
            ->orderBy('n.createdAt', 'DESC');

        $query = $qb->getQuery();

        $paginator = new \Doctrine\ORM\Tools\Pagination\Paginator($query);
        $paginator->getQuery()
            ->setFirstResult(($page - 1) * $limit)
            ->setMaxResults($limit);

        return [
            'items' => iterator_to_array($paginator->getIterator()),
            'total' => count($paginator),
            'page' => $page,
            'limit' => $limit,
            'totalPages' => ceil(count($paginator) / $limit),
            'searchQuery' => $query
        ];
    }
}