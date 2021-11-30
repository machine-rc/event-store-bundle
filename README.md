MachineEventStoreBundle
=========================

What is this?
-------------

This bundle with minimal configuration will be able to log incoming/outgoing messages.

Installation
------------

    composer require machine-rc/event-store-bundle

Configuration
-------------
In `.env` configure following environment values:  
```bash
EVENT_STORE_DSN="mysql://user:password@host:3306/event_store?serverVersion=5.7&charset=utf8"
MYSQL_DSN=mysql:host=host;dbname=event_store
MYSQL_USER=user
MYSQL_PASSWORD=password
```

**Note**  
To avoid migration from being generated, you can use schema filter in `doctrine.yaml`:
```yaml
doctrine:
  dbal:
    connections:
        default:
            url: '%env(resolve:DATABASE_URL)%'
            schema_filter: ~^(?!history)~ # we ignore history table, so migration will not pick up this change
```

### Setting up event store database
Inside `Resources/scripts/...` there are several scripts for different database engines.
Once you decide which engine you will be using, 
you need to create `event_streams` table with relevant `01_event_streams_table.sql`.
History table with events will be populated automatically, but we need `event_streams` table active to have integration working.

### Registering events to event store
To register event inside event store, simply implement `HistoricEvent` interface.

# Support

Inspiration taken from [prooph/event-store-symfony-bundle](https://github.com/prooph/event-store-symfony-bundle)
This bundle depends on prooph components for event store implementation.
By using this bundle we avoid the need to configure same components in each service
that intends to use basic event store functionality.

For issues related with bundle itself, 
please file them here [https://github.com/machine-rc/event-store-bundle/issues](https://github.com/machine-rc/event-store-bundle/issues)