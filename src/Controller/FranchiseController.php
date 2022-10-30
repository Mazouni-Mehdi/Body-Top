<?php

namespace App\Controller;

use App\Entity\Franchise;
use App\Entity\Module;
use App\Entity\User;
use App\Entity\Structure;
use App\Form\UserType;
use App\Form\UserStructureType;
use App\Form\FranchiseType;
use App\Form\ModuleType;
use App\Form\StructureType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin', name: "app_admin_")]
class FranchiseController extends AbstractController
{

  #[Route('/franchise/new', name: 'franchise_new')]
  public function add(Request $request, UserPasswordHasherInterface $userPasswordHasher, ManagerRegistry $doctrine): Response
  {
    $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
    $user = new User($userPasswordHasher);
    $form = $this->createForm(UserType::class, $user);
    $form->handleRequest($request);
    if ($form->isSubmitted() && $form->isValid()) {
      $em = $doctrine->getManager();
      $em->persist($user->getFranchise());
      $em->persist($user);
      $em->flush();
      $this->addFlash('success', 'La franchise a été créé avec succès');
      return $this->redirectToRoute('app_admin_');
    }
    return $this->render('admin/franchise/create.html.twig', [
      'form' => $form->createView(),
    ]);
  }

  #[Route('/franchise/edit/{id<\d+>}', name: "edit_franchise")]
    public function update(Request $request, Franchise $franchise, ManagerRegistry $doctrine): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $form = $this->createForm(FranchiseType::class, $franchise);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $doctrine->getManager();
            $em->flush();
            return $this->redirectToRoute('app_admin_');
        }
        return $this->render('admin/franchise/create.html.twig', [
            "form" => $form->createView()
        ]);
    }

    #[Route('/Franchise/delete/{id<\d+>}', name: "delete_franchise")]
    public function delete(Franchise $franchise, ManagerRegistry $doctrine): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $em = $doctrine->getManager();
        $em->remove($franchise);
        $em->flush();
        return $this->redirectToRoute('app_admin_');
    }

    






  

}