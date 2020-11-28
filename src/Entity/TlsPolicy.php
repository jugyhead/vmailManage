<?php

namespace App\Entity;

use App\Repository\TlsPolicyRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="tlspolicies", uniqueConstraints={@ORM\UniqueConstraint(name="domain", columns={"domain"})})
 * @ORM\Entity(repositoryClass=TlsPolicyRepository::class)
 */
class TlsPolicy
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer", options={"unsigned": true})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $domain;

    /**
     * @ORM\Column(type="string", length=16)
     */
    private $policy;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $params;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDomain(): ?string
    {
        return $this->domain;
    }

    public function setDomain(string $domain): self
    {
        $this->domain = $domain;

        return $this;
    }

    public function getPolicy(): ?string
    {
        return $this->policy;
    }

    public function setPolicy(string $policy): self
    {
        $this->policy = $policy;

        return $this;
    }

    public function getParams(): ?string
    {
        return $this->params;
    }

    public function setParams(?string $params): self
    {
        $this->params = $params;

        return $this;
    }
}
