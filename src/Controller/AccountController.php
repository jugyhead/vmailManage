<?php

namespace App\Controller;

use App\Form\AccountType;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Account;

/**
 * Class AccountController
 * @package App\Controller
 * @author Andreas Bresch
 * @author Sebastian Sieburg <sebastian@sieburg.eu>
 */
class AccountController extends AbstractController
{

    /**
     * @Route("/account/", name="account_list")
     */
    public function list(Request $request)
    {
        $accounts = $this->getDoctrine()
            ->getRepository(Account::class)
            ->findAll();
        return $this->render('account_list.html.twig', array('accounts' => $accounts));
    }


    /**
     * @Route("/account/{id}", name="edit_account", requirements={"id": "\d+"})
     */
    public function edit($id, Request $request)
    {
        $account = $this->getDoctrine()
            ->getRepository(Account::class)
            ->find($id);
        if (!$account) {
            return $this->redirectToRoute('account_list');
        }
        return $this->handleForm($account, $request);
    }


    /**
     * @Route("/account/new", name="account_new")
     */
    public function new(Request $request)
    {
        $account = new Account();
        return $this->handleForm($account, $request);
    }

    /**
     * @Route("/account/delete/{id}", name="account_delete", requirements={"id": "\d+"})
     */
    public function delete($id, Request $request)
    {
        $account = $this->getDoctrine()
            ->getRepository(Account::class)
            ->find($id);

        if (!$account) {
            return $this->redirectToRoute('account_list');
        }

        // delete:
        $em = $this->getDoctrine()->getManager();
        $em->remove($account);
        $em->flush();

        return $this->redirectToRoute('account_list');
    }

    /**
     * @param Account $account
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    private function handleForm(Account $account, Request $request)
    {
        $form = $this->createForm(AccountType::class, $account);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) { // save the data:
            $account = $form->getData();
            $em = $this->getDoctrine()->getManager();
            // tells Doctrine you want to (eventually) save the Product (no queries yet)
            $em->persist($account);
            // actually executes the queries (i.e. the INSERT query)
            $em->flush();
            return $this->redirectToRoute('account_list');
        }
        // show the form (again):
        return $this->render('account_edit.html.twig', array('form' => $form->createView()));
    }
}
