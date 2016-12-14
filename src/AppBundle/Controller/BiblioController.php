<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;


use AppBundle\Entity\Livre;
use AppBundle\Entity\Auteur;

use Symfony\Component\HttpKernel\Exception\HttpException;

class BiblioController extends Controller
{
	private $emBiblio;
	private $emGeo;

	public function setEntityManager ()
	{
		if ( !$this->emBiblio )
		{
			$this->emBiblio = $this->get('doctrine')->getManager('biblio');
		}

		if ( !$this->emGeo )
		{
			$this->emGeo 	= $this->get('doctrine')->getManager('geo');
		}
	}

	/**
	 * @Route(
	 *     "/livre",
	 *     name= "biblio_root"
	 *     )
	 */
	public function indexAction ()
	{
		$this->setEntityManager();

		/*$livre = new Livre();
		$livre->setIsbn("FCF82555FFFF");
		$livre->setTitre("1984");
		$livre->setDateparution( new \DateTime('1984-01-01'));

		$em = $this->get('doctrine')->getManager();

		$em->persist( $livre );
		$em->flush();


		$auteur = new Auteur();*/

		$repositoryLivres = $this->emBiblio->getRepository('AppBundle:Livre');

		$livres = $repositoryLivres->findAll();

		$repositoryAuteurs = $this->emBiblio->getRepository('AppBundle:Auteur');

		$auteurs = $repositoryAuteurs->findAll();


		return $this->render('AppBundle:debug:debug.html.twig', [
			'livres' => $livres,
			'auteurs' => $auteurs
		]);
	}

	/**
	 * @Route(
	 *     "/livre/{id}",
	 *     name= "biblio_livre"
	 *     )
	 */
	public function editLivre( $id )
	{
		$this->setEntityManager();
		$repositoryLivres = $this->emBiblio->getRepository('AppBundle:Livre');

		// Utilisation de la methode du repository
		$livres = $repositoryLivres->getLivresEtAuteurs();


		/**
		 * Une methode personnalisée du REPOSITORY pour rechercher des LIVRES
		 * et leurs AUTEURS par le biais du champ TITRE
		 */
		//$livres = $repositoryLivres->getLivresEtAuteursParTitre('Ubik');

		/**
		 * Une méthode générique du REPOSITORY (pas même besoin de l'avoir créé!)
		 *
		 * ATTENTION! Le LAZY LOADING fait que le champ AUTEUR restera VIDE tant que
		 * l'on n'aura pas EXPLICITEMENT demandé à en récupérer le contenu
		 */
		//$livre = $repositoryLivres->find($id);
		//$auteur = $livre->getAuteur();

		// Pour forcer le LAZY LOADING
		//$auteur->getNom();



		return $this->render('AppBundle:debug:debug.html.twig', [
			'livres' => $livres,

			'auteurs' => array( )
		]);
	}
}