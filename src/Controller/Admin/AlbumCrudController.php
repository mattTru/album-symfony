<?php

namespace App\Controller\Admin;

use App\Entity\Album;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class AlbumCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Album::class;
    }

    public function configureFields(string $pageName): iterable
    {
        $id = IdField::new('id')->hideOnForm();
        $user = AssociationField::new('utilisateur');
        $titre = TextField::new('titre');
        $description = TextEditorField::new('description');
        $isPublic = BooleanField::new('isPublic');

        return [$id, $user, $titre, $description, $isPublic];
    }
}
