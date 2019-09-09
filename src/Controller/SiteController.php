<?php

namespace App\Controller;

use App\Repository\PagesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SiteController extends AbstractController
{
    /**
     * @Route("/", name="app_homepage")
     * @return Response
     */
    public function index(PagesRepository $pagesRepository)
    {

        $page = $pagesRepository->findOneBySomeField('/');
        if (!$page){
            throw $this->createNotFoundException('No content found for home page');
        }

        return $this->render('site/index.html.twig', [
            'page' => $page,
        ]);
    }
}
