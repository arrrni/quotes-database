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
    public function getAllQuotes(): array
    {
        $serializer = $this->getSerializer();
        $result = [];
        $quotes = $this->entityManager->getRepository(Quote::class)->findAll();
        if (!empty($quotes)) {
            foreach ($quotes as $quote) {
                $result[] = $serializer->normalize($quote);
            }
        }
        return $result;
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
        $normalizers = [
            new ObjectNormalizer(null, new CamelCaseToSnakeCaseNameConverter()),
            new DateTimeNormalizer()
        ];
        return new Serializer($normalizers, $encoders);
    }
}
