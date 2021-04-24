<?php

namespace App\Controller\Admin;

use App\Entity\Album;
use App\Entity\Image;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\CrudUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        // return parent::index();

        // redirect to some CRUD controller
        $routeBuilder = $this->get(CrudUrlGenerator::class)->build();

        return $this->redirect($routeBuilder->setController(ImageCrudController::class)->generateUrl());
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Gestion du backoffice');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linktoRoute('Retour au site','fa fa-sign-out-alt','default');
        yield MenuItem::linkToCrud('Les albums', 'fa fa-user-cog', Album::class);
        yield MenuItem::linkToCrud('Les images', 'fa fa-paper-plane', Image::class);
    }

}
