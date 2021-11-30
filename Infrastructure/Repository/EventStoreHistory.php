<?php

declare(strict_types=1);

namespace Machine\EventStoreBundle\Infrastructure\Repository;

use Machine\EventStoreBundle\Model\History\History;
use Machine\EventStoreBundle\Model\History\HistoryCollection;
use Prooph\EventSourcing\Aggregate\AggregateRepository;
use Prooph\EventSourcing\Aggregate\AggregateType;
use Prooph\EventSourcing\EventStoreIntegration\AggregateTranslator;
use Prooph\EventStore\EventStore;

final class EventStoreHistory extends AggregateRepository implements HistoryCollection
{
    public function __construct(EventStore $eventStore)
    {
        parent::__construct(
            $eventStore,
            AggregateType::fromAggregateRootClass(History::class),
            new AggregateTranslator(),
            null,
            null,
            true
        );
    }

    public function save(History $history): void
    {
        $this->saveAggregateRoot($history);
    }

    public function get(string $historyId): ?History
    {
        return $this->getAggregateRoot($historyId);
    }
}
