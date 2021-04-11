<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\FieldRepository;

class FieldController extends AbstractController
{
    #[Route('/field', name: 'field')]
    /**
     * Affiche la liste des terrains
     * 
     * @param FieldRepository $fieldRepository
     * 
     * @return Response
     */
    public function index(FieldRepository $fieldRepository): Response
    {
        return $this->render('field/index.html.twig', [
            'fields' => $fieldRepository->findAll(),
        ]);
    }
}
