<?php

namespace GeoBundle\Controller;


use GeoBundle\Entity\Bibliotheque;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

use CrEOF\Spatial\PHP\Types\Geography\Polygon;
use CrEOF\Spatial\PHP\Types\Geometry\LineString;
use CrEOF\Spatial\PHP\Types\Geometry\Point;

class BibliothequeController extends Controller
{
	private $emGeo;

    /**
     * @Route("/biblio/index")
     */
    public function indexAction()
    {
        return $this->render('GeoBundle:Bibliotheque:index.html.twig', array(
            // ...
        ));
    }

    /**
     * @Route("/biblio/list")
     */
    public function listAction()
    {
    	// On veut récupérer tout ce qui est dans une zone
		$multilinestring = new LineString( array (
			new Point( 28, 28 ),
			new Point( 35, 28 ),
			new Point( 35, 35 ),
			new Point( 28, 35 ),
			new Point( 28, 28 )
		) );

		$area = new Polygon( array( $multilinestring) );

		// Appel au repository
		$this->emGeo 			 = $this->get('doctrine')->getManager('geo');
		$repositoryBibliotheques = $this->emGeo->getRepository('GeoBundle:Bibliotheque');

		/**
		 * Methode specifique du REPOSITORY bibliotheque
		 */
		//$results = $repositoryBibliotheques->getBibliothequesFromArea($area);




		/**
		 * Methode specifique du REPOSITORY bibliotheque
		 */
		$results = $repositoryBibliotheques->getBibliothequesAndTheirBooksFromArea($area);



        return $this->render('GeoBundle:Bibliotheque:list.html.twig', array(
            'results' => $results
        ));
    }

    /**
     * @Route("/biblio/edit")
     */
    public function editAction()
    {
		$this->emGeo 	= $this->get('doctrine')->getManager('geo');

		$bibliotheque = new Bibliotheque();

		$bibliotheque->setNom("Montaigne");
		$bibliotheque->setCoords( new Point( 29.5, 30.5 ) );

		$this->emGeo ->persist( $bibliotheque );
		$this->emGeo ->flush();

        return $this->render('GeoBundle:Bibliotheque:edit.html.twig', array(
            // ...
        ));
    }

	/**
	 * @Route("/biblio/add")
	 */
	public function addAction()
	{
		$this->emGeo 	= $this->get('doctrine')->getManager('geo');

		$bibliotheque = new Bibliotheque();

		$bibliotheque->setNom("New York");
		$bibliotheque->setCoords( new Point( 25, 30) );

		$this->emGeo ->persist( $bibliotheque );
		$this->emGeo ->flush();

		return $this->render('GeoBundle:Bibliotheque:edit.html.twig', array(
			// ...
		));
	}
}
