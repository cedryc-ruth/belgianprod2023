<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Movie;

class MovieController extends AbstractController
{
    #[Route('/movie', name: 'app_movie')]
    public function index(): Response
    {
        return $this->render('movie/index.html.twig', [
            'controller_name' => 'MovieController',
        ]);
    }

    #[Route('/movie/{id}', 
        name: 'app_movie_show',
        requirements: ['id' => '\d+'])]
    public function show(EntityManagerInterface $em, int $id): Response
    {
        $movieRepository = $em->getRepository(Movie::class);

        $movie = $movieRepository->find($id);

        return $this->render('movie/show.html.twig', [
            'movie' => $movie,
        ]);
    }

    #[Route('/movie/{slug}', name: 'app_movie_show_by_slug')]
    public function showBySlug(EntityManagerInterface $em, string $slug): Response
    {
        $movieRepository = $em->getRepository(Movie::class);

        $movie = $movieRepository->findOneBy([
            'slug' => $slug,
        ]);

        return $this->render('movie/show.html.twig', [
            'movie' => $movie,
        ]);
    }
}
