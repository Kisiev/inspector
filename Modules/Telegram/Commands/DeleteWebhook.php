<?php

namespace Modules\Telegram\Commands;

use Illuminate\Console\Command;
use Modules\Telegram\Services\Bot\WebhookInterface;

class DeleteWebhook extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'webhook:delete';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete telegram webhook';

    /**
     * Execute the console command.
     */
    public function handle(WebhookInterface $webhookService)
    {
        $webhookService->deleteWebhook();
    }
}
