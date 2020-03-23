<META http-equiv="refresh" content="120; URL=miner_autostart.php">

<?

		$key_miner_id = 'YOUR_ID';
		$pincode = 'YOUR_PINCODE';
		$action = 'start';
		

        /* API URL */
		$url_list="https://mib-api.mibcoin.io/miner_list.php?id=$key_miner_id";

		$result = null;
		$result = call_api($url_list);
		 
		if (gettype($result) == "object"){

			foreach ($result as $key => $value){
				echo $key." : ";
				echo $value;
				echo "<br/>";
			};

		} else {

			foreach ($result as $row) {
				if (empty($row->hash_rate)){

					$work_name = '';
					$work_name = $row->work_name;

					/* API URL */
					$url_action="https://mib-api.mibcoin.io/miner_action.php?id=$key_miner_id&work_name=$work_name&action=$action&pincode=$pincode";
					$result_action = call_api($url_action);

					//var_dump($result);

					echo $row->id;
					echo '-><b>';
					echo $row->work_name;
					echo '</b> : ';

					echo api_error_msg($result_action);
					echo "<br>";


				}
			}

		}


	////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

	function call_api($url){

		$ch = curl_init(); 
		curl_setopt($ch, CURLOPT_URL, $url); 

		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE); 
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0); 

		curl_setopt($ch, CURLOPT_HEADER, 0); 
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 

		$result = json_decode(remove_utf8_bom(curl_exec($ch)));
		curl_close($ch); 


		return $result;
	}

	function checkBOM($str){
			if(substr($str, 0,3) == pack("CCC",0xef,0xbb,0xbf)){
			return 1;
		}
		return 0;
	}


	function remove_utf8_bom($str){
		if (checkBOM($str) == 1){
			$bom = pack('H*','EFBBBF');
			$str = preg_replace("/^$bom/", '', $str);
		}

		return $str;
	}

	function api_error_msg($json_object){

		$msg = $json_object->msg;

		switch ($msg) {
			case 'success':
				$result = 'success (It will restart in 60 seconds.)';
				break;
			case 'fail-no id or worker':
				$result = 'Your ID password not working';
				break;
			case 'fail-no action':
				$result = 'action is required.';
				break;
			default:
				$result = $msg;
			break;
		}
		
		return $result;
	}

	function error_msg(){
		switch (json_last_error()) {
			case JSON_ERROR_NONE:
				$result = '';
			break;
			case JSON_ERROR_DEPTH:
				$result = ' - Maximum stack depth exceeded';
			break;
			case JSON_ERROR_STATE_MISMATCH:
				$result = ' - Underflow or the modes mismatch';
			break;
			case JSON_ERROR_CTRL_CHAR:
				$result = ' - Unexpected control character found';
			break;
			case JSON_ERROR_SYNTAX:
				$result = ' - Syntax error, malformed JSON';
			break;
			case JSON_ERROR_UTF8:
				$result = ' - Malformed UTF-8 characters, possibly incorrectly encoded';
			break;
			default:
				$result = ' - Unknown error';
			break;
		}
		
		return $result;
	}

?>
<br><br>
* Peer will restart in 60 seconds after success. Repeating the executable command will not be overlapped.<br>
* If pincode does not match, set the pincode from Controll again.<br>
* The mib miner is not connected if it does not show an idx.<br>

<br>
* success후 60초안에 Peer는 재시작합니다. 다시 실행 명력을 내려도 중복 적용 되지 않습니다. <br>
* pincode가 맞지 않는 경우 Controller 의 pincode를 다시 설정하십시요.<br>
* mib miner에 idx 번호가 나오지 않으면 접속이 안된 상태입니다. <br>