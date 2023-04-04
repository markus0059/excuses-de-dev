<?php

namespace App\Controller;

use App\Repository\ExcuseRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\Length;

#[Route('/', name: 'excuse_')]
class ExcuseController extends AbstractController
{
  #[Route('/', name: 'afficher_donnees')]
  public function randomExcuse(ExcuseRepository $excuseRepository): Response
  {
    // je recupère tous les excuses
    $excuses = $excuseRepository->findAll();
    // je prend le nombre total des entités excuses
    $numbermax= count($excuses);
    // je créer un index random qui prend en compte le nombre d'élément de mon array excuse
    // je retire 1 pour l'index 0
    $indexrandom= rand(0, $numbermax-1);
    // enfin je recupère l'excuse qui conrespond à l'index de mon tableau d'excuses et cela alétoirement
    $randexcuse = $excuses[$indexrandom];

    return $this->render('base.html.twig', [
      'randexcuse' => $randexcuse,
    ]);

  }

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
    $sentence = "";

    return $this->render('excuse/error404.html.twig', [
      'sentence' => $sentence,
    ]);
  }

  #[Route('/$http_code/{excuseHttpCode}', methods: ['GET'], name: 'show')]
  public function show(string $excuseHttpCode, ExcuseRepository $excuseRepository): Response
  {
    $excuse = $excuseRepository->findOneByHttpcode($excuseHttpCode);



    if (!$excuse) {

      $sentence = 'Pas d \' excuses avec le code http : ' . $excuseHttpCode . ' trouvé';


      return $this->render('excuse/error404.html.twig', [
        'sentence' => $sentence,
      ]);
    }

    return $this->render('excuse/show.html.twig', [
      'excuse' => $excuse,
    ]);
  }
}
