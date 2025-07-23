<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;

class ExportUser implements FromCollection
{
    public function collection()
    {
        $return_users = User::where("account_type", "personal")->select('name', 'email', "phone", "phone_sec")->get();
        foreach ($return_users as $user) {
            if (str_contains($user->phone, '+')) {
                $user->phone = str_replace('+', '+ ', $user->phone);
            }
            if (str_contains($user->phone_sec, '+')) {
                $user->phone_sec = str_replace('+', '+ ', $user->phone_sec);
            }
        }
        return $return_users;
    }
}
