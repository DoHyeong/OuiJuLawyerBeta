<?

    include '../db_conn.php';

    $user_id = $_REQUEST['user_id'];

    $sql = "SELECT `uid` FROM  `user` 
            WHERE  `user_id` =  '$user_id'
            AND  `user_type` =  'N'";     

    $result = mysql_query($sql);
    $num = mysql_num_rows($result);
    $row = mysql_fetch_array($result);
    
    $uid = $row[0];

    $success = "1";
    $message = "login success";

    if($num == 0 || $uid == null){
    $success = "0";
    $message = "login fail";

    }

   // $uid = md5($uid);
    
    echo $json = sprintf('{"success":"%s","message":"%s","session":"%s"}',$success,$message,$uid);
        














?>