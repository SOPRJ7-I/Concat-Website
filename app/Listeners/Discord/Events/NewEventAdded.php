<?php

namespace App\Listeners\Discord\Events;

use Illuminate\Foundation\Events\Dispatchable;

class NewEventAdded
{
    use Dispatchable;

    public $title;
    public $description;
    public $startDate;
    public $url;

    public function __construct(string $title, string $description, string $startDate, string $url)
    {
        $this->title = $title;
        $this->description = $description;
        $this->startDate = $startDate;
        $this->url = $url;
    }
}

