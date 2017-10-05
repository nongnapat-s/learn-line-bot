<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Monolog\Handler\FirePHPHandler;

class LineBotController extends Controller
{
    public function reply(Request $request)
    {
    	$replyToken = $request->input('events')[0]['replyToken'];

    	$userText = $request->input('events')[0]['message']['text'];

    	$userId = $request->input('events')[0]['source']['userId'];
		
        $httpClient = new \LINE\LINEBot\HTTPClient\CurlHTTPClient(env('accessToken'));

		$bot = new \LINE\LINEBot($httpClient, ['channelSecret' => env('channelSecret')]);
		
		$textMessageBuilder = new \LINE\LINEBot\MessageBuilder\TextMessageBuilder($userText. ' ID ของคุณคือ '. $userId);
		
    	$response = $bot->replyMessage($replyToken, $textMessageBuilder);
		
		$stickerMessageBuilder = new \LINE\LINEBot\MessageBuilder\StickerMessageBuilder(2,rand(140,158));
		
		$response2 = $bot->pushMessage($userId, $stickerMessageBuilder);
		
		$img_url = "https://benbrausen.com/wp-content/uploads/2017/05/HTTPSGuideToGoingSecure-240x240.jpg";
		
		$img_url = "https://benbrausen.com/wp-content/uploads/2017/05/HTTPSGuideToGoingSecure-240x240.jpg";
		
		$imageMessageBuilder = new LINE\LINEBot\MessageBuilder\ImageMessageBuilder($img_url, $img_url);
		
		$response3 = $bot->pushMessage($userId, $imageMessageBuilder);
		
		echo $response->getHTTPStatus() . ' ' . $response->getRawBody();

    	/*$webHookData = '{
						  	"events": [
						      {
						        "replyToken": "nHuyWiB7yP5Zw52FIkcQobQuGDXCTA",
						        "type": "message",
						        "timestamp": 1462629479859,
						        "source": {
						             "type": "user",
						             "userId": "U206d25c2ea6bd87c17655609a1c37cb8"
						         },
						         "message": {
						             "id": "325708",
						             "type": "text",
						             "text": "Hello, world"
						          }
						      }
						  ]
						}';
		return json_decode($webHookData);
     	//return $request->all(); //all เป็น method ที่เก็บข้อมูลที่จาก Request ex. input('firstname')*/
    }
}

