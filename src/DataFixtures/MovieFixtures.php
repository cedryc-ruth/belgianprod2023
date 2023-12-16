<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Movie;
use Doctrine\ORM\EntityManagerInterface;

class MovieFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $data = [
            [
              'title' => 'Die Hard',
              'slug' => 'die-hard',
              'description' => 'Action movie in a tower.',
              'duration' => 120,
              'director' => 'DD',
              'category_id' => 6,
            ],
        ];

        foreach($data as $row) {
            $movie = new Movie();
            $movie->setTitle($row['title']);
            $movie->setSlug($row['slug']);
            $movie->setDescription($row['description']);
            $movie->setDuration($row['duration']);
            $movie->setDirector($row['director']);

            //Récupérer la catégorie
            /*
            $repo = $em->getRepository(Category::class);
            $category = $repo->find($row['category_id']);

            $movie->setCategory($category);
        dump($movie);die;

            /!\ Impossible d'injecter EntityManagerInterface
            => Utiliser les système de dépendance des Fixtures
            => pour obtenir une référence de la catégorie

            https://symfony.com/bundles/DoctrineFixturesBundle/current/index.html#splitting-fixtures-into-separate-files
            */

            $manager->persist($movie);
        }

        $manager->flush();
    }
}
