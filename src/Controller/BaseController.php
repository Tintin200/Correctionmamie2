<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Repository\TypeCafeRepository;

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
}
