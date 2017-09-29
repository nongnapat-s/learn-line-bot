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

		$textMessageBuilder = new \LINE\LINEBot\MessageBuilder\TextMessageBuilder($userText . ' ID ของคุณคือ '. $userId);
		
		$response = $bot->replyMessage($replyToken, $textMessageBuilder);

		echo $response->getHTTPStatus() . ' ' . $response->getRawBody();
		
		$replyToken2 = $request->input('events')[0]['replyToken'];

    	$userText2 = $request->input('events')[0]['message']['text'];

    	$userId2 = $request->input('events')[0]['source']['userId'];

        $httpClient2 = new \LINE\LINEBot\HTTPClient\CurlHTTPClient(env('accessToken'));

		$bot2 = new \LINE\LINEBot($httpClient2, ['channelSecret' => env('channelSecret')]);

		$textMessageBuilder2 = new \LINE\LINEBot\MessageBuilder\TextMessageBuilder($userText2 . ' ID ของคุณคือ '. $userId2);
		
		$response2 = $bot2->replyMessage($replyToken2, $textMessageBuilder2);

		echo $response2->getHTTPStatus() . ' ' . $response2->getRawBody();
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
