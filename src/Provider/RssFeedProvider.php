<?php

declare(strict_types=1);

namespace App\Provider;

use App\Entity\Quote;
use Doctrine\ORM\EntityManagerInterface;

class RssFeedProvider
{
    public function __construct(private readonly EntityManagerInterface $entityManager)
    {
    }

    public function getFeed(): string
    {
        $xml = '<?xml version="1.0" encoding="ISO-8859-1"?>';
        $xml .= '<rss version="2.0">';
        $xml .= '<channel>';
        $xml .= '<title>QDB</title>';
        $xml .= '<link>'.getenv('APP_DOMAIN').'</link>';
        $data = $this->entityManager->getRepository(Quote::class)->findBy([], ['id' => 'DESC']);
        if(!empty($data)) {
            foreach ($data as $quote) {
                $xml = vsprintf(
                    '<item><title>Quote #%d</title><description>%s</description><link>%s/q/%d</link><pubDate>%s</pubDate></item>',
                    [
                        $quote->getId(),
                        $quote->getContent(),
                        \getenv('APP_DOMAIN'),
                        $quote->getId().
                        $quote->getCreatedAt()->format(\DateTimeInterface::RFC822),
                    ]
                );
            }
        }
        $xml .= '</channel></rss>';
        return $xml;
    }
}
