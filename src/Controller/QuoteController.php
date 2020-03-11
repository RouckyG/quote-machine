<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class QuoteController extends AbstractController
{
    /**
     * @Route("/quote", name="quote")
     */
    public function index()
    {
        return $this->render('quote/index.html.twig', [
            'controller_name' => 'QuoteController',
        ]);
    }

    /**
     * @Route("/quote/{search}", name="quotes")
     *
     * @param array $quotes
     * @return Response
     */
    public function quotes(string $search)
    {
        $quotes = [
            [
                "content" => "Sire, Sire ! On en a gros !",
                "meta" => "Perceval, Livre II, Les Exploités"
            ],
            [
                "content" => "J’ai pénétré leur lieu d'habitation de façon subrogative […] en tapinant.",
                "meta" => "Hervé de Rinel, Livre III, 91 : L’Espion"
            ],
            [
                "content" => "Tout le monde est une pute, Grace. Nous vendons juste différentes parties de nous-mêmes.",
                "meta" => "Tommy Shelby"
            ],
            [
                "content" => "Je viens de lui mettre une balle dans la tête…… Il m’a regardé de travers.",
                "meta" => "Tommy Shelby"
            ],
            [
                "content" => "2500 pièces d'or ???! Eh... eh... c'est un blague? 2500 pièces d'or, mais ou voulez vous que j'trouve 2500 pièces d'or, dans l'cul d'une vache ?!",
                "meta" => "Seigneur Jacca, Livre I, 21 : La taxe militaire"
            ],
            [
                "content" => "Une pluie de pierres en intérieur donc ! Je vous prenais pour un pied de chaise mais vous êtes un précurseur en fait !",
                "meta" => "Élias de Kelliwic'h, Livre IV, Le Privilégié "
            ],
            [
                "content" => "Et qu'est-ce qui font-ils, au gouvernement ? Y's'roucent les poules ! Y's'poulent les rouces ! (Guethenoc : Y's'roulent les pouces !) Voilà, mieux !",
                "meta" => "Roparzh, Livre IV, 53 : Vox populi III "
            ],
            [
                "content" => "Don't f*ck with the Peaky Blinders !",
                "meta" => "Tante Polly P"
            ],
        ];



        return $this->render('quote/quotes.html.twig', [
            'search' => $search,
        ]);
    }
}
