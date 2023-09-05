<?php

namespace App\Controller;

use App\Entity\Livreur;
use App\Form\LivreurFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LivreurController extends AbstractController
{
    /**
     * @Route("/livreur", name="livreur")
     */
    public function index(): Response
    {
        return $this->render('livreur/index.html.twig', [
            'controller_name' => 'LivreurController',
        ]);
    }


    /**
     * @Route("/add-livreur", name="add_livreur")
     */
    public function addlivreur(Request $request): Response
    {
        $livreur = new livreur();
        $form = $this->createForm(LivreurFormType::class, $livreur);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($livreur);
            $entityManager->flush();
            return $this->redirectToRoute("livreurs");
        }


        return $this->render("livreur/livreur-form.html.twig", [
            "form_title" => "Ajouter un livreur",
            "form_livreur" => $form->createView(),
        ]);
    }



    /**
     * @Route("/modify-livreur/{id}", name="modify_livreur")
     */
    public function modifylivreur(Request $request, int $id): Response
    {
        $entityManager = $this->getDoctrine()->getManager();

        $livreur = $entityManager->getRepository(livreur::class)->find($id);
        $form = $this->createForm(LivreurFormType::class, $livreur);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $entityManager->flush();
            return $this->redirectToRoute("livreurs");

        }


        return $this->render("livreur/livreur-form.html.twig", [
            "form_title" => "Modifier une livreur",
            "form_livreur" => $form->createView(),
        ]);
    }





    /**
     * @Route("/livreurs", name="livreurs")
     */
    public function livreurs()
    {
        $livreurs = $this->getDoctrine()->getRepository(livreur::class)->findAll();

        return $this->render('livreur/livreurs.html.twig', [
            "livreurs" => $livreurs,
        ]);
    }

    

    /**
     * @Route("/delete-livreur/{id}", name="delete_livreur")
     */
    public function deletelivreur(int $id): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $livraison = $entityManager->getRepository(livreur::class)->find($id);
        $entityManager->remove($livraison);
        $entityManager->flush();

        return $this->redirectToRoute("livreurs");
    }
}
