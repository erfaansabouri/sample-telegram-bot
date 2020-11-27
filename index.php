<?php
require 'Telegram.php';
use Erfan\Telegram\Telegram;
ob_start();
$API_KEY = '1404763797:AAH8Td8qEOsf8DOklqxJJrSOzNvsThc2RQc';
$telegram = new Telegram($API_KEY);
$telegram->sendMessage($telegram->getChatId() , $telegram->getChatId());