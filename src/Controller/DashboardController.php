<?php

namespace App\Controller;

use Exception;
use Psr\Log\LoggerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;



/**
 * Class DashboardController
 * @package App\Controller
 * @IsGranted("ROLE_ADMIN")
 */
class DashboardController extends BaseController
{
    /**
     * @Route("/dashboard", name="app_dashboard")
     * @param LoggerInterface $logger
     * @return Response
     * @throws Exception
     */
    public function index(LoggerInterface $logger)
    {
        $logger->debug('Checking dashboard page for '.$this->getUser()->getEmail());
        $date_time = new \DateTime();

        return $this->render('dashboard/index.html.twig', [
            'copyright_year' => $date_time,
        ]);
    }
}
