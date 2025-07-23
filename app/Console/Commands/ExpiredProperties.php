<?php

namespace App\Console\Commands;

use App\Mail\ResetPropDate;
use App\Models\Property;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class ExpiredProperties extends Command
{
    protected $signature = 'app:expired-properties';
    protected $description = 'delete property after 1 month';

    public function handle()
    {
        $this->info("Start");
        $this->info(Carbon::now());
        $oneMonthAndHalfAgo = Carbon::now()->subDays(45);
        if (Property::where('created_at', '<', $oneMonthAndHalfAgo)->delete()) {
            $this->info('Deleted');
        }
        $this->info('Properties older than 1 month have been deleted.');

        $oneMonthAgo = Carbon::now()->subMonth();
        $oneMonthAgoProps = Property::where('created_at', '<', $oneMonthAgo)->get();
        if (count($oneMonthAgoProps) > 0) {
            $this->info($oneMonthAgoProps);
            foreach ($oneMonthAgoProps as $prop) {
                $user_email = $prop->user->email;
                $this->info($user_email);
                Mail::to($user_email)->send(new ResetPropDate($prop->title)) ?
                    $this->info('Mail Sent.') :
                    $this->info("there is error");
            }
        }
        $this->info($oneMonthAgo);
        $this->info("Mails Sent");
    }

}
