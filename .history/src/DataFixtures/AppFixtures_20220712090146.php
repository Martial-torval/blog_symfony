<?php

namespace App\DataFixtures;

use App\Entity\Category;
use TaskFactory;
use App\Entity\Post;
use App\Factory\CategoryFactory;
use DateTimeImmutable;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Factory\PostFactory;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {   
       $category1 = new Category;
       $category1->setNameCategory('Sport');

       $category2 = new Category;
       $category2->setNameCategory('Habits');
       CategoryFactory::createMany(5);

        PostFactory::createMany(5);
    }
}
