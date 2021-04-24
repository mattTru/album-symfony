<?php

namespace App\Form;

use App\Entity\Image;
use App\Entity\Album;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichImageType;

class ImageFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titre', TextType::class)
            ->add('description', TextType::class)
            ->add('imageFile', VichImageType::class)
            ->add('album', EntityType::class, [
                // looks for choices from this entity
                'class' => Album::class,

                // used to render a select box, check boxes or radios
                // 'multiple' => true,
                // 'expanded' => true,

                'label' => 'Album',

                'label_attr' => ['class' => 'select-album'],
            ])
            ->add('save', SubmitType::class, ['label' => 'Enregistrer'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Image::class,
        ]);
    }
}
