<?php

namespace App\Controller;

use App\Entity\Module;
use App\Entity\Structure;
use App\Form\ModuleType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin', name: "app_admin_")]
class ModuleController extends AbstractController
{
  #[Route('/module/{id<\d+>}', name: 'list_module')]
  public function list(Structure $structure): Response
  {
    $module = $structure->getModule();

    return $this->render('admin/module/list.html.twig', [
      'structure' => $structure,
      'module' => $module
    ]);
  }

  #[Route('/module/edit/{id<\d+>}', name: "edit_module")]
    public function update(Request $request, Module $module, ManagerRegistry $doctrine): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $form2 = $this->createForm(ModuleType::class, $module);
        $form2->handleRequest($request);
        if ($form2->isSubmitted() && $form2->isValid()) {
            $em = $doctrine->getManager();
            $em->flush();
            return $this->redirectToRoute('app_admin_structure');
        }
        return $this->render('admin/module/create.html.twig', [
            "form2" => $form2->createView()
        ]);
    }

    #[Route('/module/delete/{id<\d+>}', name: "delete_module")]
    public function deletemodule(Module $module, ManagerRegistry $doctrine): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $em = $doctrine->getManager();
        $em->remove($module);
        $em->flush();
        return $this->redirectToRoute('app_admin_');
    }

}
