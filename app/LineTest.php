<?php

namespace App;

class LineTest  {
	public static function webHookData()
	{
		$example = '{
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
					}'; //ตัวอย่างที่ data จะส่งมาทาง webhook
		$arrData = json_decode($example,true);
		return $arrData['events'][0]['message']['text']; //[index][ชุดของ array][arrayที่ต้องการ]

	}
}