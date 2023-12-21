<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
;

class CategoryFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $data = [
            ['name'=>'Drame'],
            ['name'=>'Aventure'],
            ['name'=>'Comédie'],
            ['name'=>'Romance'],
            ['name'=>'Horreur'],
            ['name'=>'Action'],
            ['name'=>'Science-Fiction'],
        ];

        foreach($data as $row) {
            $cat = new Category();
            $cat->setName($row['name']);

            $manager->persist($cat);

            //Sauvegarde de la référence pour utiliser dans une fixture dépendante
            $this->addReference($row['name'], $cat);
        }      

        $manager->flush();
    }
}
