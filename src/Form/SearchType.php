<?php

namespace App\Form;

use App\Entity\Search;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class SearchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('minrooms', IntegerType::class, [
                'required' => false,
                'label' => false,
            ])
            ->add('maxrooms', IntegerType::class, [
                'required' => false,
                'label' => false,
            ])
            ->add('minsurface', IntegerType::class, [
                'required' => false,
                'label' => false,
            ])
            ->add('maxsurface', IntegerType::class, [
                'required' => false,
                'label' => false,
            ])
            ->add('minprice', IntegerType::class, [
                'required' => false,
                'label' => false,
            ])
            ->add('maxprice', IntegerType::class, [
                'required' => false,
                'label' => false,
            ])
            ->add('submit', SubmitType::class, ['label' => 'Search'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Search::class,
            'method' => 'GET',
            'csrf_protection' => false,
        ]);
    }
}
