<?php

declare(strict_types=1);

namespace App\Manager;

use Doctrine\ORM\EntityManagerInterface;

class RatingManager
{
    public function __construct(private EntityManagerInterface $entityManager)
    {
    }

    public function updateRatingStats(int $quoteId, bool $rating): void
    {
        // @todo: refactor this shit
    }
}
