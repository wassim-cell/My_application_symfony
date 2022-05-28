<?php

namespace App\Form;

use App\Entity\Produit;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class ProduitType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name',TextType::class,[
                'attr' => [
                    'id' => 'name1' ,
                    "class" => "form-group" ,
                    'class' => ' form-control' ,
                    'placeholder' => 'Enter Your name here' ,              
            ]])
            ->add('message',TextType::class,[
                'attr' => [
                    
                    "class" => "form-group" ,
                    'class' => ' form-control' ,
                    'placeholder' => 'Enter Your message here' ,
                    
                    'data-sb-validations' => 'required' ,                
            ]])
            ->add('discription',TextareaType::class,[
                'attr' => [
                    'class' => 'form-group form-group-textarea mb-md-0' ,
                    'placeholder' => 'Enter Your discription here' ,
                    'class' => 'form-control' ,
                    'data-sb-validations' => 'required'                 
            ]])
            ->add('imageFile',FileType::class,[
                'mapped' => false ,
                'required' => false ,
                
            ]) 
            ->add('save',SubmitType::class,[
                'attr' => [
                    'class' => 'btn btn-primary' ,
                    'style' => 'width:150px',
                    'data-sb-validations' => 'required'                 
            ]])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Produit::class,
        ]);
    }
}
