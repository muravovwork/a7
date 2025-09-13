<?php
// src/DataFixtures/PropertyFixtures.php

namespace App\DataFixtures;

use App\Entity\Property;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class PropertyFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $properties = [
            [
                'title' => '3-комнатная квартира в новом доме',
                'description' => 'Просторная 3-комнатная квартира с современным ремонтом в новом жилом комплексе. Панорамные окна, вид на город.',
                'price' => '12500000',
                'area' => 85.5,
                'address' => 'ул. Ленина, 15',
                'city' => 'Москва',
                'district' => 'Центральный',
                'type' => 'apartment',
                'category' => 'sale',
                'rooms' => 3,
                'floor' => 12,
                'totalFloors' => 25,
                'amenities' => ['парковка', 'кондиционер', 'интернет', 'охрана'],
                'images' => ['/images/property1-1.jpg', '/images/property1-2.jpg']
            ],
            [
                'title' => 'Офис в бизнес-центре класса А',
                'description' => 'Современный офис площадью 120 м² в престижном бизнес-центре. Готовый ремонт, мебель, техника.',
                'price' => '250000',
                'area' => 120.0,
                'address' => 'пр. Мира, 45',
                'city' => 'Санкт-Петербург',
                'district' => 'Невский',
                'type' => 'commercial',
                'category' => 'rent',
                'amenities' => ['конференц-зал', 'ресепшен', 'кухня', 'парковка'],
                'images' => ['/images/property2-1.jpg', '/images/property2-2.jpg']
            ],
            [
                'title' => 'Загородный дом с участком',
                'description' => 'Уютный загородный дом площадью 150 м² на участке 10 соток. Камин, баня, гараж.',
                'price' => '18500000',
                'area' => 150.0,
                'address' => 'д. Подмосковная, 23',
                'city' => 'Московская область',
                'type' => 'house',
                'category' => 'sale',
                'rooms' => 5,
                'amenities' => ['гараж', 'баня', 'камин', 'участок'],
                'images' => ['/images/property3-1.jpg', '/images/property3-2.jpg']
            ]
        ];

        foreach ($properties as $propertyData) {
            $property = new Property();
            $property->setTitle($propertyData['title']);
            $property->setDescription($propertyData['description']);
            $property->setPrice($propertyData['price']);
            $property->setArea($propertyData['area']);
            $property->setAddress($propertyData['address']);
            $property->setCity($propertyData['city']);
            $property->setDistrict($propertyData['district'] ?? null);
            $property->setType($propertyData['type']);
            $property->setCategory($propertyData['category']);
            $property->setRooms($propertyData['rooms'] ?? null);
            $property->setFloor($propertyData['floor'] ?? null);
            $property->setTotalFloors($propertyData['totalFloors'] ?? null);
            $property->setAmenities($propertyData['amenities']);
            $property->setImages($propertyData['images']);
            $property->setIsActive(true);

            $manager->persist($property);
        }

        $manager->flush();
    }
}