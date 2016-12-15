<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Livre
 *
 * @ORM\Table(name="BIBLIO.livre", uniqueConstraints={@ORM\UniqueConstraint(name="UNIQ_AC634F99FA891952", columns={"ISBN"})})
 * @ORM\Entity(repositoryClass="AppBundle\Repository\LivreRepository")
 */
class Livre
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="ISBN", type="string", length=50, nullable=false)
     */
    private $isbn;

    /**
     * @var string
     *
     * @ORM\Column(name="titre", type="text", nullable=false)
     */
    private $titre;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateParution", type="date", nullable=false)
     */
    private $dateparution;


	/**
	 * @ORM\ManyToOne(
	 *     targetEntity="AppBundle\Entity\Auteur",
	 *     inversedBy="livres"
	 * )
	 */
    private $auteur;

	/**
	 * @ORM\ManyToOne(
	 *     targetEntity="GeoBundle\Entity\Bibliotheque",
	 *     inversedBy="livres"
	 * )
	 */
	private $bibliotheque;



    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set isbn
     *
     * @param string $isbn
     *
     * @return Livre
     */
    public function setIsbn($isbn)
    {
        $this->isbn = $isbn;

        return $this;
    }

    /**
     * Get isbn
     *
     * @return string
     */
    public function getIsbn()
    {
        return $this->isbn;
    }

    /**
     * Set titre
     *
     * @param string $titre
     *
     * @return Livre
     */
    public function setTitre($titre)
    {
        $this->titre = $titre;

        return $this;
    }

    /**
     * Get titre
     *
     * @return string
     */
    public function getTitre()
    {
        return $this->titre;
    }

    /**
     * Set dateparution
     *
     * @param \DateTime $dateparution
     *
     * @return Livre
     */
    public function setDateparution($dateparution)
    {
        $this->dateparution = $dateparution;

        return $this;
    }

    /**
     * Get dateparution
     *
     * @return \DateTime
     */
    public function getDateparution()
    {
        return $this->dateparution;
    }

	/**
	 * Get Auteur
	 *
	 * @return \AppBundle\Entity\Auteur
	 */
    public function getAuteur()
	{
		return $this->auteur;
	}

	/**
	 * Get Bibliotheque
	 *
	 * @return \GeoBundle\Entity\Bibliotheque
	 */
	public function getBibliotheque()
	{
		return $this->bibliotheque;
	}

    /**
     * Set auteur
     *
     * @param \AppBundle\Entity\Auteur $auteur
     *
     * @return Livre
     */
    public function setAuteur(\AppBundle\Entity\Auteur $auteur = null)
    {
        $this->auteur = $auteur;

        return $this;
    }
}
