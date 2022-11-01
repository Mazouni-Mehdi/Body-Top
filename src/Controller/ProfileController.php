<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Franchise;
use App\Entity\Structure;
use App\Entity\Module;
use Doctrine\Persistence\ManagerRegistry;
use App\Repository\FranchiseRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/profile', name: "app_profile_")]
class ProfileController extends AbstractController
{
    #[Route('/', name: '')]
    public function index(): Response
    {
        
        return $this->render('profile/index.html.twig');
    
    }

    #[Route('/franchise/{id<\d+>}', name: 'franchise')]
    public function franchise(User $user, Franchise $franchise): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $franchise = $user->getFranchise();

        return $this->render('profile/franchise.html.twig', [
            'user' => $user,
            'franchise' => $franchise
        ]);
    }


    #[Route('/structure/{id<\d+>}', name: 'list_structure')]
    public function structure(Franchise $franchise): Response
    {
        $structure = $franchise->getStructure();

        return $this->render('profile/structure.html.twig', [
            'franchise' => $franchise,
            'structure' => $structure
        ]);
    }

    #[Route('/module/{id<\d+>}', name: 'list_module')]
    public function module(Structure $structure): Response
    {
        $module = $structure->getModule();
        dump($module);
        dump($structure);
        return $this->render('profile/module.html.twig', [
            'structure' => $structure,
            'module' => $module
        ]);
    }

    /*#[Route('/structure/{id<\d+>}', name: 'list_structure')]
    public function structure(Structure $structure): Response
    {
        $module = $structure->getModule();
        dump($structure);
        dump($module);
        return $this->render('profile/structure.html.twig', [
            'structures' => $structure,
            'module' => $module
        ]);
    
    #[Route('/{id<\d+>}', name: '')]
    public function index(User $user, Franchise $franchise, Request $request): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $franchise = $user->getFranchise();

        return $this->render('profile/index.html.twig', [
            'id' => $request->get('id'),
            'user' => $user,
            'franchise' => $franchise
       ]);
    }
    
    #[Route('/}', name: '')]
    public function index(User $user, Franchise $franchise): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $franchise = $user->getFranchise();

        return $this->render('profile/index.html.twig', [
            'user' => $user,
            'franchise' => $franchise
        ]);
    }*/

    /*#[Route('/profile', name: 'app_profile')]
    public function index(UserRepository $userRepository): Response
    {
        $franchise = $this->getUser();
        dump($franchise);
        return $this->render('profile/account.html.twig', [
            'user' => $userRepository->findBy(['franchise' => $franchise])
        ]);
    }*/

    /*$user = $this->getUser();

        if(!$user->getUserValidated())
        {
            return $this->render('home/userUnValidated.html.twig',  []);
        }

        return $this->render('library/index.html.twig', [
            'books' => $bookRepository->findAll()
        ]);*/



    /*#[Route('/profile', name: 'app_profile')]
    public function index(ManagerRegistry $doctrine): Response
    {
        $repository = $doctrine->getRepository(Franchise::class);
        $franchises = $repository->findAll();
        return $this->render('profile/index.html.twig', [
            "franchises" => $franchises,
        ]);
    }*/
}
