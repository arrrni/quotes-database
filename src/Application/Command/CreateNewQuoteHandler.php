<?php
declare(strict_types=1);

namespace App\Application\Command;

use App\Domain\Entity\Quote;
use App\Domain\Quotes;

/**
 * Class CreateNewQuoteHandler
 * @package App\Application\Command
 */
class CreateNewQuoteHandler
{
    /**
     * @var Quotes
     */
    private $quotes;

    public function __construct(Quotes $quotes)
    {
        $this->quotes = $quotes;
    }

    /**
     * @param CreateNewQuote $command
     */
    public function handle(CreateNewQuote $command): void
    {
        $quote = new Quote(
            $command->content(),
            $command->score()
        );

        $this->quotes->add($quote);
    }
}