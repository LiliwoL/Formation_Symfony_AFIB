<?php

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;


class LivreRepository extends \Doctrine\ORM\EntityRepository{


	public function getLivresEtAuteurs ()
	{
		$query = $this->getEntityManager()->createQuery(
			'SELECT l, a, b
			FROM AppBundle:Livre l
			JOIN l.auteur a
			JOIN l.bibliotheque b'
		);

		var_dump($query->getSQL());

		return $query->getResult();
	}


	public function getLivresEtAuteursParTitre ( $titre )
	{
		$query = $this->getEntityManager()->createQuery(
			'SELECT l, a
			FROM AppBundle:Livre l
			JOIN l.auteur a
			WHERE l.titre = :titre'
		);
		$query->setParameter( 'titre', $titre );

		return $query->getResult();
	}
}