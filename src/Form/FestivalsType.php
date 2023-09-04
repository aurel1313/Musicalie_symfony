<?php

namespace App\Form;

use App\Entity\Artistes;
use App\Entity\Festivals;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FestivalsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom')
            ->add('Date', DateTimeType::class, [
                'widget' => 'single_text',
            ])
            ->add('affiche')
            ->add('lieu')
            ->add('artistes', EntityType::class, [
                "class" => Artistes::class,
                "expanded" => true,
                "multiple" => true,
                "by_reference" => false
            ])
            ->add('departements')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Festivals::class,
        ]);
    }
}
