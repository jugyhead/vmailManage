<?php

namespace App\Controller;

use App\Entity\DomainNewItem;
use App\Entity\DomainEditItem;
use App\Form\DomainType;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Domain;

/**
 * Class DomainController
 * @package App\Controller
 * @author Andreas Bresch
 * @author Sebastian Sieburg <sebastian@sieburg.eu>
 */
class DomainController extends AbstractController
{

    /**
     * @Route("/domain/", name="domain_list")
     */
    public function list(Request $request)
    {
        $domains = $this->getDoctrine()
            ->getRepository(Domain::class)
            ->findAll();

        return $this->render('domain_list.html.twig', array('domains' => $domains));
    }

    /**
     * @Route("/domain/new", name="domain_new")
     */
    public function new(Request $request)
    {
        $domain = new Domain();
        return $this->handleFormNewItem($domain, $request);
    }

    /**
     * @Route("/domain/delete/{id}", name="domain_delete", requirements={"id": "\d+"})
     */
    public function delete($id, Request $request)
    {
        $domain = $this->getDoctrine()
            ->getRepository(Domain::class)
            ->findOneBy(array('id' => $id));
        if (!$domain) {
            return $this->redirectToRoute('domain_list');
        }

        $em = $this->getDoctrine()->getManager();
        $em->remove($domain);
        $em->flush();

        return $this->redirectToRoute('domain_list');
    }


    /**
     *
     * workaround because of unsupported database-structure (foreign key is not primary key)
     *
     * @param DomainNewItem $domain
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    private function handleFormNewItem(Domain $domain, Request $request)
    {
        $form = $this->createForm(DomainType::class, $domain);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $domain = $form->getData();
            #print_r($domain);exit;
            $em = $this->getDoctrine()->getManager();
            $em->persist($domain);
            $em->flush();
            return $this->redirectToRoute('domain_list');
        }
        return $this->render('domain_new.html.twig', array(
            'form' => $form->createView()));
    }

}
