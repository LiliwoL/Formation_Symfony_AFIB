<?php

namespace AppBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\ResetType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

use Symfony\Component\HttpFoundation\Request;

use AppBundle\Model\Livre;
use Symfony\Component\HttpFoundation\Response;

class LivreController extends Controller
{
    /**
     * @Route("/formulairelivre/index")
     */
    public function indexAction( Request $request )
    {
		/**
		 * Instanciation Modèle Livre
		 */
    	$livre = new Livre();



		/**
		 *
		 * Création du formumaire lié au modèle Livre instancié précédemment
		 *
		 * Nouveautés Symfony 3
		 * On doit utiliser TextType::class et plus seulement 'text'
		 */
    	$form = $this->createFormBuilder( $livre )
			->add( 'isbn', TextType::class, array(
				'data' 		=> "ISBN par défaut",
				'required' 	=> true,
				//'disabled'	=> true
			) )
			->add( 'titre', TextType::class, array(
				'label' 	=> "Label du champ Titre",
				'attr'		=> array("ma_classe")
			) )
			->add( 'dateParution', DateType::class )

			/**
			 * Ajout du champ Auteur à partir de l'Entity Auteur
			 *
			 * http://symfony.com/doc/current/reference/forms/types/entity.html
			 */
			->add('auteur', EntityType::class, array(
				'class'			=> 'AppBundle:Auteur',
				'choice_label'	=> 'prenom'
			))


			/**
			 * Ajout du champ Auteur à partir de l'Entity Bibliotheque
			 *
			 * http://symfony.com/doc/current/reference/forms/types/entity.html
			 */
			->add('bibliotheque', EntityType::class, array(
				'class'			=> 'GeoBundle:Bibliotheque',
				'choice_label'	=> 'nom',

				/**
				 * Pour spécifier l'Entity Manager
				 */
				'em'			=> 'geo'
			))


			->add( 'Valider', SubmitType::class)
			->add( 'Reset', ResetType::class)
			->getForm();



		/**
		 * Traitement de la requête
		 */
    	$form->handleRequest( $request );
		/**
		 * est équivalent à:
		 *
		 * if ( $request->isMethod('POST') ) {
		 * 		$form->submit( $request );
		 * }
		 *
		 */




    	if ( $form->isValid() ) {

    		var_dump ( $form->getData() );

    		return new Response( 'Le formulaire est valide et soumis' );
		}



		/**
		 * Envoi du formulaire généré à la vue sous forme d'un paramètre
		 *
		 * Attention! le formulaire n'est pas envoyé tel quel!
		 * On utilise la méthode createView()
		 */
        return $this->render('AppBundle:Livre:index.html.twig', array(
            'formulaireLivre' => $form->createView()
        ));
    }
}
