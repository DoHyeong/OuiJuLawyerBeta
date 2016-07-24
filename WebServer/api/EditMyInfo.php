<?
			
        include '../db_conn.php'; 
        $session = $_REQUEST['session'];
        $name = $_REQUEST['name'];
        $phone = $_REQUEST['phone'];
        $birth = $_REQUEST['birth'];
        $bank = $_REQUEST['bank'];
        $account = $_REQUEST['account'];

        $now = date("Y-m-d H:i:s",time());

        $sql = "SELECT * 
                FROM  `my_info` 
                WHERE  `uid` ='$session'";
        $result = mysql_query($sql);
        $num = mysql_num_rows($result);


        if($num == 0){
                $sql = "INSERT INTO `my_info` (
                        `mid` ,
                        `uid` ,
                        `my_name` ,
                        `my_birth` ,
                        `my_phone` ,
                        `my_bank` ,
                        `my_account` ,
                        `edit_date`
                        )
                        VALUES (
                        NULL ,  '$session',  '$name',  '$birth',  '$phone',  '$bank',  '$account',  '$now'
                        );";

                $result = mysql_query($sql);

                        if($result){
                                echo  sprintf('{"success":"%s","message":"%s"}',"1","success");               
                        }else{
                                echo  sprintf('{"success":"%s","message":"%s"}',"0","fail1");     
                        } 

        }else{
                $sql = "UPDATE  `my_info` SET `my_name` = '$name',
                        `my_birth` =  '$birth',
                        `my_phone` =  '$phone',
                        `my_bank` =  '$bank',
                        `my_account` =  '$account',
                        `edit_date` =  '$now' WHERE  `my_info`.`uid` ='$session';";

                $result = mysql_query($sql);

                        if($result){
                                echo  sprintf('{"success":"%s","message":"%s"}',"1","success");               
                        }else{
                                echo  sprintf('{"success":"%s","message":"%s"}',"0","fail2");     
                        }          

        }        

?>