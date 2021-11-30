<?php

declare(strict_types=1);

namespace Machine\EventStoreBundle\Model\History;

interface HistoryCollection
{
    public function save(History $history): void;
    public function get(string $historyId): ?History;
}
