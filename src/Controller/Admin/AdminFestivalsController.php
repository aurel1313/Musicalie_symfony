<?php

namespace App\Controller\Admin;

use App\Entity\Festivals;
use App\Form\FestivalsType;
use App\Repository\FestivalsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class AdminFestivalsController extends AbstractController
{
    #[Route('/admin/festivals', name: 'app_admin_festivals')]
    public function index(FestivalsRepository $repo): Response
    {
        $festivals = $repo->findAll();

        return $this->render('admin/festivals/index.html.twig', [
            'festivals' => $festivals,
        ]);
    }

    #[Route('/admin/festival/create', name: 'app_admin_festival_create')]
    #[Route('/admin/festival/{id}/update', name: 'app_admin_festival_update')]
    public function createOrUpdate(Request $request, EntityManagerInterface $manager, FestivalsRepository $repo, int $id = null) : Response
    {
        if ($id == null) {
            $festival = new Festivals();
        } else {
            $festival = $repo->find($id);
        }

        $form = $this->createForm(FestivalsType::class, $festival);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if ($festival->getAffiche() == null) {
                $relativeFilePath = 'images/affiche.png';

                $festival->setAffiche($relativeFilePath);
            }
            $manager->persist($festival);
            $manager->flush();

            return $this->redirectToRoute('app_admin_festivals');
        }

        return $this->render('admin/festivals/edit.html.twig', [
            "form" => $form
        ]);
    }

    #[Route('/admin/festival/{id}/delete', name: 'app_admin_festival_delete')]
    public function delete(EntityManagerInterface $manager, FestivalsRepository $repo, int $id) : Response
    {
        $festival = $repo->find($id);

        $manager->remove($festival);
        $manager->flush();

        return $this->redirectToRoute('app_admin_festivals');
    }
}
