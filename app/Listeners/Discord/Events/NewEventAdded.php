<?php

namespace App\Listeners\Discord\Events;

use Illuminate\Foundation\Events\Dispatchable;

class NewEventAdded
{
    use Dispatchable;

    public $title;
    public $description;
    public $startDate;
    public $startTime;
    public $location;
    public $spotsAvailable;
    public $url;
    public $type;

    public function __construct(string $title, string $description, string $startDate, string $startTime, string $location, int $spotsAvailable, string $url)
    {
        $this->title = $title;
        $this->description = $description;
        $this->startDate = $startDate;
        $this->startTime = $startTime;
        $this->location = $location;
        $this->spotsAvailable = $spotsAvailable;
        $this->url = $url;
        $this->type = 'event';
    }
}

