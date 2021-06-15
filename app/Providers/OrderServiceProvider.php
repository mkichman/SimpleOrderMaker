<?php


namespace App\Providers;

use Broadway\CommandHandling\SimpleCommandBus;
use Broadway\EventHandling\SimpleEventBus;
use Broadway\ReadModel\InMemory\InMemoryRepository;
use Illuminate\Support\ServiceProvider;

class OrderServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->registerCommandBus();
        $this->registerEventBus();
        $this->registerInMemoryRepository();
    }

    private function registerInMemoryRepository()
    {
        $this->app->bind('inMemoryRepository', function() {
            return new InMemoryRepository();
        });
    }

    private function registerEventBus()
    {
        $this->app->bind('eventBus', function() {
            return new SimpleEventBus();
        });
    }

    private function registerCommandBus()
    {
        $this->app->bind('commandBus', function() {
            return new SimpleCommandBus();
        });
    }
}
