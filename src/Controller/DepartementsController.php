<?php

namespace App\Controller;

use App\Form\DepartementsType;
use App\Repository\DepartementsRepository;
use http\Client\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DepartementsController extends AbstractController
{
    #[Route('/departements', name: 'app_departements')]
    public function index(): Response
    {
        return $this->render('departements/index.html.twig', [
            'controller_name' => 'DepartementsController',
        ]);
    }

    #[Route('/admin/departement/{id}/get', name: 'app_departement_get')]
    public function get(DepartementsRepository $repo, int $id) : Response
    {
        $departement = $repo->find($id);

        return $this->render('departements/index.html.twig', [
            "departement" => $departement
        ]);
    }
}
