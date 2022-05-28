<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Common\Persistence\ManagerRegistry;
use App\Repository\ProduitRepository;
use Symfony\Component\Asset\Package;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Produit;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\String\Slugger\SluggerInterface;
use App\Form\ProduitType;

class PortfilioController extends AbstractController
{
    #[Route('/portfilio', name: 'app_portfilio')]
    public function index(ProduitRepository $produitRepository): Response
    {
        $product = $produitRepository->findAll() ;
        
        return $this->render('portfilio/index.html.twig', [
            'product' => $product ,
        ]);
    }

    #[Route('/Product/{id}', name: 'produit.detaill')]
    public function show(int $id, ProduitRepository $postRepository): Response
    {
        $product = $postRepository
            ->find($id);

        return $this->render('Products/Productwith.html.twig', [
            'product' => $product ,
        ]);
    }
   // #[Route('/Produit', name: 'produit.detal')]
   // public function sow(): Response
//    {
        
    //    return $this->render('Products/Productwith.html.twig',[]
           
     //   );
    //}
    #[Route('/portfilioForm', name: 'app_portfilioForm')]
    public function form(Request $request,EntityManagerInterface $entityManager)
    {
        // creates a task object and initializes some data for this example
        $product = new Produit();

        $form = $this->createForm(ProduitType::class,$product,[
            'attr' => [
                 'action' => $this->generateUrl('app_portfilioForm') ,
                 
            ]
        ]);
        
        $form->handleRequest($request);
        
        
        if ($form->isSubmitted() && $form->isValid()) {
            // $form->getData() holds the submitted values
            // but, the original `$task` variable has also been updated
              /** @var UploadedFile $brochureFile */
              $brochureFile = $form->get('imageFile')->getData();

              // this condition is needed because the 'brochure' field is not required
              // so the PDF file must be processed only when a file is uploaded
              if ($brochureFile) {
                  $originalFilename = pathinfo($brochureFile->getClientOriginalName(), PATHINFO_FILENAME);
                  // this is needed to safely include the file name as part of the URL
                  $upload_Directory = $this->getParameter('brochures_directory') ;
                  
                  $newFilename = $originalFilename.'-'.uniqid().'.'.$brochureFile->guessExtension();
  
                  // Move the file to the directory where brochures are stored
                  
                      $brochureFile->move(
                          $upload_Directory,
                          $newFilename) ;
                      
                  
                  // updates the 'brochureFilename' property to store the PDF file name
                  // instead of its contents
                  $product->setImageFile($newFilename);
              }
            $entityManager->persist($product);
            $entityManager->flush();
            
        
            
        }  
         
       
        return $this->render('portfilio/form.html.twig',
        [ 'form' => $form->createView() ]
       );
        
    }
}
