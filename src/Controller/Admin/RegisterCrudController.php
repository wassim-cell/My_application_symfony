<?php

namespace App\Controller\Admin;

use App\Entity\Register;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class RegisterCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Register::class;
    }

    /*
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
        ];
    }
    */
}
