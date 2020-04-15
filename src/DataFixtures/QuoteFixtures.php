<?php

namespace App\DataFixtures;

use App\Entity\Quote;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class QuoteFixtures extends Fixture implements DependentFixtureInterface
{

    public function load(ObjectManager $manager)
    {
        $quotes =
            [
                [
                    'content' => 'Tout le monde est une pute, Grace. Nous vendons juste différentes parties de nous-mêmes.',
                    'meta' => 'Tommy Shelby',
                    'reference' => CategoryFixtures::PEAKY_BLINDER,
                ],
                [
                    'content' => 'Je viens de lui mettre une balle dans la tête…… Il m’a regardé de travers.',
                    'meta' => 'Tommy Shelby',
                    'reference' => CategoryFixtures::PEAKY_BLINDER,
                ],
                [
                    'content' => '[Dame Séli : Les tartes, la pêche, tout ça c\'est du patrimoine] (Arthur, motant la tarte) C\'est du patrimoine ça ?',
                    'meta' => 'Artuhur, Livre I, La tarte aux myrtilles',
                    'reference' => CategoryFixtures::KAAMELOTT,
                ],
                [
                    'content' => 'Au secours, il y a un pec qui me menace... il a un gland dans la main !',
                    'meta' => 'Madmartigan, Willow',
                    'reference' => CategoryFixtures::WILLOW,
                ],
                [
                    'content' => '2500 pièces d\'or ???! Eh... eh... c\'est un blague? 2500 pièces d\'or, mais ou voulez vous que j\'trouve 2500 pièces d\'or, dans l\'cul d\'une vache ?!',
                    'meta' => 'eigneur Jacca, Livre I, 21 : La taxe militaire',
                    'reference' => CategoryFixtures::KAAMELOTT,
                ],
                [
                    'content' => 'Une pluie de pierres en intérieur donc ! Je vous prenais pour un pied de chaise mais vous êtes un précurseur en fait !',
                    'meta' => ' Élias de Kelliwic\'h, Livre IV, Le Privilégié',
                    'reference' => CategoryFixtures::KAAMELOTT,
                ],
                [
                    'content' => 'Et qu\'est-ce qui font-ils, au gouvernement ? Y\'s\'roucent les poules ! Y\'s\'poulent les rouces ! (Guethenoc : Y\'s\'roulent les pouces !) Voilà, mieux !',
                    'meta' => 'oparzh, Livre IV, 53 : Vox populi III',
                    'reference' => CategoryFixtures::KAAMELOTT,
                    ],
                [
                    'content' => 'Don\'t f*ck with the Peaky Blinders !',
                    'meta' => 'Tante Polly',
                    'reference' => CategoryFixtures::PEAKY_BLINDER,
                ],
                [
                    'content' => 'My boot, your face; the perfect couple.',
                    'meta' => 'Duke Nukem',
                    'reference' => CategoryFixtures::DUKE_NUKEM,
                ],
            ];

        for ($i=0; $i< count($quotes); $i++){
            $quote = new Quote();
            $quote->setContent($quotes[$i]['content']);
            $quote->setMeta($quotes[$i]['meta']);
            $quote->setCategory($this->getReference($quotes[$i]['reference']));
            $manager->persist($quote);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            CategoryFixtures::class
        ];
    }
}
