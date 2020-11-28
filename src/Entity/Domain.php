<?php

namespace App\Entity;

use App\Repository\DomainRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="domains", uniqueConstraints={@ORM\UniqueConstraint(name="name", columns={"name"})})
 * @ORM\Entity(repositoryClass=DomainRepository::class)
 */
class Domain
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
    private $name;

    /**
     * @ORM\OneToMany(targetEntity=Account::class, mappedBy="domain")
     */
    private $accounts;

    /**
     * @ORM\OneToMany(targetEntity=Alias::class, mappedBy="source_domain")
     */
    private $aliases;

    /**
     * @ORM\Column(type="boolean", options={"default": false})
     */
    private $is_alias_domain;

    public function __construct()
    {
        $this->accounts = new ArrayCollection();
        $this->aliases = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection|Account[]
     */
    public function getAccounts(): Collection
    {
        return $this->accounts;
    }

    public function addAccount(Account $account): self
    {
        if (!$this->accounts->contains($account)) {
            $this->accounts[] = $account;
            $account->setDomain($this);
        }

        return $this;
    }

    public function removeAccount(Account $account): self
    {
        if ($this->accounts->contains($account)) {
            $this->accounts->removeElement($account);
            // set the owning side to null (unless already changed)
            if ($account->getDomain() === $this) {
                $account->setDomain(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Alias[]
     */
    public function getAliases(): Collection
    {
        return $this->aliases;
    }

    public function addAlias(Alias $alias): self
    {
        if (!$this->aliases->contains($alias)) {
            $this->aliases[] = $alias;
            $alias->setSourceDomain($this);
        }

        return $this;
    }

    public function removeAlias(Alias $alias): self
    {
        if ($this->aliases->contains($alias)) {
            $this->aliases->removeElement($alias);
            // set the owning side to null (unless already changed)
            if ($alias->getSourceDomain() === $this) {
                $alias->setSourceDomain(null);
            }
        }

        return $this;
    }

    public function getIsAliasDomain(): ?bool
    {
        return $this->is_alias_domain;
    }

    public function setIsAliasDomain(bool $is_alias_domain): self
    {
        $this->is_alias_domain = $is_alias_domain;

        return $this;
    }
}
