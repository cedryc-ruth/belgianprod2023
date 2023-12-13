<?php

namespace App\Controller;

use App\Entity\Category;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Form\CategoryType;
use Symfony\Component\HttpFoundation\Request;


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

    #[Route('/category/{id}', name: 'app_category_show', requirements : ['id' => "\d+"])]
    public function show(EntityManagerInterface $em, int $id): Response
    {
        $repository = $em->getRepository(Category::class);
        $category = $repository->find($id);

        return $this->render('category/show.html.twig', [
            'title' => 'Fiche catégorie',
            'category' => $category,
        ]);
    }

    #[Route('/category/new', name: 'app_category_new')]
    public function new(EntityManagerInterface $em, Request $request): Response
    {
        //Créer l'entité
        $category = new Category();

        //Créer le formulaire
        $form = $this->createForm(CategoryType::class, $category);

        $form->handleRequest($request);

        //Traiter le formulaire
        if($form->isSubmitted() && $form->isValid()) {
            $category = $form->getData();

            $em->persist($category);

            $em->flush();

            if($category->getId()) {
                return $this->redirectToRoute('app_category');
            } 
        }

        //Afficher le formulaire
        return $this->render('category/new.html.twig', [
            'form' => $form,
            'title' => "Ajout d'une catégorie",
        ]);
    }
}
