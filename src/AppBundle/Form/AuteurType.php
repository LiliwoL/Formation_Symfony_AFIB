<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\TextType;

use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class AuteurType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(
    	FormBuilderInterface $builder, array $options
	)
    {
        $builder
			->
			->add('nom', TextType::class, array(
					'error_bubbling' => true
				)
			)
			->add('prenom')
			->add('nationalite')
			->add('valider', SubmitType::class);
    }


    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Auteur'
        ));
    }


    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_auteur';
    }


}
