<?php

namespace App\Console\Commands;

use App\Mail\CommunityNightNotification;
use App\Models\CommunityNight;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendCommunityNightReminders extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:send-community-night-reminders';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Stuurt herinneringen voor community avonden die over 3 dagen plaatsvinden.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
         $this->info('Controleren op aankomende community avonden...');

        // Haal alle community avonden op die precies over 3 dagen plaatsvinden
        // We vergelijken alleen de datum, niet de tijd, voor "3 dagen van tevoren"
        $targetDate = Carbon::today()->addDays(3)->toDateString();

        $communityAvonden = CommunityNight::whereDate('start_time', $targetDate) // <-- HIER IS DE WIJZIGING
                                            ->get();

        if ($communityAvonden->isEmpty()) {
            $this->info('Geen community avonden gevonden die een herinnering nodig hebben voor ' . $targetDate . '.');
            return Command::SUCCESS;
        }

        $this->info(count($communityAvonden) . ' community avond(en) gevonden voor ' . $targetDate . '.');

        foreach ($communityAvonden as $avond) {
            // Haal de studenten op die de notificatie moeten ontvangen
            // Dit is een placeholder. Pas dit aan op basis van hoe je studenten beheert.
            // Bijvoorbeeld: alle gebruikers, of gebruikers met een specifieke rol.
            $students = User::all(); // Of User::where('role', 'student')->get();

            foreach ($students as $student) {
                // Verstuur de e-mail
                try {
                    Mail::to($student->email)->send(new CommunityNightNotification($avond));
                    $this->info('E-mail verstuurd voor "' . $avond->title . '" naar ' . $student->email);
                } catch (\Exception $e) {
                    $this->error('Fout bij versturen van e-mail voor "' . $avond->title . '" naar ' . $student->email . ': ' . $e->getMessage());
                }
            }
        }

        $this->info('Herinneringen succesvol verstuurd.');
        return Command::SUCCESS;
    }
}
