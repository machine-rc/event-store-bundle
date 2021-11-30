<?php

declare(strict_types=1);

namespace Machine\EventStoreBundle;

use Machine\EventStoreBundle\DependencyInjection\EventStoreExtension;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class EventStoreBundle extends Bundle
{
    public function getContainerExtension()
    {
        if (null === $this->extension) {
            $this->extension = new EventStoreExtension();
        }

        return $this->extension;
    }
}
