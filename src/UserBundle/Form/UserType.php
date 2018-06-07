<?php

namespace UserBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('id',HiddenType::class, ['mapped' => false]);
        $builder->add('username',HiddenType::class, ['mapped' => true]);
        $builder->add('username_canonical',HiddenType::class, ['mapped' => true]);
        $builder->add('email',HiddenType::class, ['mapped' => true]);
        $builder->add('email_canonical',HiddenType::class, ['mapped' => true]);
        $builder->add('enabled',HiddenType::class, ['mapped' => true]);
        $builder->add('salt',HiddenType::class, ['mapped' => false]);
        $builder->add('password',HiddenType::class, ['mapped' => false]);
        $builder->add('confirmation_token',HiddenType::class, ['mapped' => false]);
        $builder->add('password_requested_at',HiddenType::class, ['mapped' => false]);
        $builder->add('last_login',HiddenType::class, ['mapped' => false]);
        $builder->add('roles',HiddenType::class, ['mapped' => true]);

        $builder->add('presentation',HiddenType::class, ['mapped' => true]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            [
                'data_class' => 'UserBundle\Entity\User',
                'csrf_protection' => false,
            ]
        );
    }
}
