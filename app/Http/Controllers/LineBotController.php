<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LineBotController extends Controller
{
    public function reply(Request $request)
    {
    	
       // $httpClient = new \LINE\LINEBot\HTTPClient\CurlHTTPClient(env('accessToken'));

		$strAccessToken = new \LINE\LINEBot\HTTPClient\CurlHTTPClient(env('accessToken'));
		$content = file_get_contents('php://input');
		$arrJson = json_decode($content, true);
 		$strUrl = "https://api.line.me/v2/bot/message/reply";
 		$arrHeader = array();
		$arrHeader[] = "Content-Type: application/json";
		$arrHeader[] = "Authorization: Bearer {$strAccessToken}";
 
		if($arrJson['events'][0]['message']['text'] == "สวัสดี"){
  			$arrPostData = array();
  			$arrPostData['replyToken'] = $arrJson['events'][0]['replyToken'];
  			$arrPostData['messages'][0]['type'] = "text";
  			$arrPostData['messages'][0]['text'] = "สวัสดี ID คุณคือ ".$arrJson['events'][0]['source']['userId'];
		}else if($arrJson['events'][0]['message']['text'] == "ชื่ออะไร"){
  			$arrPostData = array();
  			$arrPostData['replyToken'] = $arrJson['events'][0]['replyToken'];
  			$arrPostData['messages'][0]['type'] = "text";
  			$arrPostData['messages'][0]['text'] = "MedSiCon ค่ะ";
		}else if($arrJson['events'][0]['message']['text'] == "ทำอะไรได้บ้าง"){
  			$arrPostData = array();
  			$arrPostData['replyToken'] = $arrJson['events'][0]['replyToken'];
  			$arrPostData['messages'][0]['type'] = "text";
  			$arrPostData['messages'][0]['text'] = "ฉันทำอะไรไม่ได้เลย คุณต้องสอนฉันอีกเยอะ";
		}else{
  			$arrPostData = array();
  			$arrPostData['replyToken'] = $arrJson['events'][0]['replyToken'];
  			$arrPostData['messages'][0]['type'] = "image";
  			$arrPostData['messages'][0]['image'] = 'http://th.seaicons.com/wp-content/uploads/2016/03/filetype-jpg-icon.png';
		}
 
 
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL,$strUrl);
		curl_setopt($ch, CURLOPT_HEADER, false);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $arrHeader);
		curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($arrPostData));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		$result = curl_exec($ch);
		curl_close ($ch);
	    }
}

//https://www.unzeen.com/article/3506/