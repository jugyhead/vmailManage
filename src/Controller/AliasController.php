<?php

namespace App\Controller;

use App\Form\AliasType;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Alias;

/**
 * Class AliasController
 * @package App\Controller
 * @author Andreas Bresch
 * @author Sebastian Sieburg <sebastian@sieburg.eu>
 */
class AliasController extends AbstractController
{

    /**
     * @Route("/alias/", name="alias_list")
     */
    public function list(Request $request)
    {
        $aliases = $this->getDoctrine()
            ->getRepository(Alias::class)
            ->findAll();
        return $this->render('alias_list.html.twig', array('aliases' => $aliases));
    }

    /**
     * @Route("/alias/{id}", name="alias_edit", requirements={"id": "\d+"})
     */
    public function edit($id, Request $request)
    {
        $alias = $this->getDoctrine()
            ->getRepository(Alias::class)
            ->find($id);
        if (!$alias) {
            return $this->redirectToRoute('alias_list');
        }
        return $this->handleForm($alias, $request);
    }


    /**
     * @Route("/alias/new", name="alias_new")
     */
    public function new(Request $request)
    {
        $alias = new Alias();
        return $this->handleForm($alias, $request);
    }


    /**
     * @Route("/alias/delete/{id}", name="alias_delete", requirements={"id": "\d+"})
     */
    public function delete($id, Request $request)
    {
        $alias = $this->getDoctrine()
            ->getRepository(Alias::class)
            ->find($id);
        if (!$alias) {
            return $this->redirectToRoute('alias_list');
        }
        // delete:
        $em = $this->getDoctrine()->getManager();
        $em->remove($alias);
        $em->flush();

        return $this->redirectToRoute('alias_list');
    }



    /**
     * @param Alias $alias
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    function handleForm(Alias $alias, Request $request)
    {
        $form = $this->createForm(AliasType::class, $alias);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) { // save the data:
            $alias = $form->getData();
            $em = $this->getDoctrine()->getManager();
            // tells Doctrine you want to (eventually) save the Product (no queries yet)
            $em->persist($alias);
            // actually executes the queries (i.e. the INSERT query)
            $em->flush();
            return $this->redirectToRoute('alias_list');
        }
        // show the form (again):
        return $this->render('alias_edit.html.twig', array('form' => $form->createView()));
    }

}