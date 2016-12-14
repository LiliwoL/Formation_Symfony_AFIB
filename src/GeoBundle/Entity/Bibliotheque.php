<?php

namespace GeoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Bibliotheque
 *
 * @ORM\Table(name="bibliotheque", schema="GEO")
 * @ORM\Entity(repositoryClass="GeoBundle\Repository\BibliothequeRepository")
 */
class Bibliotheque
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="Nom", type="string", length=255)
     */
    private $nom;

    /**
     * @var point
     *
     * @ORM\Column(name="Coords", type="point")
     */
    private $coords;



    /*
     * Jointure sur l'entité Livre de AppBundle
     * On considère qu'un livre n'est que dans UNE seule bibliotheque
     */
	/**
	 * @ORM\OneToMany(
	 *     targetEntity="\AppBundle\Entity\Livre",
	 *     mappedBy="bibliotheque"
	 * )
	 */
	private $livres;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set nom
     *
     * @param string $nom
     *
     * @return Bibliotheque
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set coords
     *
     * @param point $coords
     *
     * @return Bibliotheque
     */
    public function setCoords($coords)
    {
        $this->coords = $coords;

        return $this;
    }

    /**
     * Get coords
     *
     * @return point
     */
    public function getCoords()
    {
        return $this->coords;
    }
}

