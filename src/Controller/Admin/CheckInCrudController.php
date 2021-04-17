<?php

namespace App\Controller\Admin;

use App\Entity\CheckIn;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Form\Filter\Type\EntityFilterType;

class CheckInCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return CheckIn::class;
    }

    public function configureFields(string $pageName): iterable
    {
        $fields = [
            TextField::new('duration', 'Durée'),
            AssociationField::new('user', 'Utilisateur'),
            AssociationField::new('site', 'Chantier'),
        ];

        if ($pageName == Crud::PAGE_INDEX || $pageName == Crud::PAGE_DETAIL) {
            $fields[] = DateTimeField::new('createdAt', 'Date début');
        }

        return $fields;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('Pointage')
            ->setEntityLabelInPlural('Pointages')
            ;
    }

}
