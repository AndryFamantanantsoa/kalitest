<?php

namespace App\Controller\Admin;

use App\Entity\Site;
use App\Repository\CheckInRepository;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\KeyValueStore;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class SiteCrudController extends AbstractCrudController
{
    /**
     * @var CheckInRepository
     */
    private $checkInRepository;

    public function __construct(CheckInRepository $checkInRepository)
    {
        $this->checkInRepository = $checkInRepository;
    }

    public static function getEntityFqcn(): string
    {
        return Site::class;
    }

    public function configureResponseParameters(KeyValueStore $responseParameters): KeyValueStore
    {
        if (Crud::PAGE_DETAIL == $responseParameters->get('pageName')) {
            $siteId = $responseParameters->get('entity')->getPrimaryKeyValue();
            $responseParameters->set('totalUsers', $this->checkInRepository->getTotalUsers($siteId));
            $responseParameters->set('totalHours', $this->checkInRepository->getTotalHours($siteId));
        }

        return $responseParameters;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('name', 'Nom'),
            TextField::new('address', 'Adresse'),
            DateTimeField::new('startAt', 'Date de début'),
        ];
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->overrideTemplate('crud/detail', 'admin/site/detail.html.twig')
            ->setEntityLabelInSingular('Chantier')
            ->setEntityLabelInPlural('Chantiers')
            ;
    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions
            ->add(Crud::PAGE_INDEX, Action::DETAIL);
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
