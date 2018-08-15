<?php
declare(strict_types=1);

namespace App\Provider;

use App\Entity\Quote;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\NameConverter\CamelCaseToSnakeCaseNameConverter;
use Symfony\Component\Serializer\Normalizer\DateTimeNormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

/**
 * Class QuoteProvider
 * @package App
 */
class QuoteProvider
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
     * @return array
     */
    public function getAllQuotes(): ?array
    {
        $serializer = $this->getSerializer();
        $result = null;
        $quotes = $this->entityManager->getRepository(Quote::class)->findAll();
        if (!empty($quotes)) {
            foreach ($quotes as $quote) {
                $result[] = $serializer->normalize($quote);
            }
        }
        return $result;
    }

    /**
     * @param int $quoteId
     * @return array
     */
    public function getQuote(int $quoteId): ?array
    {
        $serializer = $this->getSerializer();
        $quote = $this->entityManager->getRepository(Quote::class)->find($quoteId);
        return $serializer->normalize($quote);
    }

    /**
     * Sets up Symfony Serializer component
     * @return Serializer
     */
    private function getSerializer(): Serializer
    {
        $encoders = [
            new JsonEncoder()
        ];
        $objectNormalizer = new ObjectNormalizer(null, new CamelCaseToSnakeCaseNameConverter());
        $dataCallback = function ($dateTime) {
            return $dateTime instanceof \DateTime
                ? $dateTime->format('Y-m-d h:i:s')
                : '';
        };
        $objectNormalizer->setCallbacks([
            'updatedAt' => $dataCallback,
            'createdAt' => $dataCallback
        ]);
        $normalizers = [
            $objectNormalizer,
            new DateTimeNormalizer()
        ];
        return new Serializer($normalizers, $encoders);
    }
}
