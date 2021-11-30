<?php

declare(strict_types=1);

namespace Machine\EventStoreBundle\Factory;

use DateTimeImmutable;
use DateTimeZone;
use Machine\EventStoreBundle\Model\History\Event\HistoryEventOccurred;
use Prooph\Common\Messaging\Message;
use Prooph\Common\Messaging\MessageFactory;
use Ramsey\Uuid\Uuid;

class EventStoreMessageFactory implements MessageFactory
{
    public function createMessageFromArray(string $messageName, array $messageData): Message
    {
        if (!isset($messageData['message_name'])) {
            $messageData['message_name'] = $messageName;
        }

        if (!isset($messageData['uuid'])) {
            $messageData['uuid'] = Uuid::uuid4()->toString();
        }

        if (!isset($messageData['created_at'])) {
            $messageData['created_at'] = new DateTimeImmutable('now', new DateTimeZone('UTC'));
        }

        if (!isset($messageData['metadata'])) {
            $messageData['metadata'] = [];
        }

        return HistoryEventOccurred::fromArray($messageData);
    }
}
