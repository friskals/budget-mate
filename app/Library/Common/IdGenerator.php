<?php

namespace App\Service;

use App\Models\Category;
use Carbon\Carbon;

class IdGenerator{
    public static function generateId(string $entity){

        switch ($entity){
            case "CATEGORY":
                $infix = 'CTRY';
                break;
            case "ACCOUNT":
                $infix = "ACCT";
                break;
            case "BUDGET":
                $infix = "BDGT";
                break;
            case "BUDGET_USAGE";
                $infix = "BDSE";
                break;
            default:
                $infix = "DFLT";
        }

        $currentTimestamp = Carbon::now()->format('Y-m-d H:i:s.u');

        $numericTime = preg_replace("/[^0-9]/", '', $currentTimestamp);

        $hashedValue = hash('sha256', $numericTime);

        $hashedSubstring = substr($hashedValue, 0, strlen($numericTime)-1);

        return $numericTime.$infix.$hashedSubstring;
    }
}
