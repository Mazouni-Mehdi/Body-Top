<?php

namespace App\Controller;

use App\Entity\Franchise;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin', name: "app_admin_")]
class AdminController extends AbstractController
{
    #[Route('/', name: '')]
    public function index(ManagerRegistry $doctrine): Response
    {
        $repository = $doctrine->getRepository(Franchise::class);
        $franchises = $repository->findAll();
        return $this->render('admin/index.html.twig', [
            "franchises" => $franchises,
        ]);
    }
}
