<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ORM\Entity(repositoryClass="App\Repository\ArticleRepository")
 */
class Article
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @Assert\Length(
     *      min = 2, 
     *      max = 250,
     *      minMessage = "Le titre de votre article doit contenir 2 caractères ou plus",
     *      maxMessage = "Le titre de votre article doit contenir moins de 250 caractères"
     * )
     * @ORM\Column(type="string", length=255)
     */
    private $titre;

    /**
     * @Assert\Length(
     *      min = 30, 
     *      minMessage = "Le contenu de votre article doit contenir minimum 30 caractères"
     * )
     * @ORM\Column(type="text")
     */
    private $contenu;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date_at;

    /**
     * @Assert\Length(
     *      max = 50,
     *      maxMessage = "Le nom de l'auteur de votre article ne doit pas dépasser 50 caractères"
     * )
     * @ORM\Column(type="string", length=255)
     */
    private $auteur;

    /**
     * @Assert\Type(type="text")
     * @ORM\Column(type="string", length=255)
     */
    private $categorie;

    /**
     * @ORM\Column(type="integer")
     */
    private $nombreVues;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }

    public function getContenu(): ?string
    {
        return $this->contenu;
    }

    public function setContenu(string $contenu): self
    {
        $this->contenu = $contenu;

        return $this;
    }

    public function getDateAt(): ?\DateTimeInterface
    {
        return $this->date_at;
    }

    public function setDateAt(\DateTimeInterface $date_at): self
    {
        $this->date_at = $date_at;

        return $this;
    }

    public function getAuteur(): ?string
    {
        return $this->auteur;
    }

    public function setAuteur(string $auteur): self
    {
        $this->auteur = $auteur;

        return $this;
    }

    public function getCategorie(): ?string
    {
        return $this->categorie;
    }

    public function setCategorie(string $categorie): self
    {
        $this->categorie = $categorie;

        return $this;
    }

    public function getNombreVues(): ?int
    {
        return $this->nombreVues;
    }

    public function setNombreVues(int $nombreVues): self
    {
        $this->nombreVues = $nombreVues;

        return $this;
    }

    public function findAllContenuMax($contenu)
    {
        if(isset($contenu))
        {
            $max = substr($contenu, 0, 49);
            return $max;
        }
    }

    public function __construct()
    {
        $this->date_at = new \DateTime;
    }
}
