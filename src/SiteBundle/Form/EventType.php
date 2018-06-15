<?php

namespace SiteBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EventType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('id', HiddenType::class, ['mapped' => false]);
        $builder->add('name', TextType::class, ['mapped' => true]);
        $builder->add('icon', TextType::class, [
            'mapped' => true,
            'required' => false
        ]);
        $builder->add('location', EntityType::class, array(
            'label' => 'Lieu',
            'class' => 'SiteBundle:Location',
            'attr' => ['class' => ''],
            'multiple' => false,
//            'query_builder' => function (AppareilRepository $ar) use ($autor) {
//                return $ar->getAllByAutor($autor);
//            },
//            'choice_label' => 'libelle',
//            'multiple' => false,
        ));
        $builder->add('save', SubmitType::class, array(
        'label' => 'Sauvegarder',
        'attr' => ['class' => ''],
    ));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            [
                'data_class' => 'SiteBundle\Entity\Event',
                'csrf_protection' => false,
            ]
        );
    }
}
