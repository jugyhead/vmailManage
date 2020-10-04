<?php
/**
 * Created by PhpStorm.
 * User: andy
 * Date: 07.07.17
 * Time: 15:02
 */

namespace App\Controller;

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Domain;

class ListDomainsController extends AbstractController
{

    /**
     * @Route("/domain/", name="list_domains")
     */
    public function indexAction(Request $request)
    {
        $domains = $this->getDoctrine()
            ->getRepository(Domain::class)
            ->findAll();

        return $this->render('listDomains.html.twig', array('domains' => $domains));
    }

}