<?php

namespace App\Entity;

use App\Repository\AliasRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="aliases", uniqueConstraints={@ORM\UniqueConstraint(name="source_username", columns={"source_username", "source_domain_id", "destination_username", "destination_domain"})}, indexes={@ORM\Index(name="source_domain", columns={"source_domain_id"})})
 * @ORM\Entity(repositoryClass=AliasRepository::class)
 */
class Alias
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer", options={"unsigned": true})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=64, nullable=true)
     */
    private $source_username;

    /**
     * @ORM\ManyToOne(targetEntity=Domain::class, inversedBy="aliases")
     * @ORM\JoinColumn(nullable=false)
     */
    private $source_domain;

    /**
     * @ORM\Column(type="string", length=64)
     */
    private $destination_username;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $destination_domain;

    /**
     * @ORM\Column(type="boolean", nullable=true, options={"default": 0})
     */
    private $enabled;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSourceUsername(): ?string
    {
        return $this->source_username;
    }

    public function setSourceUsername(string $source_username): self
    {
        $this->source_username = $source_username;

        return $this;
    }

    public function getSourceDomain(): ?Domain
    {
        return $this->source_domain;
    }

    public function setSourceDomain(?Domain $source_domain): self
    {
        $this->source_domain = $source_domain;

        return $this;
    }

    public function getDestinationUsername(): ?string
    {
        return $this->destination_username;
    }

    public function setDestinationUsername(string $destination_username): self
    {
        $this->destination_username = $destination_username;

        return $this;
    }

    public function getDestinationDomain(): ?string
    {
        return $this->destination_domain;
    }

    public function setDestinationDomain(string $destination_domain): self
    {
        $this->destination_domain = $destination_domain;

        return $this;
    }

    public function getEnabled(): ?bool
    {
        return $this->enabled;
    }

    public function setEnabled(bool $enabled): self
    {
        $this->enabled = $enabled;

        return $this;
    }
}
