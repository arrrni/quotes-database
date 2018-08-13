<?php
declare(strict_types=1);

namespace App\Event;

use App\Model\VoteInterface;
use Symfony\Component\EventDispatcher\Event;

/**
 * Class VoteEvent
 * @package App\Event
 */
class VoteEvent extends Event
{
    /**
     * @var VoteInterface
     */
    private $vote;

    /**
     * VoteEvent constructor.
     * @param VoteInterface $vote
     */
    public function __construct(VoteInterface $vote)
    {
        $this->vote = $vote;
    }

    /**
     * @return VoteInterface
     */
    public function getVote(): VoteInterface
    {
        return $this->vote;
    }
}
