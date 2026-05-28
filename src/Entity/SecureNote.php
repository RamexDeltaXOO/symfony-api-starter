<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\SecureNoteRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SecureNoteRepository::class)]
class SecureNote
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
	#[Groups(['note:read'])]
    private ?int $id = null;

    #[ORM\Column(length: 180)]
	#[Groups(['note:read'])]
    private ?string $title = null;

    #[ORM\Column(type: Types::TEXT)]
	#[Groups(['note:read'])]
    private ?string $content = null;

    #[ORM\ManyToOne(inversedBy: 'secureNotes')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $owner = null;

    #[ORM\Column]
	#[Groups(['note:read'])]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column(nullable: true)]
	#[Groups(['note:read'])]
    private ?\DateTimeImmutable $updatedAt = null;
	
	public function __construct(string $title, string $content, User $owner) 
	{
		$this->title = $title;
		$this->content = $content;
		$this->owner = $owner;
		$this->createdat = new \DateTimeImmutable();
	}
	
	public function update(string $title, string $content): void
	{
		$this->title = $title;
		$this->content = $content;
		$this->updatedAt = new \DateTimeImmutable();
	}

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): static
    {
        $this->content = $content;

        return $this;
    }

    public function getOwner(): ?User
    {
        return $this->owner;
    }

    public function setOwner(?User $owner): static
    {
        $this->owner = $owner;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?\DateTimeImmutable $updatedAt): static
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }
}
