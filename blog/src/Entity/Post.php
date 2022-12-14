<?php

namespace App\Entity;

use App\Repository\PostRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: PostRepository::class)]
class Post
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $fecha = null;

    #[ORM\Column(length: 255)]
    private ?string $imagen = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message:"Field 'Resumen' is mandatory")]
    private ?string $resumen = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message:"Field 'Titulo' is mandatory")]
    private ?string $titulo = null;

    #[ORM\Column(type: Types::TEXT)]
    #[Assert\NotBlank(message:"Field 'Cuerpo' is mandatory")]
    private ?string $cuerpo = null;

    #[ORM\Column]
    private ?int $nLikes = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message:"Field 'Autor' is mandatory")]
    private ?string $autor = null;

    #[ORM\ManyToOne]
    private ?Comment $comments = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFecha(): ?\DateTimeInterface
    {
        return $this->fecha;
    }

    public function setFecha(\DateTimeInterface $fecha): self
    {
        $this->fecha = $fecha;

        return $this;
    }

    public function getImagen(): ?string
    {
        return $this->imagen;
    }

    public function setImagen(string $imagen): self
    {
        $this->imagen = $imagen;

        return $this;
    }

    public function getResumen(): ?string
    {
        return $this->resumen;
    }

    public function setResumen(string $resumen): self
    {
        $this->resumen = $resumen;

        return $this;
    }

    public function getTitulo(): ?string
    {
        return $this->titulo;
    }

    public function setTitulo(string $titulo): self
    {
        $this->titulo = $titulo;

        return $this;
    }

    public function getCuerpo(): ?string
    {
        return $this->cuerpo;
    }

    public function setCuerpo(string $cuerpo): self
    {
        $this->cuerpo = $cuerpo;

        return $this;
    }

    public function getNLikes(): ?int
    {
        return $this->nLikes;
    }

    public function setNLikes(int $nLikes): self
    {
        $this->nLikes = $nLikes;

        return $this;
    }

    public function getAutor(): ?string
    {
        return $this->autor;
    }

    public function setAutor(string $autor): self
    {
        $this->autor = $autor;

        return $this;
    }

    public function getComments(): ?Comment
    {
        return $this->comments;
    }

    public function setComments(?Comment $comments): self
    {
        $this->comments = $comments;

        return $this;
    }
}
