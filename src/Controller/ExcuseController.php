<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ExcuseRepository;
use App\Form\ExcuseType;
use App\Entity\Excuse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


#[Route('/', name: 'excuse_')]
class ExcuseController extends AbstractController
{
  #[Route('/', name: 'afficher_donnees')]
  public function randomExcuse(Request $request, ExcuseRepository $excuseRepository): Response
  {
    // je recupère tous les excuses
    $excuses = $excuseRepository->findAll();
    // je prend le nombre total des entités excuses
    $numbermax = count($excuses);
    // je créer un index random qui prend en compte le nombre d'élément de mon array excuse
    // je retire 1 pour l'index 0
    $indexrandom = rand(0, $numbermax - 1);
    // enfin je recupère l'excuse qui conrespond à l'index de mon tableau d'excuses et cela alétoirement
    $randexcuse = $excuses[$indexrandom];

    // création du formulaire pour la modal
    $excuse = new Excuse();
    $form = $this->createForm(ExcuseType::class, $excuse);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
      $excuseRepository->save($excuse, true);

      return $this->redirectToRoute('excuse_list', [], Response::HTTP_SEE_OTHER);
    }

    // renvoie des données dans la vue
    return $this->render('base.html.twig', [
      'randexcuse' => $randexcuse,
      'excuse' => $excuse,
      'form' => $form,
    ]);
    $this->renderForm('excuse/add.html.twig', [
      'excuse' => $excuse,
      'form' => $form,
    ]);
  }

  #[Route('/list', name: 'list')]
  public function index(ExcuseRepository $excuseRepository): Response
  {

    // je recupère tous les excuses
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
    // recuperer excuse avec le code http paasé dans l'url du chemin.
    $excuse = $excuseRepository->findOneByHttpcode($excuseHttpCode);

    // si le code n'existe pas afficher une erreur
    if (!$excuse) {
      $sentence = 'Pas d \' excuses avec le code http : ' . $excuseHttpCode . ' trouvé';

      return $this->render('excuse/error404.html.twig', [
        'sentence' => $sentence,
      ]);
    }

    // si le code existe renvoyé la vue de l'excuse concernée
    return $this->render('excuse/show.html.twig', [
      'excuse' => $excuse,
    ]);
  }
}
