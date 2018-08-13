<?php
declare(strict_types=1);

namespace App\Model;

/**
 * Interface VoteInterface
 * @package App\Model
 */
interface VoteInterface
{
    /**
     * @param bool $value
     * @return VoteInterface
     */
    public function setValue(bool $value): VoteInterface;

    /**
     * @return bool
     */
    public function getValue(): bool;

    /**
     * @param int $quoteId
     * @return VoteInterface
     */
    public function setQuoteId(int $quoteId): VoteInterface;

    /**
     * @return int
     */
    public function getQuoteId(): int;
}
