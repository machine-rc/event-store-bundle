<?php

declare(strict_types=1);

namespace Machine\EventStoreBundle\Model\History;

use Machine\EventStoreBundle\Model\History\Event\HistoricEvent;
use Machine\EventStoreBundle\Model\History\Event\HistoryEventOccurred;
use Prooph\EventSourcing\AggregateChanged;
use Prooph\EventSourcing\AggregateRoot;

class History extends AggregateRoot
{
    public const HISTORY_ID = 'a5b5dc11-83fe-4116-817c-49571c8d1496';
    private ?string $historyId = self::HISTORY_ID;

    protected function aggregateId(): string
    {
        return $this->historyId;
    }

    protected function apply(AggregateChanged $event): void
    {
        // @todo implement externally injected factories or similar method to allow bundle users to apply some actions
    }

    public function recordEvent(HistoricEvent $event): History
    {
        $this->recordThat(HistoryEventOccurred::withEvent($event));

        return $this;
    }

    public static function createHistory(string $historyId = self::HISTORY_ID): History
    {
        $self = new self();
        $self->historyId = $historyId;

        return $self;
    }
}
