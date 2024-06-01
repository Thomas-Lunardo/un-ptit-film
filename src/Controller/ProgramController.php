<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/program', name: 'program_')]
class ProgramController extends AbstractController
{
    #[Route('/', name: '_index')]
    public function index(): Response
    {
        return $this->render('program/index.html.twig', [
            'website' => 'Un p\'tit film',
        ]);
    }

    #[Route('/{id}', requirements: ['id'=>'\d+'], methods: ['GET'], name: 'show')]
    public function show(): Response
    {
        return $this->render('program/show.html.twig', [
            'id' => '4',
        ]);
    }
}
