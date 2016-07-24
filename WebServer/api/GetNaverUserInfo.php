<?
			
        include '../db_conn.php';    
		// $decode = json_decode($json, true);
		// $access_token =  $decode['access_token'];
		// $refresh_token =  $decode['refresh_token'];
		// $token_type =  $decode['token_type'];

        $access_token = $_REQUEST['token'];
        $token_type = $_REQUEST['type'];
        $auth_token = $token_type." ".$access_token;
			
		$url = 'https://openapi.naver.com/v1/nid/getUserProfile.xml';
		
		
		$opts = array(
		  'http'=>array(
		  	'method' => "GET",
		  	'header' => "User-Agent: curl/7.12.1 (i686-redhat-linux-gnu) libcurl/7.12.1 OpenSSL/0.9.7a zlib/1.2.1.2 libidn/0.5.6\r\n".
			"Host: openapi.naver.com\r\n".
			"Pragma: no-cache\r\n".
			"Accept: */*\r\n".
			"Authorization: ".$auth_token."\r\n"
		
		  )
		);
		
		$context = stream_context_create($opts);
		$result = file_get_contents($url, false, $context);
		$object = simplexml_load_string($result); 
		$list =  $object->response;
		


        
		$email = $list->email;
		$name = $list->name;
		$id = $list->id;
        $backid = $id;
        $birthday = $list->birthday;

        $resultcode = $list->resultcode;
        $message = $list->message;
        

         $sql = "SELECT * 
            FROM  `user` 
            WHERE  `user_id` =  '$id'
            AND  `user_type` =  'N'";


        $result = mysql_query($sql);
        $num = mysql_num_rows($result);

        if($num == 0 && $id > 0 ){ //회원가입이 안되어 있는 경우 
            $now = date("Y-m-d H:i:s",time());
            $sql = "INSERT INTO  `ouijulawyer_db`.`user` (
                    `uid` ,
                    `user_id` ,
                    `user_type` ,
                    `user_name` ,
                    `join_date` ,
                    `state`
                    )
                    VALUES (
                    NULL ,  '$id',  'N',  '$name',  '$now',  '1'
                    );";

            $result = mysql_query($sql);       

                $sql = "SELECT * 
                        FROM  `user` 
                        WHERE  `user_id` =  '$id'
                        AND  `user_type` =  'N'
                        ";

                $result = mysql_query($sql);
                $row = mysql_fetch_array($result);
                $id = $row['uid'];     

              $sql333 = "INSERT INTO `contract_simple` (
                            `csid` ,
                            `user_id` ,
                            `file_id` ,
                            `mk_date`
                            )
                            VALUES (
                            NULL ,  '$id',  '71', 
                            CURRENT_TIMESTAMP);";
             mysql_query($sql333);               

        

        }   

        $sql = "SELECT * 
                FROM  `user` 
                WHERE  `user_id` =  '$backid'
                AND  `user_type` =  'N'
                ";

        $result = mysql_query($sql);
        $row = mysql_fetch_array($result);
        $id = $row['uid'];        
 
       echo $json = sprintf('{"email":"%s","name":"%s","id":"%s","birthday":"%s"}',$email,$name,$id,$birthday);
   

     // echo  sprintf('{"success":"%s","message":"%s","value":"%s"}',$resultcode,$message,$json);
	
			
			
		
	
	

    ?>