<?php

namespace Modules\Telegram\Commands;

use Illuminate\Console\Command;
use Modules\Telegram\Services\Bot\ClientBot;
use Modules\Telegram\Services\Bot\WebhookInterface;

class SetWebhook extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'webhook:set {url}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Set telegram webhook';

    /**
     * Execute the console command.
     */
    public function handle(WebhookInterface $webhookService)
    {
        $webhookService->setWebhook($this->argument('url') . '/telegram/webhook');
    }
}
