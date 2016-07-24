<?

include '../db_conn.php';
$session = $_REQUEST['session'];


$sql = "SELECT * 
FROM  `my_info`
WHERE `uid` = '$session'";
$result = mysql_query($sql);

//$jsonData = array();
//$temp = array();
$array = mysql_fetch_array($result);


    $my_name = $array['my_name'];
    $my_birth = $array['my_birth'];
    $my_phone = $array['my_phone'];
    $my_bank = $array['my_bank'];
    $my_account = $array['my_account'];

   



echo $json = sprintf('{"my_name":"%s","my_birth":"%s","my_phone":
"%s","my_bank":"%s","my_account":"%s"}',$my_name,$my_birth,$my_phone,$my_bank,$my_account);


?>