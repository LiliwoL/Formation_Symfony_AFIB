<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use AppBundle\Entity\Auteur;
use AppBundle\Form\AuteurType;

class AuteurController extends Controller
{
    /**
     * @Route("/auteur/index")
     */
    public function indexAction( Request $request )
    {
		/**
		 * Création du formulaire à partir de AuteurType
		 */
		$auteur = new Auteur();		// Entity Auteur

		$formulaireAuteur = $this->createForm ( AuteurType::class, $auteur );

		$formulaireAuteur->handleRequest( $request );

		if ( $formulaireAuteur->isValid() ) {
			$auteur = $formulaireAuteur->getData();

			$em = $this->get('doctrine')->getManager('biblio');

			$em->persist( $auteur );
			$em->flush();

			return new Response ( 'Le formulaire est valide et soumis' );
		}


        return $this->render('AppBundle:Auteur:index.html.twig', array(
            'formulaireAuteur' => $formulaireAuteur->createView()
        ));
    }

}
