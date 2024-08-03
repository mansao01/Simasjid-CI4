<?php
$content = file_get_contents("php://input");

if ($content) {

    $token = "7350718072:AAFSCi4GXyj6cQbvi8qEOjyy5IFvMb6SiZg";


    $apiLink = "https://api.telegram.org/bot$token/";
    // https://api.telegram.org/bot7350718072:AAFSCi4GXyj6cQbvi8qEOjyy5IFvMb6SiZg
    $update = json_decode($content, true);

    //tes API : https://api.telegram.org/bot7350718072:AAFSCi4GXyj6cQbvi8qEOjyy5IFvMb6SiZg/setwebhook?url=https://c068-103-153-246-133.ngrok-free.app/webhook/

    $chat_id = $update['message']['chat']['id'];
    $text = $update['message']['text'];
    $chat_name = $update['message']['chat']['first_name'] . '' . $update['message']['chat']['username'];

    file_get_contents($apiLink . "sendmessage?chat_id=$chat_id&text=Hai $chat_name, aku tau kamu " . $text);
    // file_get_contents($apiLink . "sendmessage?chat_id=$chat_id&text=Hai $chat_name, yang kamu ketikkan " . $text);
    // https://api.telegram.org/bot7350718072:AAFSCi4GXyj6cQbvi8qEOjyy5IFvMb6SiZg/sendmessage?chat_id
} else {
    echo "Hanya Telegram yang dapat mengakses URL ini...!!";
}
