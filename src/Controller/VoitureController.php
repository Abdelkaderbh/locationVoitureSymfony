<?php

namespace App\Controller;

use App\Entity\Voiture;
use App\Form\CarForm;
use App\Repository\VoitureRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;



class VoitureController extends AbstractController
{

    #[Route('/voiture', name: 'app_voiture')]
    public function listVoiture(VoitureRepository $vr):Response {
        $cars = $vr->findAll();
        return $this->render("voiture/carsList.html.twig",[
            "cars"=>$cars,
        ]);
    }



    #[Route("/addCar",name:'add_voiture')]
    public function addCar(Request $request,EntityManagerInterface $entityManager):Response{
        $voiture = new Voiture();
        $form = $this->createForm(CarForm::class,$voiture);
        $form->handleRequest($request);
        if ($form->isSubmitted()&&$form->isValid()){
            $entityManager->persist($voiture);
            $entityManager->flush();
            return $this->redirectToRoute('app_voiture');
        }
        return $this->render("voiture/addVoiture.html.twig",[
            'formCar'=>$form->createView()
        ]);
    }


    #[Route("/updateCar/{id}",name: 'updateCar')]
    public function updateCar ($id,VoitureRepository $vr,Request $req,EntityManagerInterface $em):Response{
        $voiture = $vr->find($id);
        $updateForm = $this->createForm(CarForm::class,$voiture);
        $updateForm->handleRequest($req);

        if ($updateForm->isSubmitted() && $updateForm->isValid()){
            $em->persist($voiture);
            $em->flush();
            return $this->redirectToRoute('app_voiture');
        }
        return $this->render('voiture/updateCar.html.twig',[
            'editForm'=>$updateForm->createView()
        ]);
    }


    #[Route("/deletevoiture/{id}",name:'deleteCar')]
    public function deleteVoiture($id,EntityManagerInterface $entityManager,VoitureRepository $vr):Response{
        $voiture = $vr->find($id);

        if($voiture != null){
            $entityManager->remove($voiture);
            $entityManager->flush();
        }
        return $this->RedirectToRoute('app_voiture');
    }
    #[Route("/SearchVoiture",name:'searchCar')]
public function searchCar(Request $request,EntityManagerInterface $entityManager):Response{
        $voiture = null;
        if ($request->isMethod('POST')){
            $serie = $request->request->get('input_serie');
            $query= $entityManager->createQuery(
                "select v from App\Entity\Voiture v where v.Serie like'".$serie."'");
            $voiture= $query->getResult();
        }
        return $this->render("voiture/rechercheVoiture.html.twig",["voiture"=>$voiture]);
    }

    #[Route("/SearchByModel",name: 'seachByModel')]
    public function searchByModele(Request $request,EntityManagerInterface $entityManager):Response{
        $voiture = null ;
        if ($request->isMethod('POST')){
            $modele = $request->request->get('modeleText');
            $query=$entityManager->createQuery(
                "select v from App\Entity\Voiture v 
                join v.modele m where m.libelle like' ". $modele ."'");
                $voiture=$query->getResult();
        }
        return $this->render("voiture/sercachbymodel.html.twig",["voiture"=>$voiture]);
    }




    }
