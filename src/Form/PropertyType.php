<?php
namespace App\Form;

use App\Entity\Properties;
use App\Repository\OptionsRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

final class PropertyType extends AbstractType
{

    public function __construct(OptionsRepository $repo)
    {
        $this->repo=$repo;        
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title')
            ->add('surface')
            ->add('price')
            ->add('floors')
            ->add('rooms')
            ->add('city')
            ->add('type')
            ->add('transactiontype')
            ->add('slug')
            ->add('option', ChoiceType::class, [
                'choices' => $this->getOptions(),
                'expanded'=>true,
                'multiple'=>true,
                'choice_label'=>function($choice, $key, $value){
                    return $choice->getName();
                },
                'mapped'=>false
            ])
            ->add('photo', FileType::class, ['mapped' => false, 'required' => false])
            ->add('status', ChoiceType::class, [
                'choices'  => [
                    'On the market' => true,
                    'Sold or rented' => false,
                ],
            ])
            ->add('submit', SubmitType::class, ['label' => 'Add'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Properties::class,
        ]);
    }

    public function getOptions()
    {
        return $this->repo->findAll();
    }
}
