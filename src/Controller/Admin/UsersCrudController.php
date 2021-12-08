<?php

namespace App\Controller\Admin;

use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class UsersCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return User::class;
    }


    /*public function configureFields(string $pageName): iterable
    {
        return [
            'id',
            'email',
            'nom',
            'prenom',
            'adresse',
            'code_postal',
            Field::new('roles'),
        ];
    }*/
}
