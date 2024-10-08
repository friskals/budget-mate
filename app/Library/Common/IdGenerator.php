<?php

namespace App\Library\Common;

use App\Enums\EntityEnum;
use Carbon\Carbon;

class IdGenerator{
    public static function generateId(EntityEnum $entity){

        switch ($entity){
            case EntityEnum::CATEGORY:
                $infix = 'CTRY';
                break;
            case EntityEnum::ACCOUNT:
                $infix = 'ACCT';
                break;
            case EntityEnum::TRANSACTION:
                $infix = 'TSTN';
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
