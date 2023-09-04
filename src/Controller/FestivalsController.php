<?php

namespace App\Controller;

use App\Repository\DepartementsRepository;
use App\Repository\FestivalsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FestivalsController extends AbstractController
{
    #[Route('/festivals', name: 'app_festivals')]
    public function index(FestivalsRepository $festivalsRepository, DepartementsRepository $departementsRepository): Response
    {
        $query = $festivalsRepository->createQueryBuilder('f')
            ->setMaxResults(3)
            ->orderBy('f.id', 'DESC')
            ->getQuery();

        $festivals = $query->getResult();
        return $this->render('festivals/index.html.twig', [
            'festivals' => $festivals,
            'departements' => $departementsRepository->findAll()
        ]);
    }

    #[Route('/admin/festival/{id}/get', name: 'app_festival_get')]
    public function get(FestivalsRepository $repo, int $id) : Response
    {
        $festival = $repo->find($id);

        return $this->render('festivals/get.html.twig', [
            "festival" => $festival
        ]);
    }
}
