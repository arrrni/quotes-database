<?php
declare(strict_types=1);

namespace App\Application\Command;

/**
 * Class CreateNewQuote
 * @package App\Application\Command
 */
class CreateNewQuote
{
    /**
     * @var string
     */
    private $content;

    /**
     * @var int
     */
    private $score;

    public function __construct(string $content, int $score)
    {
        $this->content = $content;
        $this->score = $score;
    }

    /**
     * @return string
     */
    public function content(): string
    {
        return $this->content;
    }

    /**
     * @return int
     */
    public function score(): int
    {
        return $this->score;
    }
}