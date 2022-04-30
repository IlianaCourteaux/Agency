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
                'label' => 'Min Rooms',
            ])
            ->add('maxrooms', IntegerType::class, [
                'required' => false,
                'label' => 'Max Rooms',
            ])
            ->add('minsurface', IntegerType::class, [
                'required' => false,
                'label' => 'Min Surface',
            ])
            ->add('maxsurface', IntegerType::class, [
                'required' => false,
                'label' => 'Max Surface',
            ])
            ->add('minprice', IntegerType::class, [
                'required' => false,
                'label' => 'Min Price',
            ])
            ->add('maxprice', IntegerType::class, [
                'required' => false,
                'label' => 'Max Price',
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

    public function getBlockPrefix()
    {
        return '';
    }
}
