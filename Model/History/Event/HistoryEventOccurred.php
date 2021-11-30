<?php

declare(strict_types=1);

namespace Machine\EventStoreBundle\Model\History\Event;

use Machine\EventStoreBundle\Model\History\History;
use Prooph\EventSourcing\AggregateChanged;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\SerializerInterface;

class HistoryEventOccurred extends AggregateChanged
{
    public static function withEvent(HistoricEvent $event)
    {
        $historyEventOccurred = self::occur(History::HISTORY_ID, static::createNormalizer()->normalize($event));
        $historyEventOccurred->messageName = get_class($event);

        return $historyEventOccurred;
    }

    private static function createNormalizer(): SerializerInterface
    {
        return new Serializer([new ObjectNormalizer()], [new JsonEncoder()]);
    }
}
