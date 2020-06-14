<?php

namespace App\Entity;

use App\Repository\OnlineClassRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=OnlineClassRepository::class)
 */
class OnlineClass
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=500, nullable=true)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=500, nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=500, nullable=true)
     */
    private $videoUrl;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $class;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $isLive;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $isListed;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getVideoUrl(): ?string
    {
        return $this->videoUrl;
    }

    public function setVideoUrl(?string $videoUrl): self
    {
        $this->videoUrl = $videoUrl;

        return $this;
    }

    public function getClass(): ?string
    {
        return $this->class;
    }

    public function setClass(?string $class): self
    {
        $this->class = $class;

        return $this;
    }

    public function getIsLive(): ?bool
    {
        return $this->isLive;
    }

    public function setIsLive(bool $isLive): self
    {
        $this->isLive = $isLive;

        return $this;
    }

    public function getIsListed(): ?bool
    {
        return $this->isListed;
    }

    public function setIsListed(?bool $isListed): self
    {
        $this->isListed = $isListed;

        return $this;
    }
}
