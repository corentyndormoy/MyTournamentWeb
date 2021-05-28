<?php

namespace App\Controller;

use App\Entity\Place;
use App\Entity\Field;
use App\Form\PlaceType;
use App\Form\FieldType;
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


    #[Route('/place/create', name: 'place_create')]
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

    #[Route('/place/add-field/{id}', name: 'place_add_field')]
    /**
     * Crée un terrain pour un lieu
     * 
     * @param Place     $place
     * @param Request   $request
     * 
     * @return Response
     */
    public function addField(Place $place, Request $request): Response
    {
        $field = new Field();
        $fieldForm = $this->createForm(FieldType::class, $field);

        $fieldForm->handleRequest($request);
        if($fieldForm->isSubmitted() && $fieldForm->isValid()){
            $field->setPlace($place);

            $manager = $this->getDoctrine()->getManager();
            $manager->persist($field);
            $manager->flush();
    
            return $this->redirectToRoute('place');
        }

        return $this->render('field/create.html.twig', [
            'fieldForm' => $fieldForm->createView(),
        ]);
    }

    #[Route('/place/{id}', name: 'place_show')]
    /**
     * Affiche les détails du lieu
     * 
     * @param Place $place
     * 
     * @return Response
     */
    public function show(Place $place): Response
    {
        return $this->render('place/show.html.twig', [
            'place' => $place
        ]);
    }
}
