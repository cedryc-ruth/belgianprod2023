<?php

namespace App\Controller;

use App\Entity\Category;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;

class CategoryController extends AbstractController
{
    #[Route('/category', name: 'app_category')]
    public function index(EntityManagerInterface $em): Response
    {
        //Récupérer les catégories
        $repository = $em->getRepository(Category::class);

        $categories = $repository->findAll();

        return $this->render('category/index.html.twig', [
            'title' => 'Liste des catégories',
            'categories' => $categories,
        ]);
    }

    #[Route('/category/{id}', name: 'app_category_show')]
    public function show(EntityManagerInterface $em, int $id): Response
    {
        $repository = $em->getRepository(Category::class);
        $category = $repository->find($id);

        return $this->render('category/show.html.twig', [
            'title' => 'Fiche catégorie',
            'category' => $category,
        ]);
    }
}
