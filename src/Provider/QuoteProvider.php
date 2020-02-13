<?php
declare(strict_types=1);

namespace App\Provider;

use App\Entity\Quote;
use Doctrine\ORM\EntityManagerInterface;
use Pagerfanta\Adapter\DoctrineORMAdapter;
use Pagerfanta\Pagerfanta;
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
     * @param int $perPage
     * @param int $page
     * @return array
     */
    public function getAllQuotes(int $perPage, int $page): ?array
    {
        $result = null;
        $serializer = $this->getSerializer();
        $adapter = new DoctrineORMAdapter(
            $this->entityManager->createQueryBuilder()
                ->select('quote')
                ->from(Quote::class, 'quote')
        );
        $paginator = new Pagerfanta($adapter);
        $paginator->setMaxPerPage($perPage);
        $paginator->setCurrentPage($page);

        $quotes = $paginator->getCurrentPageResults();

        if (!empty($quotes)) {
            $quotesData = [];
            foreach ($quotes as $quote) {
                $quotesData[] = $serializer->normalize($quote);
            }
            $result = [
                'total' => $paginator->getNbResults(),
                'count' => count($quotesData),
                'quotes' => $quotesData,
            ];
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
