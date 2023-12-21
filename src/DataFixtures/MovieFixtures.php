<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Movie;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class MovieFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $data = [
            [
              'title' => 'Die Hard',
              'slug' => 'die-hard',
              'description' => 'Action movie in a tower.',
              'duration' => 132,
              'director' => 'John McTiernan',
              'category_ref' => 'Action',
            ],
            [
                'title' => 'Blade Runner',
                'slug' => 'blade-runner',
                'description' => 'Sci-fi noir movie.',
                'duration' => 117,
                'director' => 'Ridley Scott',
                'category_ref' => 'Science-Fiction',
              ],
        ];

        foreach($data as $row) {
            $movie = new Movie();
            $movie->setTitle($row['title']);
            $movie->setSlug($row['slug']);
            $movie->setDescription($row['description']);
            $movie->setDuration($row['duration']);
            $movie->setDirector($row['director']);

            //Récupérer la référence à la catégorie
            $movie->setCategory($this->getReference($row['category_ref']));

            $manager->persist($movie);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            CategoryFixtures::class,
        ];
    }
}
