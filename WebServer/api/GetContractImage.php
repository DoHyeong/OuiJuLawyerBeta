<?

include '../db_conn.php';
$csid = $_REQUEST['csid'];


$sql = "SELECT * 
FROM  `contract_simple` 
WHERE  `csid` ='$csid'";
$result = mysql_query($sql);

//$jsonData = array();
//$temp = array();
    $array = mysql_fetch_array($result);

    $imsi_id = $array['file_id'];
    $file = md5($imsi_id);
    echo $json = sprintf('{"imsi_id":"%s","file":"%s"}',$imsi_id,$file);


?>