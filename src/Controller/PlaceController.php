<?php

namespace App\Controller;

use App\Entity\Place;
use App\Form\PlaceType;
use App\Repository\PlaceRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class PlaceController extends AbstractController
{
    #[Route('/place', name: 'place')]
    /**
     * Affiche la liste des lieux
     * 
     * @param PlaceRepository $placeRepository
     * 
     * @return Response
     */
    public function index(PlaceRepository $placeRepository): Response
    {
        return $this->render('place/index.html.twig', [
            'places' => $placeRepository->findAll(),
        ]);
    }


    #[Route('/place-create', name: 'place_create')]
    /**
     * Crée un lieu
     * 
     * @param Request $request
     * 
     * @return Response
     */
    public function create(Request $request): Response
    {
        $place = new Place();
        $placeForm = $this->createForm(PlaceType::class, $place);

        $placeForm->handleRequest($request);
        if($placeForm->isSubmitted() && $placeForm->isValid()){
            $manager = $this->getDoctrine()->getManager();
            $manager->persist($place);
            $manager->flush();
    
            return $this->redirectToRoute('place');
        }

        return $this->render('place/create.html.twig', [
            'placeForm' => $placeForm->createView(),
        ]);
    }
}
