<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class CategoryFixtures extends Fixture
{
public const KAAMELOTT = 'kaamelott';
public const PEAKY_BLINDER = 'peaky blinder';
public const DUKE_NUKEM ='duke nukem';
public const WILLOW ='willow';

    public function load(ObjectManager $manager)
    {
        $category = new Category();
        $category->setNom('Kaameloot');
        $this->addReference(self::KAAMELOTT, $category);
        $manager->persist($category);

        $category = new Category();
        $category->setNom('Peaky Blinders');
        $this->addReference(self::PEAKY_BLINDER, $category);
        $manager->persist($category);

        $category = new Category();
        $category->setNom('Duke Nukem');
        $this->addReference(self::DUKE_NUKEM, $category);
        $manager->persist($category);

        $category = new Category();
        $category->setNom('Willow');
        $this->addReference(self::WILLOW, $category);
        $manager->persist($category);


        $manager->flush();
    }


}
