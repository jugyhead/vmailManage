<?php
/**
 * Created by PhpStorm.
 * User: andy
 * Date: 07.07.17
 * Time: 21:05
 */

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Alias;

class ListAliasesController extends AbstractController
{
    /**
     * @Route("/alias/", name="list_aliases")
     */
    public function indexAction(Request $request)
    {
        $aliases = $this->getDoctrine()
            ->getRepository('AppBundle:Alias')
            ->findAll();
        return $this->render('listAliases.html.twig', array('aliases' => $aliases));
    }
}