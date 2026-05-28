<?php

declare(strict_types=1);

namespace App\Controller\Api;

use App\Dto\CreateSecureNoteDto;
use App\Dto\UpdateSecureNoteDto;
use App\Entity\SecureNote;
use App\Entity\User;
use App\Repository\SecureNoteRepository;
use App\Security\Voter\SecureNoteVoter;
use App\Service\SecureNoteService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route('/api/secure-notes')]
#[IsGranted('ROLE_USER')]
final class SecureNoteController extends AbstractController
{
    public function __construct(
        private readonly SecureNoteService $secureNoteService,
        private readonly SecureNoteRepository $secureNoteRepository,
    ) {}

    #[Route('', methods: ['GET'])]
    public function index(): JsonResponse
    {
        /** @var User $user */
        $user = $this->getUser();

        return $this->json(
            $this->secureNoteRepository->findByOwner($user),
            200,
            [],
            ['groups' => ['note:read']]
        );
    }

    #[Route('', methods: ['POST'])]
    public function create(
        #[MapRequestPayload] CreateSecureNoteDto $dto
    ): JsonResponse {
        /** @var User $user */
        $user = $this->getUser();

        $note = $this->secureNoteService->create($dto, $user);

        return $this->json(
            $note,
            201,
            [],
            ['groups' => ['note:read']]
        );
    }

    #[Route('/{id}', methods: ['GET'])]
    public function show(SecureNote $note): JsonResponse
    {
        $this->denyAccessUnlessGranted(SecureNoteVoter::VIEW, $note);

        return $this->json(
            $note,
            200,
            [],
            ['groups' => ['note:read']]
        );
    }

    #[Route('/{id}', methods: ['PUT', 'PATCH'])]
    public function update(
        SecureNote $note,
        #[MapRequestPayload] UpdateSecureNoteDto $dto
    ): JsonResponse {
        $this->denyAccessUnlessGranted(SecureNoteVoter::EDIT, $note);

        $updatedNote = $this->secureNoteService->update($note, $dto);

        return $this->json(
            $updatedNote,
            200,
            [],
            ['groups' => ['note:read']]
        );
    }

    #[Route('/{id}', methods: ['DELETE'])]
    public function delete(SecureNote $note): JsonResponse
    {
        $this->denyAccessUnlessGranted(SecureNoteVoter::DELETE, $note);

        $this->secureNoteService->delete($note);

        return new JsonResponse(null, 204);
    }
}