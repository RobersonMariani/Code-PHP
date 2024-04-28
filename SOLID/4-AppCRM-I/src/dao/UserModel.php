<?php

namespace App\dao;

use App\BD;
use App\components\Log;
use App\components\Notification;
use App\interfaces\ICadastro;
use App\interfaces\ILog;
use App\interfaces\INotification;

class UserModel extends BD implements ICadastro, ILog, INotification
{
    public function save()
    {
    }

    public function saveLog(Log $log)
    {
    }

    public function sendNotification(Notification $notification)
    {
    }
}
