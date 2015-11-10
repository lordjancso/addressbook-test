<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Entry;
use AppBundle\Entity\EntryAddress;
use AppBundle\Entity\EntryEmail;
use AppBundle\Entity\EntryPhone;
use AppBundle\Form\EntryType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class EntryController extends Controller
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

        return $this->render('admin/entries/index.html.twig', array(
            'entries' => $entries
        ));
    }

    public function createAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $entry = new Entry();
        $entry->addAddress(new EntryAddress());
        $entry->addEmail(new EntryEmail());
        $entry->addPhone(new EntryPhone());

        $form = $this->createForm(new EntryType(), $entry);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em->persist($entry);
            $em->flush();

            return $this->redirectToRoute('entry.index');
        }

        return $this->render('admin/entries/form.html.twig', array(
            'form' => $form->createView()
        ));
    }

    public function editAction($id)
    {
        //
    }

    public function deleteAction($id)
    {
        //
    }
}
