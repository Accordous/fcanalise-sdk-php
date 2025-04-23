<?php

namespace Accordous\FcAnalise\Tests;

use Accordous\FcAnalise\FcAnaliseServiceProvider;
use Dotenv\Dotenv;
use Faker\Factory as FakerFactory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Orchestra\Testbench\TestCase as Orchestra;

class TestCase extends Orchestra
{
    protected \Faker\Generator $faker;

    protected function setUp(): void
    {
        parent::setUp();

        $this->faker = FakerFactory::create('pt_BR');

        Factory::guessFactoryNamesUsing(
            fn (string $modelName) => 'Accordous\\FcAnalise\\Database\\Factories\\'.class_basename($modelName).'Factory'
        );
    }

    protected function getPackageProviders($app)
    {
        return [
            FcAnaliseServiceProvider::class,
        ];
    }

    public function getEnvironmentSetUp($app)
    {
        config()->set('database.default', 'testing');

        // Load environment from .env.testing file
        if (file_exists(dirname(__DIR__).'/.env.testing')) {
            Dotenv::createImmutable(dirname(__DIR__), '.env.testing')->load();
        }

        /*
         foreach (\Illuminate\Support\Facades\File::allFiles(__DIR__ . '/database/migrations') as $migration) {
            (include $migration->getRealPath())->up();
         }
         */
    }
}
