<?php
declare(strict_types=1);

namespace App\EventListener;

use App\Event\VoteEvent;
use App\Events\RatingEvents;
use App\Manager\RatingManager;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
 * Class RatingUpdateRateEventListener
 * @package App\EventListener
 */
class RatingUpdateRateEventListener implements EventSubscriberInterface
{
    /**
     * @var RatingManager
     */
    private $ratingManager;

    /**
     * RatingUpdateRateEventListener constructor.
     * @param RatingManager $ratingManager
     */
    public function __construct(RatingManager $ratingManager)
    {
        $this->ratingManager = $ratingManager;
    }

    /**
     * @return array
     */
    public static function getSubscribedEvents(): array
    {
        return [
            RatingEvents::RATING_CREATE => 'onCreateVote'
        ];
    }

    /**
     * @param VoteEvent $event
     */
    public function onCreateVote(VoteEvent $event): void
    {
        $rating = $event->getVote()->getValue();
        $quoteId = $event->getVote()->getQuoteId();
        $this->ratingManager->updateRatingStats($quoteId, $rating);
    }
}
