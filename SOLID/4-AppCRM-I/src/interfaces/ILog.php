<?php

namespace App\interfaces;

use App\components\Log;

interface ILog
{
    public function saveLog(Log $log);
}
