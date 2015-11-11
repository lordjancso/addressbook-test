<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class HomeController extends Controller
{
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $query = $em->getRepository('AppBundle:Entry')->findAllToPagination();

        $paginator = $this->get('knp_paginator');
        $entries = $paginator->paginate(
            $query,
            $request->query->getInt('page', 1),
            10,
            array(
                'wrap-queries' => true
            )
        );

        return $this->render('home/index.html.twig', array(
            'entries' => $entries
        ));
    }
}
