<?php

namespace App\Controller;

use App\Entity\Tournament;
use App\Form\TournamentType;
use App\Repository\TournamentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class TournamentController extends AbstractController
{
    #[Route('/tournament', name: 'tournament')]
    /**
     * Affiche la liste des tournois
     * 
     * @param TournamentRepository $tournamentRepository
     */
    public function index(TournamentRepository $tournamentRepository): Response
    {
        return $this->render('tournament/index.html.twig', [
            'tournaments' => $tournamentRepository->findAll(),
        ]);
    }

    #[Route('/tournament-create', name: 'tournament_create')]
    /**
     * Crée un tournois
     * 
     * @param Request $request
     * 
     * @return Response
     */
    public function create(Request $request): Response
    {
        $tournament = new Tournament();
        $tournamentForm = $this->createForm(TournamentType::class, $tournament);

        $tournamentForm->handleRequest($request);
        if($tournamentForm->isSubmitted() && $tournamentForm->isValid()){
            $manager = $this->getDoctrine()->getManager();
            $manager->persist($tournament);
            $manager->flush();
    
            return $this->redirectToRoute('tournament');
        }

        return $this->render('tournament/create.html.twig', [
            'tournamentForm' => $tournamentForm->createView(),
        ]);
    }
}
