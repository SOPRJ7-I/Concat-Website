<?php

namespace App\Listeners\Discord\Events;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;

class NotifyDiscordEventChannel
{
    public function handle(NewEventAdded $event): void
    {
        $webhookUrl = env('DISCORD_WEBHOOK_EVENTS');

        if (!$webhookUrl) {
            Log::error('Discord webhook URL ontbreekt! Controleer .env bestand.');
            return;
        }

        $client = new Client();

        $embed = [
            // Gebruik author voor de SV Concat link bovenaan
            'author' => [
                'name' => 'SV Concat Events',
                'url' => $event->url ?? route('events.index'), // Fallback URL
                'icon_url' => 'https://media.licdn.com/dms/image/v2/C4D0BAQFWHZvu8s8ugg/company-logo_400_400-alternative/company-logo_400_400-alternative/0/1630520127352?e=2147483647&v=beta&t=g331t3valI0YipGszLqGl4MhTak2EiiCNgGsv-7YOLQ'
            ],
            // Verplaats de titel naar de beschrijving met Markdown
            'description' => "# [{$event->title} ➜]({$event->url})\n\n{$event->description}\n\n### ➤ Evenement Details:",
            'color' => 3447003, // Blauwe kleur

            'fields' => [
                [
                    'name' => 'Datum:',
                    'value' => $event->startDate ?? 'Datum nog niet bekend',
                    'inline' => true,
                ],
                [
                    'name' => 'Begintijd:',
                    'value' => $event->startTime ?? 'Tijd nog niet bekend',
                    'inline' => true,
                ],
                [
                    'name' => 'Locatie:',
                    'value' => $event->location ?? 'Locatie nog niet bekend',
                    'inline' => true,
                ],
                [
                    'name' => 'Beschikbare plaatsen:',
                    'value' => $event->spotsAvailable ?? 'Onbeperkt',
                    'inline' => true,
                ],
            ],
        ];

        // Voeg thumbnail toe als er een afbeelding is
        if ($event->imageUrl) {
            $embed['thumbnail'] = [
                'url' => $event->imageUrl
            ];
        }

        // Voeg de standaard banner afbeelding toe
        $embed['image'] = [
            'url' => 'https://media.licdn.com/dms/image/v2/C4D1BAQEsBgAIDepVEQ/company-background_10000/company-background_10000/0/1628857370852/sv_concat_cover?e=2147483647&v=beta&t=DNJgiP1z1agixG0WVtcOTirtMmUNP8BiwzK127i13j4'
        ];

        $message = [
            'embeds' => [$embed],
        ];

        try {
            $client->post($webhookUrl, ['json' => $message]);
        } catch (\Exception $e) {
            Log::error('Fout bij het versturen naar Discord webhook: ' . $e->getMessage());
        }
    }
}
