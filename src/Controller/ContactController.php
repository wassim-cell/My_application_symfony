<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Post;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\String\Slugger\SluggerInterface;
use App\Form\FormType;

class ContactController extends AbstractController
{
    #[Route('/contact', name: 'app_contact')]
    public function index(Request $request,EntityManagerInterface $entityManager)
    {
        // creates a task object and initializes some data for this example
        $product = new Post();

        $form = $this->createForm(FormType::class,$product,[
            'attr' => [
                 'action' => $this->generateUrl('app_contact') ,
                 
            ]
        ]);
        
        $form->handleRequest($request);
        
        
        
        if ($form->isSubmitted() && $form->isValid()) {
           
            $entityManager->persist($product);
            $entityManager->flush();
            
            $this->addFlash('success','votre message a ete recu');
            // ... persist the $product variable or any other work
            

            
        } else { 
            $this->addFlash('danger','vous devez au moins remplir le email et message ');
        }
    
       
        return $this->render('contact/index.html.twig',
        [ 'form' => $form->createView() ]
       );
        
    }
}



