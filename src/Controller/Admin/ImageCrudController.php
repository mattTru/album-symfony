<?php

namespace App\Controller\Admin;

use App\Entity\Image;
use App\Field\VichImageField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;

class ImageCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Image::class;
    }

    public function configureFields(string $pageName): iterable
    {
        $id = IdField::new('id')->hideOnForm();
        $album = AssociationField::new('album');
        $titre = TextField::new('titre');
        $description = TextEditorField::new('description');
        $image = ImageField::new('image_name')->setBasePath('/upload')->onlyOnIndex();
        $imageFile = VichImageField::new('imageFile')->hideOnIndex();


        return [$id, $album, $titre, $description, $image, $imageFile];
    }
}
