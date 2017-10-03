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
		
        $httpClient = new \LINE\LINEBot\HTTPClient\CurlHTTPClient(env('FhO+ayYVWCyleSJC6eI0uDCICRv7MCYre72ocOTeyVtUbYp740dAJMtvOce9tS+aNoUm+GIemTsv63kHA3w5dtBdtlLWc+xGB39Ghc0zzf06jeWN67D0xckWEnMkC1VRkxaeG3Z61QsNV9eOYmXyLAdB04t89/1O/w1cDnyilFU='));

		$bot = new \LINE\LINEBot($httpClient, ['channelSecret' => env('5f6c08aaad8f7da89adb056ddb7dd514
')]);
		
		$textMessageBuilder = new \LINE\LINEBot\MessageBuilder\TextMessageBuilder($userText. ' ID ของคุณคือ '. $userId);
		
    	$response = $bot->replyMessage($replyToken, $textMessageBuilder);
        
		$SKID = 1;
		$stickerMessageBuilder = new \LINE\LINEBot\MessageBuilder\StickerMessageBuilder(2,rand(140,158));
		
		$response2 = $bot->pushMessage($userId, $stickerMessageBuilder);
		
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

