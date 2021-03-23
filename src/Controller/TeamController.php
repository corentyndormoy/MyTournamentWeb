<?php

namespace App\Controller;

use App\Entity\Team;
use App\Form\TeamType;
use App\Repository\TeamRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class TeamController extends AbstractController
{
    #[Route('/team', name: 'team')]
    /**
     * Affiche la liste des équipes
     * 
     * @param TeamRepository $teamRepository
     * 
     * @return Reponse
     */
    public function index(TeamRepository $teamRepository): Response
    {
        return $this->render('team/index.html.twig', [
            'teams' => $teamRepository->findAll(),
        ]);
    }

    #[Route('/team/create', name: 'team_create')]
    /**
     * Crée une équipe
     * 
     * @param Request $request
     * 
     * @return Response
     */
    public function create(Request $request): Response
    {
        $team = new Team();
        $teamForm = $this->createForm(TeamType::class, $team);

        $teamForm->handleRequest($request);
        if($teamForm->isSubmitted() && $teamForm->isValid()){
            $manager = $this->getDoctrine()->getManager();
            $manager->persist($team);
            $manager->flush();
    
            return $this->redirectToRoute('team');
        }

        return $this->render('team/create.html.twig', [
            'teamForm' => $teamForm->createView(),
        ]);
    }

    #[Route('/team/{id}', name: 'team_show')]
    /**
     * Affiche les détails de l'équipe
     * 
     * @param Team $team
     * 
     * @return Response
     */
    public function show(Team $team): Response
    {
        return $this->render('team/show.html.twig', [
            'team' => $team
        ]);
    }
}
