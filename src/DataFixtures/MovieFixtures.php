<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Movie;

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
            ],
        ];

        foreach($data as $row) {
            $movie = new Movie();
            $movie->setTitle($row['title']);
            $movie->setSlug($row['slug']);
            $movie->setDescription($row['description']);
            $movie->setDuration($row['duration']);
            $movie->setDirector($row['director']);

            $manager->persist($movie);
        }

        $manager->flush();
    }
}
