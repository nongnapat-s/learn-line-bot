<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LineBotController extends Controller
{
    public function reply(Request $request)
    {
    	$replyToken = $request->input('events')[0]['replyToken'];

    	$userText = $request->input('events')[0]['message']['text'];

    	$userId = $request->input('events')[0]['source']['userId'];
		
        $httpClient = new \LINE\LINEBot\HTTPClient\CurlHTTPClient(env('accessToken'));

		$bot = new \LINE\LINEBot($httpClient, ['channelSecret' => env('channelSecret')]);
		
		$textMessageBuilder = new \LINE\LINEBot\MessageBuilder\TextMessageBuilder($userText);
		
    	$response = $bot->replyMessage($replyToken, $textMessageBuilder);
        
		$textMessageBuilder2 = new \LINE\LINEBot\MessageBuilder\TextMessageBuilder('ID ของคุณคือ '. $userId);
		
		$response2 = $bot->pushMessage($userId, $textMessageBuilder2);
		
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
