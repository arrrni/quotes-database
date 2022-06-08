<?php
declare(strict_types=1);

namespace App\EventListener;

use App\Event\VoteEvent;
use App\Events\RatingEvents;
use App\Manager\RatingManager;
use JetBrains\PhpStorm\ArrayShape;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class RatingUpdateRateEventListener implements EventSubscriberInterface
{
    public function __construct(private readonly RatingManager $ratingManager)
    {
    }

    #[ArrayShape([RatingEvents::RATING_CREATE => "string"])]
    public static function getSubscribedEvents(): array
    {
        return [
            RatingEvents::RATING_CREATE => 'onCreateVote'
        ];
    }

    public function onCreateVote(VoteEvent $event): void
    {
        $rating = $event->getVote()->getValue();
        $quoteId = $event->getVote()->getQuoteId();
        $this->ratingManager->updateRatingStats($quoteId, $rating);
    }
}
