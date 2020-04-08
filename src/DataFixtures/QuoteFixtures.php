<?php

namespace App\DataFixtures;

use App\Entity\Quote;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class QuoteFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $quotes =
            [
                [
                    'content' => 'Tout le monde est une pute, Grace. Nous vendons juste différentes parties de nous-mêmes.',
                    'meta' => 'Tommy Shelby',
                ],
                [
                    'content' => 'Je viens de lui mettre une balle dans la tête…… Il m’a regardé de travers.',
                    'meta' => 'Tommy Shelby',
                ],
                [
                    'content' => '[Dame Séli : Les tartes, la pêche, tout ça c\'est du patrimoine] (Arthur, motant la tarte) C\'est du patrimoine ça ?',
                    'meta' => 'Artuhur, Livre I, La tarte aux myrtilles',
                ],
                [
                    'content' => 'Au secours, il y a un pec qui me menace... il a un gland dans la main !',
                    'meta' => 'Madmartigan, Willow',
                ],
                [
                    'content' => '2500 pièces d\'or ???! Eh... eh... c\'est un blague? 2500 pièces d\'or, mais ou voulez vous que j\'trouve 2500 pièces d\'or, dans l\'cul d\'une vache ?!',
                    'meta' => 'eigneur Jacca, Livre I, 21 : La taxe militaire',
                ],
                [
                    'content' => 'Une pluie de pierres en intérieur donc ! Je vous prenais pour un pied de chaise mais vous êtes un précurseur en fait !',
                    'meta' => ' Élias de Kelliwic\'h, Livre IV, Le Privilégié',
                ],
                [
                    'content' => 'Et qu\'est-ce qui font-ils, au gouvernement ? Y\'s\'roucent les poules ! Y\'s\'poulent les rouces ! (Guethenoc : Y\'s\'roulent les pouces !) Voilà, mieux !',
                    'meta' => 'oparzh, Livre IV, 53 : Vox populi III',
                ],
                [
                    'content' => 'Don\'t f*ck with the Peaky Blinders !',
                    'meta' => 'Tante Polly',
                ],
                [
                    'content' => 'My boot, your face; the perfect couple.',
                    'meta' => 'Duke Nukem',
                ],
            ];

        for ($i=0; $i< count($quotes); $i++){
            $quote = new Quote();
            $quote->setContent($quotes[$i]['content']);
            $quote->setContent($quotes[$i]['meta']);
            $manager->persist($quote);
        }

        $manager->flush();
    }
}
