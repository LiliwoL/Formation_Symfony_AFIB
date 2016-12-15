<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

use AppBundle\Entity\Auteur;
use AppBundle\Form\AuteurType;

class AuteurController extends Controller
{
    /**
     * @Route("/auteur/index")
     */
    public function indexAction()
    {
		/**
		 * Création du formulaire à partir de AuteurType
		 */
		$auteur = new Auteur();		// Modèle Auteur

		$formulaireAuteur = $this->createForm ( AuteurType::class, $auteur );


        return $this->render('AppBundle:Auteur:index.html.twig', array(
            'formulaireAuteur' => $formulaireAuteur->createView()
        ));
    }

}
