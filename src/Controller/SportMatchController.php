<?php

namespace App\Controller;

use App\Entity\SportMatch;
use App\Form\SportMatchType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\SportMatchRepository;

class SportMatchController extends AbstractController
{
    #[Route('/sport-match', name: 'sport_match')]
    /**
     * Affiche la liste des matchs
     * 
     * @param SportMatchRepository $sportMatchRepository
     * 
     * @return Reponse
     */
    public function index(SportMatchRepository $sportMatchRepository): Response
    {
        return $this->render('sport_match/index.html.twig', [
            'sportMatchs' => $sportMatchRepository->findAll(),
        ]);
    }

    #[Route('/sport-match/create', name: 'sport_match_create')]
    /**
     * Crée un match
     * 
     * @param Request $request
     * 
     * @return Reponse
     */
    public function create(Request $request): Response
    {
        $sportMatch = new SportMatch();
        $sportMatchForm = $this->createForm(SportMatchType::class, $sportMatch);

        $sportMatchForm->handleRequest($request);
        if($sportMatchForm->isSubmitted() && $sportMatchForm->isValid()){
            $manager = $this->getDoctrine()->getManager();
            $manager->persist($sportMatch);
            $manager->flush();
    
            return $this->redirectToRoute('sport_match');
        }

        return $this->render('sport_match/create.html.twig', [
            'sportMatchForm' => $sportMatchForm->createView(),
        ]);
    }

    #[Route('/sport-match/{id}', name: 'sport_match_show')]
    /**
     * Affiche les détails du tournois
     * 
     * @param SportMatch            $sportMatch
     * 
     * @return Response
     */
    public function show(SportMatch $sportMatch): Response
    {
        return $this->render('sport_match/show.html.twig', [
            'sportMatch' => $sportMatch
        ]);
    }
}
