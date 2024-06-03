<?php

namespace App\Controller;

use App\Repository\CategoryRepository;
use App\Repository\ProgramRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/category', name: 'category_')]

class CategoryController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(CategoryRepository $categoryRepository): Response
    {
        $categories = $categoryRepository->findAll();

        return $this->render('category/index.html.twig', [
            'categories' => $categories
        ]);
    }

    #[Route('/{categoryName}', methods: ['GET'], name: 'show')]
    public function show(string $categoryName, CategoryRepository $categoryRepository, ProgramRepository $programRepository): Response
    {
        $category = $categoryRepository->findOneBy(['name' => $categoryName]);

        $movies = $programRepository->findBy(
            ['category' => $category],
            ['id' => 'DESC'],
            limit: 3,
        );

        if (!$category) {
            throw $this->createNotFoundException(
                'Pas de film dans la catégorie : '.$categoryName.' en base de données.'
            );
        }
        return $this->render('category/show.html.twig', [
            'category' => $category,
            'movies' => $movies,
        ]);
    }
}
