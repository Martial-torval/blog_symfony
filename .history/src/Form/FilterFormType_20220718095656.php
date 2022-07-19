<?php

namespace App\Form;

use App\Entity\FilterSearch;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FilterFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('category')
            ->add('releaseDate')
            ->add('submit', SubmitType::class, [
                'label' => 'Use those filters'  
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => FilterSearch::class,
        ]);
    }
}
