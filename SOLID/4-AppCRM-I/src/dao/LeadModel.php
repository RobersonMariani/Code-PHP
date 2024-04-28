<?php

namespace App\dao;

use App\BD;
use App\components\Notification;
use App\interfaces\ICadastro;
use App\interfaces\INotification;

class LeadModel extends BD implements ICadastro, INotification
{
    public function save()
    {
    }

    public function sendNotification(Notification $notification)
    {
    }
}
