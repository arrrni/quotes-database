<?php
declare(strict_types=1);

namespace App\Domain;

use App\Domain\Entity\Quote;

/**
 * Interface Quotes
 * @package App\Domain
 */
interface Quotes
{
    /**
     * @param Quote $quote
     */
    public function add(Quote $quote): void;
}