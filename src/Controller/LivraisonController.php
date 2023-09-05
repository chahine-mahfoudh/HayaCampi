<?php

namespace App\Controller;

use App\Entity\Livraison;
use App\Form\LivraisonFormType;
use App\Repository\LivraisonRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;



class LivraisonController extends AbstractController
{




    /**
     * @Route("/livraison", name="livraison")
     */
    public function index(): Response
    {
        return $this->render('livraison/index.html.twig', [
            'controller_name' => 'LivraisonController',
        ]);
    }



    /**
     * @Route("/add-livraison", name="add_livraison")
     */
    public function addlivraison(Request $request): Response
    {
        $livraison = new livraison();
        $form = $this->createForm(livraisonFormType::class, $livraison);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($livraison);
            $entityManager->flush();
            return $this->redirectToRoute("livraisons");
        }

        return $this->render("livraison/livraison-form.html.twig", [
            "form_title" => "Ajouter une livraison",
            "form_livraison" => $form->createView(),
        ]);
    }



    /**
     * @Route("/modify-livraison/{id}", name="modify_livraison")
     */
    public function modifylivraison(Request $request, int $id): Response
    {
        $entityManager = $this->getDoctrine()->getManager();

        $livraison = $entityManager->getRepository(livraison::class)->find($id);
        $form = $this->createForm(LivraisonFormType::class, $livraison);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $entityManager->flush();
            return $this->redirectToRoute("livraisons");
        }

        return $this->render("livraison/livraison-form.html.twig", [
            "form_title" => "Modifier une livraison",
            "form_livraison" => $form->createView(),
        ]);
    }



    /**
     * @Route("/livraisons", name="livraison")
     */
    public function livraisons()
    {
        $livraisons = $this->getDoctrine()->getRepository(livraison::class)->findAll();

        return $this->render('livraison/livraisons.html.twig', [
            "livraisons" => $livraisons,
        ]);
    }


    /**
     * @Route("/delete-livraison/{id}", name="delete_livraison")
     */
    public function deletelivraison(int $id): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $livraison = $entityManager->getRepository(livraison::class)->find($id);
        $entityManager->remove($livraison);
        $entityManager->flush();

        return $this->redirectToRoute("livraisons");
    }

}
