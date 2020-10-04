<?php
/**
 * Created by PhpStorm.
 * User: andy
 * Date: 02.07.17
 * Time: 19:02
 */

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Account;

class ListAccountsController extends AbstractController
{

    /**
     * @Route("/account/", name="list_accounts")
     */
    public function indexAction(Request $request)
    {
        $accounts = $this->getDoctrine()
            ->getRepository('AppBundle:Account')
            ->findAll();
        return $this->render('listAccounts.html.twig', array('accounts' => $accounts));
    }

}




