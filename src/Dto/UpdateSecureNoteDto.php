<?php

declare(strict_types=1);

namespace App\Dto;

use Symfony\Component\Validator\Constraints as Assert;

final class UpdateSecureNoteDto
{
	#[Assert\NotBlank]
	#[Assert\Length(min: 3, max: 180)]
	public string $title;
	
	#[Assert\NotBlank]
	#[Assert\Length(min: 5)]
	public string $content;
}