<?php

namespace App\Controller;

use App\Repository\PagesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SiteController extends AbstractController
{

    /**
     * @var PagesRepository
     */
    private $pagesRepository;

    public function __construct(PagesRepository $pagesRepository)
    {
        $this->pagesRepository = $pagesRepository;
    }

    /**
     * @Route("/", name="app_homepage")
     * @return Response
     */
    public function index()
    {

        $page = $this->pagesRepository->findOneBySomeField('/');
        if (!$page){
            throw $this->createNotFoundException('No content found for home page');
        }

        return $this->render('site/index.html.twig', [
            'page' => $page,
        ]);
    }

    /**
     * @Route("/{slug}", name="app_page")
     * @param string $slug
     * @return Response
     */
    public function sitePage(string $slug)
    {
        $page = $this->pagesRepository->findOneBySomeField($slug);
        if (!$page){
            throw $this->createNotFoundException('No content found for this page');
        }
        return $this->render('site/page.html.twig', [
            'page' => $page,
        ]);
    }
}
