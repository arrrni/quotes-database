<?php
declare(strict_types=1);

namespace App\Infrastructure\Doctrine\ORM;

use App\Domain\Entity\Quote;
use App\Domain\Quotes;
use Doctrine\ORM\EntityManagerInterface;

/**
 * Class DoctrineQuotes
 * @package App\Infrastructure\Doctrine\ORM
 */
class DoctrineQuotes implements Quotes
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @param Quote $quote
     */
    public function add(Quote $quote): void
    {
        $this->entityManager->persist($quote);
        $this->entityManager->flush();
    }
}