<?php

$data = json_decode($body, true);
    if(is_array($data['events'])){
        foreach ($data['events'] as $event) {
            if ($event['type'] == 'message') {
                if($event['message']['type'] == 'text') {
                    // send same message as reply to user
                    $result = $bot->replyText($event['replyToken'], 'Congratulation!');

                    // or we can use replyMessage() instead to send reply message
                    // $textMessageBuilder = new TextMessageBuilder($event['message']['text']);
                    // $result = $bot->replyMessage($event['replyToken'], $textMessageBuilder);

                    $response->getBody()->write(json_encode($result->getJSONDecodedBody()));
                    return $response
                        ->withHeader('Content-Type', 'application/json')
                        ->withStatus($result->getHTTPStatus());
                }
            }
        }
    }