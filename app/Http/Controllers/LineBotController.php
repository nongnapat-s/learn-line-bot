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

		switch($userText) {
			
    	case "สวัสดี":
		
        		$textMessageBuilder = new \LINE\LINEBot\MessageBuilder\TextMessageBuilder('สวัสดี ID ของคุณคือ '. $userId);
		
    			$response = $bot->replyMessage($replyToken, $textMessageBuilder);
        break;
    	case "ชื่ออะไร":

        		$textMessageBuilder = new \LINE\LINEBot\MessageBuilder\TextMessageBuilder('MedSiCon ค่ะ');
		
    			$response = $bot->replyMessage($replyToken, $textMessageBuilder);
        break;		
    	/*case "ขอดูรูปหน่อย":

+				$img_url = "https://benbrausen.com/wp-content/uploads/2017/05/HTTPSGuideToGoingSecure-240x240.jpg";
+				
				$imageMessageBuilder = new LINE\LINEBot\MessageBuilder\ImageMessageBuilder($img_url);
		
    			$response = $bot->replyMessage($replyToken, $imageMessageBuilder);
        break;		*/
		case "c" :
			$actions = array (
				New \LINE\LINEBot\TemplateActionBuilder\PostbackTemplateActionBuilder("yes", "ans=y"),
				New \LINE\LINEBot\TemplateActionBuilder\PostbackTemplateActionBuilder("no", "ans=N"));
			$button = new \LINE\LINEBot\MessageBuilder\TemplateBuilder\ConfirmTemplateBuilder("problem", $actions);
			$outputText = new \LINE\LINEBot\MessageBuilder\TemplateMessageBuilder("this message to use the phone to look to the Oh", $button);
			$response = $bot->replyMessage($replyToken, $outputText);
			break;
    	    	
   	 	default: 

       			$stickerMessageBuilder = new \LINE\LINEBot\MessageBuilder\StickerMessageBuilder(2,rand(140,158));
		
				$response = $bot->replyMessage($replyToken, $stickerMessageBuilder);
		}
	
				

	
		
				
		
		
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

