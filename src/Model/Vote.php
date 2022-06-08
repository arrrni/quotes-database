<?php
declare(strict_types=1);

namespace App\Model;

class Vote implements VoteInterface
{
    private function __construct(private readonly bool $value, private readonly int $quoteId)
    {
    }

    public static function forQuote(int $quoteId, bool $value): self
    {
        return new self($value, $quoteId);
    }

    public function getValue(): bool
    {
        return $this->value;
    }

    public function getQuoteId(): int
    {
        return $this->quoteId;
    }
}
