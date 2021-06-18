<?php


namespace App\Providers;

use App\Src\Application\Command\CreateOrderCommand;
use App\Src\Application\Handler\CreateOrderHandler;
use App\Src\Domain\OrderRepositoryInterface;
use App\Src\Infrastructure\FileOrderRepository;
use Broadway\EventHandling\SimpleEventBus;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\ServiceProvider;

class OrderServiceProvider extends ServiceProvider
{
    public array $bindings = [
        OrderRepositoryInterface::class => FileOrderRepository::class,
        ];

    public function register()
    {
        $this->registerEventBus();
    }

    private function registerEventBus()
    {
        $this->app->bind('eventBus', function() {
            return new SimpleEventBus();
        });
    }

    public function boot(): void
    {
        Bus::map(
            [
                CreateOrderCommand::class => CreateOrderHandler::class,
            ]
        );
    }
}
