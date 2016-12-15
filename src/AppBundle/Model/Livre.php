<?php

namespace AppBundle\Model;

class Livre
{
	private $isbn;
	private $titre;
	private $dateParution;
	private $auteur;
	private $bibliotheque;

	public function setIsbn ( $isbn )
	{
		$this->isbn = $isbn;
		return $this;
	}

	public function setTitre ( $titre )
	{
		$this->titre = $titre;
		return $this;
	}

	public function setDateParution ( $dateParution )
	{
		$this->dateParution = $dateParution;
		return $this;
	}

	public function setAuteur ( $auteur )
	{
		$this->auteur = $auteur;
		return $this;
	}

	public function setBibliotheque ( $bibliothque )
	{
		$this->bibliothque = $bibliotheque;
		return $this;
	}

	public function getIsbn ()
	{
		return $this->isbn;
	}

	public function getTitre ()
	{
		return $this->titre;
	}

	public function getDateParution ()
	{
		return $this->dateParution;
	}

	public function getAuteur ()
	{
		return $this->auteur;
	}

	public function getBibliotheque ()
	{
		return $this->bibliotheque;
	}
}