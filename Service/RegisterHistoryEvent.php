<?php

declare(strict_types=1);

namespace Machine\EventStoreBundle\Service;

use Machine\EventStoreBundle\Model\History\Event\HistoricEvent;
use Machine\EventStoreBundle\Model\History\History;
use Machine\EventStoreBundle\Model\History\HistoryCollection;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

class RegisterHistoryEvent implements MessageHandlerInterface
{
    private HistoryCollection $historyCollection;

    public function __construct(HistoryCollection $historyCollection)
    {
        $this->historyCollection = $historyCollection;
    }

    public function __invoke(HistoricEvent $event)
    {
        $history = ($this->historyCollection->get(History::HISTORY_ID) ?? History::createHistory())->recordEvent($event);
        $this->historyCollection->save($history);
    }
}
