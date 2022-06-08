<?php

declare(strict_types=1);

namespace App\Event;

use App\Model\VoteInterface;
use Symfony\Contracts\EventDispatcher\Event;

class VoteEvent extends Event
{
    public function __construct(private readonly VoteInterface $vote)
    {
    }

    public function getVote(): VoteInterface
    {
        return $this->vote;
    }
}
