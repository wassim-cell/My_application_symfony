<?php

namespace App\Form;

use App\Entity\Post;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class FormType extends AbstractType
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
                    
                    'data-sb-validations' => 'required' ,                
            ]])
            ->add('email',EmailType::class,[
                'attr' => [
                    
                    'class' => 'form-group' ,
                    'placeholder' => 'Enter Your email here' ,
                    'class' => 'form-control' ,
                    
                    
                    'data-sb-validations' => 'required'                 
            ]])
            ->add('phone',NumberType::class,[
                'attr' => [
                    'class' => 'form-group' ,
                    'placeholder' => 'Enter Your phone here' ,
                    'class' => 'form-control' ,
                    'data-sb-validations' => 'required'                 
            ]])
            ->add('message',TextareaType::class,[
                'attr' => [
                    'class' => 'form-group form-group-textarea mb-md-0' ,
                    'placeholder' => 'Enter Your message here' ,
                    'class' => 'form-control' ,
                    'data-sb-validations' => 'required'                 
            ]])
         

            ->add('send',SubmitType::class,[
                'attr' => [
                   'onclick' => 'ClearFields()' ,
                   'class' => 'btn btn-primary btn-xl text-uppercase ' ,
                   
                  ]
                ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Post::class,
        ]);
    }
}
