<?php
namespace Erfan\Telegram;
class Telegram
{
    public $apiKey;
    public $update;
    public $message;
    public $from_id;
    public $chat_id;
    public $message_id;

    function __construct($apiKey)
    {
        $this->apiKey = $apiKey;
        $this->update = json_decode(file_get_contents('php://input'));
        $this->message = $this->update->message;
        $this->from_id = $this->message->from->id;
        $this->chat_id = $this->message->chat->id;
        $this->message_id = $this->message->message_id;
    }

    private function bot($method, $datas = [])
    {
        $url = "https://api.telegram.org/bot" . $this->apiKey . "/" . $method;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $datas);
        $res = curl_exec($ch);
        if (curl_error($ch)) {
            var_dump(curl_error($ch));
        } else {
            return json_decode($res);
        }
    }

    public function getChatId(){
        return $this->chat_id;
    }

    public function sendMessage($chatId,$text)
    {
        self::bot('sendMessage', [
            'chat_id' => $chatId,
            'text' => $text,
        ]);
    }
}