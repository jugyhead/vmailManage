<?php
/**
 * Created by PhpStorm.
 * User: andy
 * Date: 02.07.17
 * Time: 19:09
 */

namespace App\Controller;

use App\Form\AccountType;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Account;



class EditAccountController extends AbstractController
{

    /**
     * @Route("/account/{id}", name="edit_account", requirements={"id": "\d+"})
     */
    public function edit($id, Request $request)
    {
        $account = $this->getDoctrine()
            ->getRepository('AppBundle:Account')
            ->find($id);
        if (!$account) {
            return $this->redirectToRoute('list_accounts');
        }
        return $this->handleForm($account, $request);
    }


    /**
     * @Route("/account/new", name="edit_new_account")
     */
    public function new(Request $request)
    {
        $account = new Account();
        return $this->handleForm($account, $request);
    }

    /**
     * @Route("/account/delete/{id}", name="delete_account", requirements={"id": "\d+"})
     */
    public function delete($id, Request $request)
    {
        $account = $this->getDoctrine()
            ->getRepository('AppBundle:Account')
            ->find($id);
        if (!$account) {
            return $this->redirectToRoute('list_accounts');
        }

        // delete:
        $em = $this->getDoctrine()->getManager();
        $em->remove($account);
        $em->flush();

        return $this->redirectToRoute('list_accounts');
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
            return $this->redirectToRoute('list_accounts');
        }
        // show the form (again):
        return $this->render('editAccount.html.twig', array('form' => $form->createView()));
    }
}
