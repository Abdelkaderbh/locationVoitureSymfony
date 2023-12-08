<?php

namespace App\Form;

use App\Entity\Modele;
use App\Entity\Voiture;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CarForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Serie',TextType::class,[
                'attr'=>['class'=>'form-control',
                ]
            ])
            ->add('Date_Mise_En',DateType::class,[
                'attr'=>['class'=>'form-control',
                ]
            ])
            ->add('Modele',EntityType::class,[
                "class"=>Modele::class,
                "choice_label"=>"libelle"

            ])
            ->add('Prix_jour',NumberType::class,[
                'attr'=>['class'=>'form-control']
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Voiture::class,
        ]);
    }

    public function getName(){
        return "Voiture";
    }
}
