<?php

namespace App\Providers;

use App\Services\TaskAdvisor\DemoTaskAdvisor;
use App\Services\TaskAdvisor\OpenAiResponseTextExtractor;
use App\Services\TaskAdvisor\OpenAiTaskAdvisor;
use App\Services\TaskAdvisor\TaskAdvisorInterface;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(TaskAdvisorInterface::class, function (Application $app): TaskAdvisorInterface {
            if (config('services.ai.provider') === 'openai') {
                return new OpenAiTaskAdvisor(
                    apiKey: (string) config('services.openai.key', ''),
                    model: (string) config('services.openai.model', 'gpt-5.4-mini'),
                    baseUrl: (string) config('services.openai.base_url', 'https://api.openai.com/v1'),
                    extractor: $app->make(OpenAiResponseTextExtractor::class),
                );
            }

            return $app->make(DemoTaskAdvisor::class);
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
