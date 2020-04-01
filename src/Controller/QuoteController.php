<?php

namespace App\Controller;

use App\Entity\Quote;
use App\Form\QuoteType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
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

        $quotes = $this->getDoctrine()->getRepository(Quote::class)->findAll();

        $search = $request->query->get('search');

        $result = [];


            if ($search)
            {
                /*function insert(string $search)
                {

                }
                array_filter($quotes, "pop");*/


                foreach ($quotes as $quote) {
                    if (stripos($quote->getContent(), $search) !== false || stripos($quote->getMeta(), $search) !== false ) {

                        $result [] = $quote;
                    }
                }https://slides-symfony-iut.netlify.com/#/3/12

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
        $entityManager = $this->getDoctrine()->getManager();



        $quote = [];
        $form = $this->createForm(QuoteType::class, $quote);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $quote = $form->getData();

            $newQuote = new Quote();
            $newQuote->setContent($quote["content"]);
            $newQuote->setMeta($quote["meta"]);

            $entityManager->persist($newQuote);
            $entityManager->flush();

            return $this->redirectToRoute('quotes');
        }

        return $this->render('quote/new.html.twig', ['form' => $form->createView()]);
    }

    /**
     * @Route("/quote/edit/{id}", name="quote_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Quote $quote)
    {


        if(!$quote) {
            throw $this->createNotFoundException("pas de citation pour l'id ".$id);
        }

        $form = $this->createForm(QuoteType::class, $quote);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();

            $entityManager->persist($quote);
            $entityManager->flush();


            return $this->redirectToRoute('quotes');
        }

        return $this->render('quote/edit.html.twig', ['form'=> $form->createView()]);
    }


    /**
     * @Route ("/quote/delete/{id}", name="quote_delete", methods={"GET", "POST"})
     */
    public function delete(Quote $quote) {


        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($quote);
        $entityManager->flush();


        return $this->redirectToRoute('quotes');

    }

    /**
     * @Route ("quote/random", name="quote_random")
     * @return Response
     * @throws \Exception
     */
    public function random()
    {
        $quotes = $this->getDoctrine()->getRepository(Quote::class)->findAll();
        $quote = $quotes[rand(0,count($quotes)-1)];

        return $this->render('quote/random.html.twig', ['quote' => $quote]);
    }


}
