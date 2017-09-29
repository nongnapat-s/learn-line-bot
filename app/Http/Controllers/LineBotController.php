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

		$columns = array();
		$img_url = "https://cdn.shopify.com/s/files/1/0379/7669/products/sampleset2_1024x1024.JPG?v=1458740363";
		for($i=0;$i<5;$i++) {
 			 $actions = array(
   			 	new \LINE\LINEBot\TemplateActionBuilder\PostbackTemplateActionBuilder("Add to Cart","action=carousel&button=".$i),
    			new \LINE\LINEBot\TemplateActionBuilder\UriTemplateActionBuilder("View","http://www.google.com")
  			);
  		$column = new \LINE\LINEBot\MessageBuilder\TemplateBuilder\CarouselColumnTemplateBuilder("Title", "description", $img_url , $actions);
  		$columns[] = $column;
		}
		$carousel = new \LINE\LINEBot\MessageBuilder\TemplateBuilder\CarouselTemplateBuilder($columns);
		$outputText = new \LINE\LINEBot\MessageBuilder\TemplateMessageBuilder("Carousel Demo", $carousel);

		/*$textMessageBuilder = new \LINE\LINEBot\MessageBuilder\TextMessageBuilder($userText . ' ID ของคุณคือ '. $userId);
		
		$response = $bot->replyMessage($replyToken, $textMessageBuilder);*/

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
