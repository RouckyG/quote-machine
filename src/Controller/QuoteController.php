<?php

namespace App\Controller;

use App\Form\QuoteType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class QuoteController extends AbstractController
{
    /**
     * @Route("/quote/index", name="quote")
     */
    public function index()
    {

        return $this->render('quote/index.html.twig', [
            'controller_name' => 'QuoteController',
        ]);
    }

    /**
     * @Route("/quote/", name="quotes")
     *
     * @param array $quotes
     * @return Response
     */
    public function quotes(Request $request)
    {

        $quotesStore = \SleekDB\SleekDB::store('quotes', $this->getParameter('kernel.cache_dir') . '/sleekDB');

   if(false)
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

    $quotesStore-> insertMany($quotes);
}


        if (false) {
            $quotesStore->insert([
                'content' => 'DUT',
                'meta' => 'FC',
            ]);
        }

        $quotes = $quotesStore->fetch();

        $search = $request->query->get('search');

        $result = [];


            if ($search)
            {
                /*function insert(string $search)
                {

                }
                array_filter($quotes, "pop");*/


                foreach ($quotes as $quote) {

                    if (stripos($quote["meta"], $search) !== false || stripos($quote["content"], $search) !== false ) {

                        $result [] = $quote;
                    }
                }

            }
            else
            {
                $result = $quotes;
            }


        return $this->render('quote/quotes.html.twig', [
            'quotes' => $result, 'search' => $search
        ]);

    }

    /**
     * @Route ("/quote/new", name="quote_new")
     */
    public function new(Request $request)
    {
        $quote = [];
        $form = $this->createForm(QuoteType::class, $quote);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $quote = $form->getData();
            $quotesStore = \SleekDB\SleekDB::store('quotes', $this->getParameter('kernel.cache_dir') . '/sleekDB');

            $quotesStore->insert(
                $quote
            );

            return $this->redirectToRoute('quotes');
        }

        return $this->render('quote/new.html.twig', ['form' => $form->createView()]);
    }

    /**
     * @Route("/quote/edit/{id}", name="quote_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, int $id)
    {
        $quotesStore = \SleekDB\SleekDB::store('quotes', $this->getParameter('kernel.cache_dir') . '/sleekDB');
        $quotes =$quotesStore->where('_id','=',$id)->fetch();
        $quote = reset($quotes);

        if(!$quotes) {
            throw $this->createNotFoundException("no quote found for id ".$id);
        }

        $form = $this->createForm(QuoteType::class, $quote);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $quote = $form->getData();
            $quotesStore->where('_id','=',$id)->update($quote);

            return $this->redirectToRoute('quotes');
        }

        return $this->render('quote/edit.html.twig', ['form'=> $form->createView()]);
    }


    /**
     * @Route ("quote/delete/{id}", name="quote_delete", methods={"GET", "POST"})
     */
    public function delete(Request $request, int $id)
    {
        $quotesStore = \SleekDB\SleekDB::store('quotes', $this->getParameter('kernel.cache_dir') . '/sleekDB');
        $quotes =$quotesStore->where('_id','=',$id)->fetch();
        $quote = reset($quotes);

        if(!$quotes) {
            throw $this->createNotFoundException("no quote found for id ".$id);
        }

        $form = $this->createForm(QuoteType::class, $quote);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $quotesStore->where('_id','=',$id)->delete();

            return $this->redirectToRoute('quotes');
        }

        return $this->render('quote/delete.html.twig', ['form'=> $form->createView()]);
    }


}
