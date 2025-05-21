<?php

namespace App\Listeners\Discord;

use App\Listeners\Discord\Events\NewEventAdded;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;

class NotifyDiscordEventChannel
{
    public function handle(NewEventAdded $event): void
    {
        $webhookUrl = env('DISCORD_EVENTS_WEBHOOK');

        if (!$webhookUrl) {
            Log::error('Discord webhook URL ontbreekt! Controleer .env bestand.');
            return;
        }

        $client = new Client();

        $message = [
            'embeds' => [
                [
                    'title' => $event->title,
                    'description' => $event->description,
                    'url' => $event->url,
                    'color' => 7506394,
                    'fields' => [
                        [
                            'name' => 'Startdatum',
                            'value' => $event->startDate,
                            'inline' => false,
                        ],
                    ],
                ],
            ],
        ];

        try {
            $client->post($webhookUrl, ['json' => $message]);
        } catch (\Exception $e) {
            Log::error('Fout bij het versturen naar Discord webhook: ' . $e->getMessage());
        }
    }
}
