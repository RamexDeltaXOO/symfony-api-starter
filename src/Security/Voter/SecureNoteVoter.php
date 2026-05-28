<?php

declare(strict_types=1);

namespace App\Security\Voter;

use App\Entity\SecureNote;
use App\Entity\User;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;

final class SecureNoteVoter extends Voter
{
    public const VIEW = 'SECURE_NOTE_VIEW';
    public const EDIT = 'SECURE_NOTE_EDIT';
    public const DELETE = 'SECURE_NOTE_DELETE';

    protected function supports(string $attribute, mixed $subject): bool
    {
        return in_array($attribute, [self::VIEW, self::EDIT, self::DELETE], true)
            && $subject instanceof SecureNote;
    }

    protected function voteOnAttribute(
        string $attribute,
        mixed $subject,
        TokenInterface $token
    ): bool {
        $user = $token->getUser();

        if (!$user instanceof User) {
            return false;
        }

        return $subject->getOwner() === $user;
    }
}