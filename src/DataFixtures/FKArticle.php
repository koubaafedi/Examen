<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class FKArticle extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker=Factory::create('fr_FR');
        for ($i=0;$i<100;$i++){
            $article = new \App\Entity\FKArticle();
            $article->setNom($faker->name);
            $article->setPrix($faker->randomNumber(3));
            $manager->persist($article);
        }

        $manager->flush();
    }
}
