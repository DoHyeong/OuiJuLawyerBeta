<?
   error_reporting(0);
   include '../db_conn.php';
    
    $imsi_id = $_REQUEST['imsi_id']; 

	if($_FILES['mysign']['tmp_name'] != NULL){

       
        $uploaddir = '../sign/';
		if (!is_dir($uploaddir)) {
			
		    mkdir($uploaddir,0777,true);
		}
        $uploadfile = $uploaddir.md5($imsi_id."my").".png";
		move_uploaded_file($_FILES['mysign']['tmp_name'], $uploadfile);

    }


    if($_FILES['yoursign']['tmp_name'] != NULL){

       
        $uploaddir = '../sign/';
		if (!is_dir($uploaddir)) {

		    mkdir($uploaddir,0777,true);
		}
        $uploadfile = $uploaddir.md5($imsi_id."your").".png";
		move_uploaded_file($_FILES['yoursign']['tmp_name'], $uploadfile);

    }




    echo  sprintf('{"success":"%s","message":"%s"}',"1","success");  

    $apikey = "7ad9bb88d18cc1b3";
$api_url = "http://api.page2images.com/restfullink";


//It is the simplest way to call it. Of cause, you can remove it as needed.
call_p2i($imsi_id);

function call_p2i($_imsi_id)
{
    global $apikey, $api_url;
    // URL can be those formats: http://www.google.com https://google.com google.com and www.google.com
    // But free rate plan does not support SSL link.
    $url = "http://ouijulawyer.azurewebsites.net/contract.php?imsi_id=".$_imsi_id;
    $device = 4; // 0 - iPhone4, 1 - iPhone5, 2 - Android, 3 - WinPhone, 4 - iPad, 5 - Android Pad, 6 - Desktop
    $loop_flag = TRUE;
    $timeout = 120; // timeout after 120 seconds
    set_time_limit($timeout+10);
    $start_time = time();
    $timeout_flag = false;

    while ($loop_flag) {
        // We need call the API until we get the screenshot or error message
        try {
            $para = array(
                "p2i_url" => $url,
                "p2i_key" => $apikey,
                "p2i_device" => $device
            );
            // connect page2images server
            $response = connect($api_url, $para);

            if (empty($response)) {
                $loop_flag = FALSE;
                // something error
                break;
            } else {
                $json_data = json_decode($response);
                if (empty($json_data->status)) {
                    $loop_flag = FALSE;
                    // api error
                    break;
                }
            }
            switch ($json_data->status) {
                case "error":
                    // do something to handle error
                    $loop_flag = FALSE;
                    break;
                case "finished":
				

               // do something with finished. For example, show this image
              // echo $img = 'contract/'.md5($imsi_id).".png";
				   file_put_contents($img, file_get_contents($json_data->image_url));

                   copy($json_data->image_url, '../contract/'.md5($_imsi_id).".png");


                   $sql = "SELECT `user_id` 
                            FROM  `imsi_contract` 
                            WHERE  `cid` ='$_imsi_id'";
                   $result = mysql_query($sql);
                   $row = mysql_fetch_array($result);
                   $user_id = $row[0];         

                   $sql = "INSERT INTO `contract_simple` (
                            `csid` ,
                            `user_id` ,
                            `file_id` ,
                            `mk_date`
                            )
                            VALUES (
                            NULL ,  '$user_id',  '$_imsi_id', 
                            CURRENT_TIMESTAMP);";

                  $result = mysql_query($sql);          




                    // Or you can download the image from our server
                    $loop_flag = FALSE;
                    break;
                case "processing":
                default:
                    if ((time() - $start_time) > $timeout) {
                        $loop_flag = false;
                        $timeout_flag = true; // set the timeout flag. You can handle it later.
                    } else {
                        sleep(3); // This only work on windows.
                    }
                    break;
            }
        } catch (Exception $e) {
            // Do whatever you think is right to handle the exception.
            $loop_flag = FALSE;
            echo 'Caught exception: ', $e->getMessage(), "\n";
        }
    }

    if ($timeout_flag) {
        // handle the timeout event here
        echo "Error: Timeout after $timeout seconds.";
    }
}
// curl to connect server
function connect($url, $para)
{
    if (empty($para)) {
        return false;
    }
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($para));
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
    curl_setopt($ch, CURLOPT_TIMEOUT, 30);
    $data = curl_exec($ch);
    curl_close($ch);
    return $data;
}

function call_p2i_with_callback()
{
    global $apikey, $api_url;
    // URL can be those formats: http://www.google.com https://google.com google.com and www.google.com
    $url = "http://www.google.com";
    // 0 - iPhone4, 1 - iPhone5, 2 - Android, 3 - WinPhone, 4 - iPad, 5 - Android Pad, 6 - Desktop
    $device = 0;

    // you can pass us any parameters you like. We will pass it back.
    // Please make sure http://your_server_domain/api_callback can handle our call
    $callback_url = "http://your_server_domain/api_callback?image_id=your_unique_image_id_here";
    $para = array(
                "p2i_url" => $url,
                "p2i_key" => $apikey,
                "p2i_device" => $device
            );
    $response = connect($api_url, $para);

    if (empty($response)) {
        // Do whatever you think is right to handle the exception.
    } else {
        $json_data = json_decode($response);
        if (empty($json_data->status)) {
            // api error do something
            echo "api error";
        }else
        {
            //do anything
            echo $json_data->status;
        }
    }

}

// This function demo how to handle the callback request
function api_callback()
{
    if (! empty($_REQUEST["image_id"])) {
        // do anything you want about the unique image id. We suggest to use it to identify which url you send to us since you can send 1,000 at one time.
    }

    if (! empty($_POST["result"])) {
        $post_data = $_POST["result"];
        $json_data = json_decode($post_data);
        switch ($json_data->status) {
            case "error":
                // do something with error
                echo $json_data->errno . " " . $json_data->msg;
                break;
            case "finished":
                // do something with finished
                echo $json_data->image_url;
                // Or you can download the image from our server
                break;
            default:
                break;
        }
    } else {
        // Do whatever you think is right to handle the exception.
        echo "Error: Empty";
    }
}


    ?>