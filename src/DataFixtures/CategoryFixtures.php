<?php

namespace App\DataFixtures;

use App\Entity\Categorie;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class CategoryFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $category = new Categorie();
        $category->setNom('Kaameloot');
        $manager->persist($category);

        $category = new Categorie();
        $category->setNom('Peaky Blinders');
        $manager->persist($category);

        $category = new Categorie();
        $category->setNom('Duke Nukem');
        $manager->persist($category);

        $manager->flush();
    }
}
