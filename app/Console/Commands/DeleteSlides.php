<?php

namespace App\Console\Commands;

use App\Models\Slide;
use Carbon\Carbon;
use Illuminate\Console\Command;

class DeleteSlides extends Command
{
    protected $signature = 'app:delete-slides';

    protected $description = 'Command description';

    public function handle()
    {
        $yesterday = Carbon::yesterday()->toDateString();
        $slides = Slide::where("delete_date", $yesterday)->get();
        foreach ($slides as $i) {
            $i->delete();
        }
        $this->info("slides deleted");
    }
}
