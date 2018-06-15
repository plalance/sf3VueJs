<?php

namespace SiteBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LocationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
//        $builder->add('id', HiddenType::class, ['mapped' => false]);
        $builder->add('name', TextType::class, ['mapped' => true]);
        $builder->add('latitude', HiddenType::class, ['mapped' => true]);
        $builder->add('longitude', HiddenType::class, ['mapped' => true]);
        $builder->add('addressName', TextType::class, [
            'mapped' => true,
            'required' => false
        ]);
//        $builder->add('iconForGoogleMap', TextType::class, [
//            'mapped' => true,
//            'required' => false
//        ]);
        $builder->add('iconForGoogleMap', ChoiceType::class, [
            'choices' => array(
                'Icone Bleue' => 'default-marker.svg',
                'Coeur Vert' => 'green-heart-marker.svg'
            ),
            'mapped' => true,
            'required' => false
        ]);

        $builder->add('save', SubmitType::class, array(
            'label' => 'Sauvegarder',
            'attr' => ['class' => ''],
        ));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            [
                'data_class' => 'SiteBundle\Entity\Location',
                'csrf_protection' => false,
            ]
        );
    }
}
