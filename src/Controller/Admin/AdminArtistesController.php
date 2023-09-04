<?php

namespace App\Controller\Admin;

use App\Entity\Artistes;
use App\Form\ArtistesType;
use App\Repository\ArtistesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class AdminArtistesController extends AbstractController
{
    #[Route('/admin/artistes', name: 'app_admin_artistes')]
    public function index(ArtistesRepository $repo): Response
    {
        $artistes = $repo->findAll();

        return $this->render('admin/artistes/index.html.twig', [
            'artistes' => $artistes,
        ]);
    }

    #[Route('/admin/artistes/create', name: 'app_admin_artiste_create')]
    #[Route('/admin/artiste/{id}/update', name: 'app_admin_artiste_update')]
    public function createOrUpdate(Request $request, EntityManagerInterface $manager, ArtistesRepository $repo, int $id = null) : Response
    {
        if ($id == null) {
            $artiste = new Artistes();
        } else {
            $artiste = $repo->find($id);
        }

        $form = $this->createForm(ArtistesType::class, $artiste);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $manager->persist($artiste);
            $manager->flush();

            return $this->redirectToRoute('app_admin_artistes');
        }

        return $this->render('admin/artistes/edit.html.twig', [
            "form" => $form
        ]);
    }

    #[Route('/admin/artiste/{id}/update', name: 'app_admin_artiste_delete')]
    public function delete(EntityManagerInterface $manager, ArtistesRepository $repo, int $id) : Response
    {
        $artiste = $repo->find($id);

        $manager->remove($artiste);
        $manager->flush();

        return $this->redirectToRoute('app_admin_artistes');
    }


}
