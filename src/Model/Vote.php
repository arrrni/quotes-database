<?php
declare(strict_types=1);

namespace App\Model;

/**
 * Class Vote
 * @package App\Model
 */
class Vote implements VoteInterface
{
    /**
     * @var bool
     */
    private $value;

    /**
     * @var int
     */
    private $quoteId;

    /**
     * @param bool $value
     * @return VoteInterface
     */
    public function setValue(bool $value): VoteInterface
    {
        $this->value = $value;
        return $this;
    }

    /**
     * @return bool
     */
    public function getValue(): bool
    {
        return $this->value;
    }

    /**
     * @return int
     */
    public function getQuoteId(): int
    {
        return $this->quoteId;
    }

    /**
     * @param int $quoteId
     * @return VoteInterface
     */
    public function setQuoteId(int $quoteId): VoteInterface
    {
        $this->quoteId = $quoteId;
        return $this;
    }
}
