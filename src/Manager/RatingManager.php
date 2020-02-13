<?php
declare(strict_types=1);

namespace App\Manager;

use Doctrine\ORM\EntityManagerInterface;

/**
 * Class RatingManager
 * @package App\Manager
 */
class RatingManager
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * RatingManager constructor.
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @param int $quoteId
     * @param bool $rating
     */
    public function updateRatingStats(int $quoteId, bool $rating)
    {
    }
}
