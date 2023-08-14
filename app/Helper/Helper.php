<?php

namespace App\Helper;

use App\Acknowledgment;

class Helper
{
  public static function formatDate($date = null)
  {
    if (!$date) return null;
    return date('m/d/Y', strtotime($date));
  }
  
  public static function getAcknowledge($messageCode = null)
  {
    $message = '';
    $messageType = '';

    if ($messageCode) {
      $data = Acknowledgment::where('message_code', $messageCode)->first();
      $message = $data->message;
      $messageType = $data->message_type;
    }

    return ['message' => $message, "messageType" => $messageType];
  }
}
