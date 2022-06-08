<?php

declare(strict_types=1);

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\IdGenerator\UuidGenerator;
use Symfony\Component\Uid\Uuid;

#[
    ORM\Entity,
    ORM\Table(name: 'quote')
]
class Quote
{
    #[
        ORM\Id,
        ORM\Column(type: 'uuid'),
        ORM\GeneratedValue(strategy: 'CUSTOM'),
        ORM\CustomIdGenerator(class: UuidGenerator::class)
    ]
    private Uuid $id;

    #[
        ORM\Column(type: 'integer'),
        ORM\GeneratedValue(strategy: 'AUTO')
    ]
    private readonly int $quoteId;

    #[ORM\Column(name: 'content', type: 'text')]
    private string $content;

    #[ORM\Column(name: 'score', type: 'integer', options: ['default' => 0])]
    private int $score;

    #[ORM\Column(name: 'created_at', type: 'datetime_immutable')]
    private readonly \DateTimeImmutable $createdAt;

    #[ORM\Column(type: 'datetime', nullable: false, options: ['default' => 'CURRENT_TIMESTAMP'])]
    private \DateTime $updatedAt;

    public function __construct(Uuid $id, string $content, int $score = 0)
    {
        $this->id = $id;
        $this->content = $content;
        $this->score = $score;
        $this->createdAt = new \DateTimeImmutable();
        $this->updatedAt = new \DateTime();
    }

    public function getId(): Uuid
    {
        return $this->id;
    }

    public function getQuoteId(): int
    {
        return $this->quoteId;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function getScore(): int
    {
        return $this->score;
    }

    public function getCreatedAt(): \DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function getUpdatedAt(): \DateTime
    {
        return $this->updatedAt;
    }
}
