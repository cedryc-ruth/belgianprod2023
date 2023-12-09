<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Actor;

class ActorController extends AbstractController
{
    #[Route('/actor', name: 'app_actor')]
    public function index(EntityManagerInterface $em): Response
    {
        $actorRepository = $em->getRepository(Actor::class);
        $actors = $actorRepository->findAll();

        return $this->render('actor/index.html.twig', [
            'actors' => $actors,
        ]);
    }
}
