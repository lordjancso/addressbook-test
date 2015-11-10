<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ApiEntryController extends Controller
{
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $query = $em->getRepository('AppBundle:Entry')->findAllToPagination();

        $paginator = $this->get('knp_paginator');
        $entries = $paginator->paginate(
            $query,
            $request->query->getInt('page', 1),
            10
        );

        $pagination = $this->renderView('common/paginator.html.twig', array(
            'entries' => $entries
        ));

        $serializer = \JMS\Serializer\SerializerBuilder::create()->build();
        $jsonResponse = $serializer->serialize(array(
            'entries' => $entries->getItems(),
            'pagination' => $pagination
        ), 'json');

        return new Response($jsonResponse, Response::HTTP_OK, array(
            'Content-Type' => 'application/json'
        ));
    }
}
