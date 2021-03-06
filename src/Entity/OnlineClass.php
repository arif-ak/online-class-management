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
    private $videoURL;

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

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $videoLength;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $voiceType;

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

    public function getVideoURL(): ?string
    {
        return $this->videoURL;
    }

    public function setVideoURL(?string $videoURL): self
    {
        $this->videoURL = $videoURL;

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

    public function getVideoLength(): ?int
    {
        return $this->videoLength;
    }

    public function setVideoLength(?int $videoLength): self
    {
        $this->videoLength = $videoLength;

        return $this;
    }

    public function getVoiceType(): ?string
    {
        return $this->voiceType;
    }

    public function setVoiceType(?string $voiceType): self
    {
        $this->voiceType = $voiceType;

        return $this;
    }
}
