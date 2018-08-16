<?php
/**
 * Created by PhpStorm.
 * User: aszymczyk
 * Date: 16.08.18
 * Time: 18:27
 */

namespace App\Provider;


use App\Entity\Quote;
use Doctrine\ORM\EntityManagerInterface;

class RssFeedProvider
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * QuoteProvider constructor.
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @return string
     */
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
                $xml .= '<item>';
                $xml .= sprintf('<title>Quote #%d</title>', $quote->getId());
                $xml .= sprintf('<description>%s</description>', $quote->getContent());
                $xml .= sprintf('<link>%s/q/%d</link>', getenv('APP_DOMAIN'), $quote->getId());
                $xml .= sprintf('<pubDate>%s</pubDate>', $quote->getCreatedAt()->format(\DateTime::RFC822));
                $xml .= '</item>';
            }
        }
        $xml .= '</channel>';
        $xml .= '</rss>';
        return $xml;
    }
}