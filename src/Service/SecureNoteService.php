<?php

declare(strict_types=1);

namespace App\Service;

use App\Dto\CreateSecureNoteDto;
use App\Dto\UpdateSecureNoteDto;
use App\Entity\SecureNote;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;

final readonly class SecureNoteService
{
    public function __construct(
        private EntityManagerInterface $entityManager,
    ) {}

    public function create(CreateSecureNoteDto $dto, User $owner): SecureNote
    {
        $note = new SecureNote(
            title: $dto->title,
            content: $dto->content,
            owner: $owner
        );

        $this->entityManager->persist($note);
        $this->entityManager->flush();

        return $note;
    }

    public function update(SecureNote $note, UpdateSecureNoteDto $dto): SecureNote
    {
        $note->update($dto->title, $dto->content);

        $this->entityManager->flush();

        return $note;
    }

    public function delete(SecureNote $note): void
    {
        $this->entityManager->remove($note);
        $this->entityManager->flush();
    }
}