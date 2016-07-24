<?
        session_start();
        include '../db_conn.php';

        $id = $_POST['inputId'];
        $pw = $_POST['inputPw'];

        $sql = "SELECT * 
                FROM  `cms_admin` 
                WHERE  `adminId` =  '$id'
                AND  `adminPw` =  '$pw'
                AND  `level` != -1";
        $result = mysql_query($sql);     
        $num = mysql_num_rows($result);   
        $row = mysql_fetch_array($result);
        $aid = $row['aid'];
        $level = $row['level'];
     
        if($num == 1){
                $_SESSION['aid'] = $aid;
                $_SESSION['level'] = $level;
                echo "<script>location.href = 'main.php';</script>";
        }else{
                echo "<script>alert('error!');location.href = 'index.php';</script>";
        }







?>