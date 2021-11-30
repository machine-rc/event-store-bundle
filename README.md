MachineEventStoreBundle
=========================

What is this?
-------------

This bundle with minimal configuration will be able to log incoming/outgoing messages.

Installation
------------

    composer require machine-rc/event-store-bundle

[comment]: <> (@todo EVENT_STORE_DSN)
[comment]: <> (@todo explain schema_filter: ~^&#40;?!history&#41;~)

Configuration
-------------
In your config.yml place:

    machine_event_store: ~
