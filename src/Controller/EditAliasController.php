<?php
/**
 * Created by PhpStorm.
 * User: andy
 * Date: 07.07.17
 * Time: 21:36
 */

namespace App\Controller;

use App\Form\AliasType;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Alias;

class EditAliasController extends AbstractController
{
    /**
     * @Route("/alias/{id}", name="edit_alias", requirements={"id": "\d+"})
     */
    public function edit($id, Request $request)
    {
        $alias = $this->getDoctrine()
            ->getRepository('AppBundle:Alias')
            ->find($id);
        if (!$alias) {
            return $this->redirectToRoute('list_aliases');
        }
        return $this->handleForm($alias, $request);
    }


    /**
     * @Route("/alias/new", name="edit_new_alias")
     */
    public function new(Request $request)
    {
        $alias = new Alias();
        return $this->handleForm($alias, $request);
    }


    /**
     * @Route("/alias/delete/{id}", name="delete_alias", requirements={"id": "\d+"})
     */
    public function delete($id, Request $request)
    {
        $alias = $this->getDoctrine()
            ->getRepository('AppBundle:Alias')
            ->find($id);
        if (!$alias) {
            return $this->redirectToRoute('list_aliases');
        }
        // delete:
        $em = $this->getDoctrine()->getManager();
        $em->remove($alias);
        $em->flush();

        return $this->redirectToRoute('list_aliases');
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
            return $this->redirectToRoute('list_aliases');
        }
        // show the form (again):
        return $this->render('editAlias.html.twig', array('form' => $form->createView()));
    }

}