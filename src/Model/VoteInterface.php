<?php
declare(strict_types=1);

namespace App\Model;

/**
 * Interface VoteInterface
 * @package App\Model
 */
interface VoteInterface
{
    public static function forQuote(int $quoteId, bool $value): self;

    public function getValue(): bool;

    public function getQuoteId(): int;
}
