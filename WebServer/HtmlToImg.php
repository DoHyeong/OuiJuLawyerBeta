<?
$apikey = "7ad9bb88d18cc1b3";
$api_url = "http://api.page2images.com/restfullink";

function convert($_url,$imsi_id)
{
    global $apikey, $api_url;
    // URL can be those formats: http://www.google.com https://google.com google.com and www.google.com
    // But free rate plan does not support SSL link.
    $url = $_url;
    $device = 4; // 0 - iPhone4, 1 - iPhone5, 2 - Android, 3 - WinPhone, 4 - iPad, 5 - Android Pad, 6 - Desktop
    $loop_flag = TRUE;
    $timeout = 120; // timeout after 120 seconds
    set_time_limit($timeout+10);
    $start_time = time();
    $timeout_flag = false;

    while ($loop_flag) {
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
                    //echo "<img src='$json_data->image_url'>";
                    // Or you can download the image from our server

                    $img = '../contract/'+md5($imsi_id).".png";
                    file_put_contents($img, file_get_contents($json_data->image_url));





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




?>