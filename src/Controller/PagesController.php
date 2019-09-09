<?php

namespace App\Controller;

use App\Entity\Pages;
use App\Form\EditPageType;
use App\Form\PagesType;
use Omines\DataTablesBundle\Adapter\ArrayAdapter;
use Omines\DataTablesBundle\Adapter\Doctrine\ORMAdapter;
use Omines\DataTablesBundle\Column\BoolColumn;
use Omines\DataTablesBundle\Column\TextColumn;
use Omines\DataTablesBundle\Controller\DataTablesTrait;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Omines\DataTablesBundle\DataTableFactory;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\RouterInterface;


/**
 * Class PagesController
 * @package App\Controller
 * @IsGranted("ROLE_ADMIN")
 */
class PagesController extends AbstractController
{

    use DataTablesTrait;
    /**
     * @var RouterInterface
     */
    private $router;
    /**
     * @var DataTableFactory
     */
    private $dataTableFactory;

    public function __construct(RouterInterface $router, DataTableFactory $dataTableFactory)
   {
       $this->router = $router;
       $this->dataTableFactory = $dataTableFactory;
   }

    /**
     * @Route("/dashboard/pages", name="app_dashboard_pages")
     * @param Request $request
     * @return Response
     * @throws Exception
     */
    public function index(Request $request)
    {

        $table = $this->dataTableFactory->create()
            ->add('PageName', TextColumn::class, ['label' => 'Page Name'])
            ->add('isHomePage', BoolColumn::class, [
                'label' => 'Home Page',
                'trueValue' => 'Yes',
                'falseValue' => '',
            ])
            ->add('setLive', BoolColumn::class, [
                'label' => 'Live',
                'trueValue' => 'Yes',
                'falseValue' => 'No',
            ])
            ->add('id', TextColumn::class, ['label' => 'Actions', 'className' => 'text-center',
                'render' => function($value){
                    return '<a href="'.$this->router->generate('app_dashboard_pages_edit', ['id' => $value]).'"><i class="dashicons dashicons-edit" title="edit page" style="font-size: 1.8rem"></i></a>&nbsp;&nbsp;<a href="'.$this->router->generate('app_dashboard_pages_delete', ['id' => $value]).'"><i class="dashicons dashicons-no" title="delete page" style="font-size: 1.8rem"></i></a>';
                }
                ])
            ->createAdapter(ORMAdapter::class, [
                'entity' => Pages::class,
            ])
            ->handleRequest($request);

        if ($table->isCallback()) {
            return $table->getResponse();
        }

        $date_time = new \DateTime();

        return $this->render('pages/index.html.twig', [
            'copyright_year' => $date_time,
            'datatable' => $table,
        ]);
    }

    /**
     * @Route("/dashboard/pages/new", name="app_dashboard_pages_new")
     * @param Request $request
     * @param EntityManagerInterface $entityManager
     * @return Response
     * @throws Exception
     */
    public function createNewPage(Request $request, EntityManagerInterface $entityManager)
    {

        $form = $this->createForm(PagesType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $data = $form->getData();
            $data->setDateAdded(date('d/m/Y'));
            $entityManager->persist($data);
            $entityManager->flush();

            $this->addFlash('success', 'Success! New page has been created.');
            return new RedirectResponse($this->router->generate('app_dashboard_pages'));
        }

        $date_time = new \DateTime();
        return $this->render('pages/new.html.twig', [
            'copyright_year' => $date_time,
            'newPageForm' => $form->createView(),
        ]);
    }


    /**
     * @Route("/dashboard/pages/edit/{id}", name="app_dashboard_pages_edit")
     * @param int $id
     * @param Request $request
     * @param Pages $pages
     * @param EntityManagerInterface $entityManager
     * @return Response
     * @throws Exception
     */
    public function editPage(int $id, Request $request, Pages $pages, EntityManagerInterface $entityManager)
    {

        $form = $this->createForm(EditPageType::class, $pages);
        $form->handleRequest($request);

        $date_time = new \DateTime();

        if ($form->isSubmitted() && $form->isValid()){
            $data = $form->getData();
            $entityManager->persist($data);
            $entityManager->flush();

            $this->addFlash('success', 'Success! Page has been updated.');

        }

        return $this->render('pages/edit.html.twig', [
            'copyright_year' => $date_time,
            'editPageForm' => $form->createView(),
        ]);
    }

    /**
     * @Route("/dashboard/pages/delete/{id}", name="app_dashboard_pages_delete")
     * @param int $id
     * @return Response
     */
    public function deletePage(int $id)
    {


    }

}
