<?php

namespace App\Controller\Admin;

use App\Entity\Departements;
use App\Form\DepartementsType;
use App\Repository\DepartementsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class AdminDepartementsController extends AbstractController
{
    #[Route('/admin/departements', name: 'app_admin_departements')]
    public function index(DepartementsRepository $repo): Response
    {
        $departements = $repo->findAll();

        return $this->render('admin/departements/index.html.twig', [
            'departements' => $departements,
        ]);
    }

    #[Route('/admin/departement/create', name: 'app_admin_departement_create')]
    #[Route('/admin/departement/{id}/update', name: 'app_admin_departement_update')]
    public function createOrUpdate(Request $request, EntityManagerInterface $manager, DepartementsRepository $repo, int $id = null) : Response
    {
        if ($id == null) {
            $departement = new Departements();
        } else {
            $departement = $repo->find($id);
        }

        $form = $this->createForm(DepartementsType::class, $departement);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $manager->persist($departement);
            $manager->flush();

            return $this->redirectToRoute('app_admin_departements');
        }

        return $this->render('admin/departements/edit.html.twig', [
            "form" => $form
        ]);
    }

    #[Route('/admin/departement/{id}/delete', name: 'app_admin_departement_delete')]
    public function delete(EntityManagerInterface $manager, DepartementsRepository $repo, int $id) : Response
    {
        $departement = $repo->find($id);

        $manager->remove($departement);
        $manager->flush();

        return $this->redirectToRoute('app_admin_departements');
    }
}
