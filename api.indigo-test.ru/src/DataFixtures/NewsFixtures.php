<?php
// src/DataFixtures/NewsFixtures.php

namespace App\DataFixtures;

use App\Entity\News;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class NewsFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $newsItems = [
            [
                'title' => 'Открытие нового жилого комплекса',
                'description' => 'Мы рады сообщить об открытии нового современного жилого комплекса "Эко-Парк" в центре города. Комплекс предлагает квартиры улучшенной планировки с современной отделкой.',
                'imageUrl' => '/images/news/eco-park.jpg'
            ],
            [
                'title' => 'Скидки на коммерческую недвижимость',
                'description' => 'Специальное предложение: скидка 15% на коммерческие помещения в бизнес-центре "Старт". Предложение действует до конца месяца.',
                'imageUrl' => '/images/news/discount.jpg'
            ],
            [
                'title' => 'Новые ипотечные программы',
                'description' => 'Банки-партнеры предлагают новые выгодные ипотечные программы с пониженной процентной ставкой от 7% годовых.',
                'imageUrl' => '/images/news/mortgage.jpg'
            ],
            [
                'title' => 'Завершение строительства ЖК "Солнечный"',
                'description' => 'Строительство жилого комплекса "Солнечный" завершено. Начинается процесс сдачи объектов в эксплуатацию.',
                'imageUrl' => '/images/news/sunny-complex.jpg'
            ],
            [
                'title' => 'Семинар для инвесторов',
                'description' => 'Приглашаем на семинар "Инвестиции в недвижимость: новые возможности". Мероприятие пройдет 15 числа в конференц-зале.',
                'imageUrl' => '/images/news/seminar.jpg'
            ]
        ];

        foreach ($newsItems as $newsData) {
            $news = new News();
            $news->setTitle($newsData['title']);
            $news->setDescription($newsData['description']);
            $news->setImageUrl($newsData['imageUrl']);
            $news->setIsPublished(true);

            $manager->persist($news);
        }

        $manager->flush();
    }
}