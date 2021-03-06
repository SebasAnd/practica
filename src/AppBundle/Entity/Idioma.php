<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Idioma
 *
 * @ORM\Table(name="idioma")
 * @ORM\Entity
 */
class Idioma
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=255, precision=0, scale=0, nullable=false, unique=false)
     */
    private $nombre;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Pelicula", mappedBy="idioma")
     */
    private $pelicula;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Pelicula", inversedBy="peliculasubtitulos")
     * @ORM\JoinTable(name="idioma_pelicula",
     *   joinColumns={
     *     @ORM\JoinColumn(name="idioma_id", referencedColumnName="id", onDelete="CASCADE")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="pelicula_id", referencedColumnName="id", onDelete="CASCADE")
     *   }
     * )
     */
    private $idiomasubtitulos;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->pelicula = new \Doctrine\Common\Collections\ArrayCollection();
        $this->idiomasubtitulos = new \Doctrine\Common\Collections\ArrayCollection();
    }

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
     * Set nombre
     *
     * @param string $nombre
     *
     * @return Idioma
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get nombre
     *
     * @return string
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Add pelicula
     *
     * @param \AppBundle\Entity\Pelicula $pelicula
     *
     * @return Idioma
     */
    public function addPelicula(\AppBundle\Entity\Pelicula $pelicula)
    {
        $this->pelicula[] = $pelicula;

        return $this;
    }

    /**
     * Remove pelicula
     *
     * @param \AppBundle\Entity\Pelicula $pelicula
     */
    public function removePelicula(\AppBundle\Entity\Pelicula $pelicula)
    {
        $this->pelicula->removeElement($pelicula);
    }

    /**
     * Get pelicula
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPelicula()
    {
        return $this->pelicula;
    }

    /**
     * Add idiomasubtitulo
     *
     * @param \AppBundle\Entity\Pelicula $idiomasubtitulo
     *
     * @return Idioma
     */
    public function addIdiomasubtitulo(\AppBundle\Entity\Pelicula $idiomasubtitulo)
    {
        $this->idiomasubtitulos[] = $idiomasubtitulo;

        return $this;
    }

    /**
     * Remove idiomasubtitulo
     *
     * @param \AppBundle\Entity\Pelicula $idiomasubtitulo
     */
    public function removeIdiomasubtitulo(\AppBundle\Entity\Pelicula $idiomasubtitulo)
    {
        $this->idiomasubtitulos->removeElement($idiomasubtitulo);
    }

    /**
     * Get idiomasubtitulos
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getIdiomasubtitulos()
    {
        return $this->idiomasubtitulos;
    }
}

