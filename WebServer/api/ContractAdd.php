<?

        error_reporting(0);
        include '../db_conn.php'; 

         
        $session = $_REQUEST['session'];
        $balju_name = $_REQUEST['balju_name'];
        $balju_birth = $_REQUEST['balju_birth'];
        $balju_phone = $_REQUEST['balju_phone'];
        $balju_sangho = $_REQUEST['balju_sangho'];

        $project_name = $_REQUEST['project_name'];
        $project_des = $_REQUEST['project_des'];

        $contract_date = $_REQUEST['contract_date'];
        $contract_to = $_REQUEST['contract_to'];
        $contract_amount = $_REQUEST['contract_amount'];
        $contract_chacksu = $_REQUEST['contract_chacksu'];

        $bosu_date = $_REQUEST['bosu_date'];
        $bosu_des = $_REQUEST['bosu_des'];

        $byebye_des = $_REQUEST['byebye_des'];
        $contract_plus = $_REQUEST['contract_plus'];
       


    $sql = "INSERT INTO  `imsi_contract` (
                `cid` ,
                `user_id` ,
                `balju_name` ,
                `balju_birth` ,
                `balju_phone` ,
                `balju_sangho` ,
                `project_name` ,
                `project_des` ,
                `contract_date` ,
                `contract_to` ,
                `contract_amount` ,
                `contract_chaksu` ,
                `bosu_to` ,
                `bosu_des` ,
                `byebye_des` ,
                `contract_plus`
                )
                VALUES (
                NULL ,  '$session',  '$balju_name',  '$balju_birth',  '$balju_phone',  '$balju_sangho',
                '$project_name',  '$project_des',  '$contract_date',  '$contract_to',  '$contract_amount',
                '$contract_chacksu',  '$bosu_date',  '$bosu_des',  '$byebye_des',  '$contract_plus'
                );";

        $result = mysql_query($sql);    
      
        $last_uid = mysql_insert_id();
        
        if(!$result){
           
            printf('{"success":"%s","message":"%s"}',"0",$last);

        }else{
            printf('{"success":"%s","message":"%s"}',"1",$last_uid);

        }
        


?>
