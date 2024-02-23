<?php

namespace App\Controller;

use App\Entity\TypeCafe;
use App\Form\ModifTypeCafeType;
use App\Repository\TypeCafeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class BaseController extends AbstractController
{
    #[Route('/', name: 'app_accueil')]
    public function index(): Response
    {
        return $this->render('base/index.html.twig', [

        ]);
    }

    #[Route('/liste-type-cafe', name: 'app_liste_type_cafe')]
    public function listeTypeCafe(TypeCafeRepository $typeCafeRepository): Response
    {
        $typeCafes = $typeCafeRepository->findAll();
        return $this->render('base/liste-type-cafe.html.twig', [
            'typeCafes' => $typeCafes,
        ]);
    }

    #[Route('/modif-type-cafe/{id}', name: 'app_modif_type_cafe')]
    public function modifTypeCafe(TypeCafe $typeCafe, Request $request, EntityManagerInterface $em): Response
    {
        $form = $this->createForm(ModifTypeCafeType::class, $typeCafe);
        if ($request->isMethod('POST')) {
            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()) {
                $em->persist($typeCafe);
                $em->flush();
            }
        }
        return $this->render('base/modif-type-cafe.html.twig', [
            "form" => $form->createView(),
        ]);
    }
}
