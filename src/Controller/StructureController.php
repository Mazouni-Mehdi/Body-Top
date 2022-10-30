<?php

namespace App\Controller;

use App\Entity\Franchise;
use App\Entity\User;
use App\Entity\Structure;
use App\Form\UserStructureType;
use App\Form\StructureType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin', name: "app_admin_")]
class StructureController extends AbstractController
{
  #[Route('/structure/{id<\d+>}', name: 'list_structure')]
  public function list(Franchise $franchise): Response
  {
    $structure = $franchise->getStructure();

    return $this->render('admin/structure/list.html.twig', [
      'franchise' => $franchise,
      'structure' => $structure
    ]);
  }

  #[Route('/structure', name: 'structure')]
  public function listglobal(ManagerRegistry $doctrine): Response
  {

    $repository = $doctrine->getRepository(structure::class);
    $structure = $repository->findAll();
    return $this->render('admin/structure/listglobal.html.twig', [
      'structure' => $structure,
    ]);
  }

  #[Route('/structure/new', name: 'structure_new')]
  public function add(Request $request, UserPasswordHasherInterface $userPasswordHasher, ManagerRegistry $doctrine): Response
  {
    $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
    $user = new User($userPasswordHasher);
    $form1 = $this->createForm(UserStructureType::class, $user);
    $form1->handleRequest($request);

    if ($form1->isSubmitted() && $form1->isValid()) {
      $em = $doctrine->getManager();
      $em->persist($user->getStructure());
      $em->persist($user);
      $em->flush();
      return $this->redirectToRoute('app_admin_');
    }
    return $this->render('admin/structure/create.html.twig', [
      'form1' => $form1->createView(),
    ]);
  }

  #[Route('/structure/edit/{id<\d+>}', name: "edit_structure")]
  public function update(Request $request, Structure $structure, ManagerRegistry $doctrine): Response
  {
    $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
    $form1 = $this->createForm(StructureType::class, $structure);
    $form1->handleRequest($request);
    if ($form1->isSubmitted() && $form1->isValid()) {
      $em = $doctrine->getManager();
      $em->flush();
      return $this->redirectToRoute('app_admin_');
    }
    return $this->render('admin/structure/create.html.twig', [
      "form1" => $form1->createView()
    ]);
  }

  #[Route('/structure/delete/{id<\d+>}', name: "delete_structure")]
  public function delete(Structure $structure, ManagerRegistry $doctrine): Response
  {
    $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
    $em = $doctrine->getManager();
    $em->remove($structure);
    $em->flush();
    return $this->redirectToRoute('app_admin_');
  }
}
