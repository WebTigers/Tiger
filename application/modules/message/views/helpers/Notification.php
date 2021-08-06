<?php

class Message_View_Helper_Notification extends Zend_View_Helper_Abstract
{
    public function notification ( )
    {
        $notificationService = new Message_Service_Notification([]);
        return $notificationService->getUserNotifications();

    }

}