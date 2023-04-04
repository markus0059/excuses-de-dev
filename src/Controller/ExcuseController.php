<?php

namespace App\Controller;

use App\Repository\ExcuseRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/', name: 'excuse_')]
class ExcuseController extends AbstractController
{
    #[Route('/list', name: 'list')]
    public function index(ExcuseRepository $excuseRepository): Response
    {
        $excuses = $excuseRepository->findAll();
        return $this->render('excuse/index.html.twig', [
          'excuses' => $excuses,
        ]);
    }

    #[Route('/lost', name: 'lost')]
    public function lost(): Response
    {

      $sentence = "I'm lost";

      return $this->render('excuse/lost.html.twig', [
        'sentence' => $sentence,
      ]);

    }

    #[Route('/*', name: 'error')]
    public function error(): Response
    {
      $sentence = "Error 404 ";

      return $this->render('excuse/error404.html.twig', [
        'sentence' => $sentence,
      ]);
    }
}
