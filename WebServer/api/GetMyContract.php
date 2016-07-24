<?

include '../db_conn.php';
$user_id = $_REQUEST['session'];


$sql = "SELECT * 
FROM  `contract_simple` 
WHERE  `user_id` ='$user_id'
ORDER BY `csid` DESC 
";
$result = mysql_query($sql);

$jsonData = array();
$temp = array();
while ($array = mysql_fetch_array($result)) {

    //csid,imsi_id contractimageid, 

    $csid = $array['csid'];
    $imsi_id = $array['file_id'];
    $file = md5($imsi_id);

   
    
    $temp['csid'] = $csid;
    $temp['imsi_id'] = $imsi_id;
    $temp['file'] = $file;

    
    $jsonData[] = $temp;
}
echo json_encode($jsonData);





 




?>