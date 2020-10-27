<?php

namespace App\Entity;

use App\Repository\AccountRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="accounts", uniqueConstraints={@ORM\UniqueConstraint(name="username", columns={"username", "domain_id"})})
 * @ORM\Entity(repositoryClass=AccountRepository::class)
 */
class Account
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer", options={"unsigned": true})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=64)
     */
    private $username;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $password;

    /**
     * @ORM\Column(type="integer", nullable=true, options={"unsigned": true, "default": 0})
     */
    private $quota = null;

    /**
     * @ORM\Column(type="boolean", nullable=true, options={"default": 0})
     */
    private $enabled = true;

    /**
     * @ORM\Column(type="boolean", name="sendonly", nullable=true, options={"default": 0})
     */
    private $send_only = false;

    /**
     * @var Domain
     * @ORM\ManyToOne(targetEntity=Domain::class, inversedBy="accounts")
     * @ORM\JoinColumn(nullable=false)
     */
    private $domain;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        if (!preg_match('/^{SHA512-CRYPT}*/', $password)) {
            $salt = substr(sha1(rand()), 0, 16);
            $password = "{SHA512-CRYPT}" . crypt($password, "$6$$salt");
        }
        $this->password = $password;

        return $this;
    }

    public function getQuota(): ?int
    {
        return $this->quota;
    }

    public function setQuota(int $quota): self
    {
        $this->quota = $quota;

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

    public function getSendOnly(): ?bool
    {
        return $this->send_only;
    }

    public function setSendOnly(bool $send_only): self
    {
        $this->send_only = $send_only;

        return $this;
    }

    public function getDomain(): ?Domain
    {
        return $this->domain;
    }

    public function setDomain(?Domain $domain): self
    {
        $this->domain = $domain;

        return $this;
    }
}
