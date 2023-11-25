<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;

class ExportCompany implements FromCollection
{
    public function collection()
    {
        $return_users = User::where("account_type", "company")->select('company_name', 'company_type', "email", "phone", "location")->get();
        foreach ($return_users as $user) {
            if (str_contains($user->phone, '+')) {
                $user->phone = str_replace('+', '+ ', $user->phone);
            }
        }
        return $return_users;
    }
}
