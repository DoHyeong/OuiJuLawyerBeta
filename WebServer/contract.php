<?

     include 'db_conn.php'; 

     $cid = $_REQUEST['imsi_id'];
     $sql ="SELECT * 
            FROM  `imsi_contract` 
            WHERE  `cid` ='$cid'";
     $result = mysql_query($sql);
     $row= mysql_fetch_array($result);



     $user_id = $row['user_id'];

     $sql2 = "SELECT * 
                  FROM  `my_info` 
                  WHERE  `uid` ='$user_id'";
     $result2 = mysql_query($sql2);             
     $row2 = mysql_fetch_array($result2);             

?>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ko" lang="ko">
   <head>
      <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
      <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7">
      <style>
         body{
         word-wrap:break-word;
         background:#fff;
         }
      </style>
   <body onContextMenu="return false;" onClick="return false;">
      <style type="text/css">
         .doc_prop{application:SynapWord;version:1.0;maker:df;last-editor:df;browser:chrome;os:win;width:597.75pt;margin-left:54.34pt;margin-right:54.34pt;margin-top:72.27pt;margin-bottom:72.27pt;page-orientation:portrait;page-size:a4;footnote-display:on;ruler-display:off;view-mode:PAGE;header-height:68pt;header-margin-left:0pt;header-margin-right:0pt;header-margin-top:0pt;header-margin-bottom:12pt;footer-height:68pt;footer-margin-left:0pt;footer-margin-right:0pt;footer-margin-top:0pt;footer-margin-bottom:12pt;footnote-margin-top:10pt;height:845.25pt;}
         .__style_normal{font-family:나눔고딕;font-size:10pt;color:black;background-color:transparent;text-decoration:none;font-style:normal;font-weight:normal;margin-left:0em;margin-right:0em;margin-top:0em;margin-bottom:0em;padding-top:0em;padding-bottom:0em;line-height:1.5;text-align:justify;text-indent:0em;list-style-type:none;usrName:본문;}
         p{margin-left:0em;margin-right:0em;margin-top:0em;margin-bottom:0em;padding-top:0em;padding-bottom:0em;line-height:1.5;text-align:justify;text-indent:0em;font-size:10pt;font-family:나눔고딕;color:black;background-color:transparent;font-style:normal;font-weight:normal;}
         ul{margin-top:0em;margin-bottom:0em;text-indent:0em;background-color:transparent;}
         ol{margin-top:0em;margin-bottom:0em;text-indent:0em;background-color:transparent;}
         li{margin-left:0em;margin-right:0em;margin-top:0em;margin-bottom:0em;padding-top:0em;padding-bottom:0em;line-height:1.5;text-align:justify;text-indent:0em;font-size:10pt;font-family:나눔고딕;color:black;background-color:transparent;font-style:normal;font-weight:normal;}
         span{font-family:나눔고딕;font-size:10pt;color:black;background-color:transparent;text-decoration:none;font-style:normal;font-weight:normal;}
         .__style_h1{font-family:나눔고딕;font-size:24pt;color:black;background-color:transparent;text-decoration:none;font-style:normal;font-weight:bold;margin-left:0em;margin-right:0em;margin-top:0em;margin-bottom:0em;padding-top:0em;padding-bottom:0em;line-height:1.5;text-align:justify;text-indent:0em;list-style-type:none;usrName:제목1;}
         p.style_h1{margin-left:0em;margin-right:0em;margin-top:0em;margin-bottom:0em;padding-top:0em;padding-bottom:0em;line-height:1.5;text-align:justify;text-indent:0em;font-size:24pt;font-family:나눔고딕;color:black;background-color:transparent;font-style:normal;font-weight:bold;}
         ul.style_h1{margin-top:0em;margin-bottom:0em;text-indent:0em;list-style-type:none;background-color:transparent;}
         ol.style_h1{margin-top:0em;margin-bottom:0em;text-indent:0em;list-style-type:none;background-color:transparent;}
         li.style_h1{margin-left:0em;margin-right:0em;margin-top:0em;margin-bottom:0em;padding-top:0em;padding-bottom:0em;line-height:1.5;text-align:justify;text-indent:0em;font-size:24pt;font-family:나눔고딕;color:black;background-color:transparent;font-style:normal;font-weight:bold;}
         span.style_h1{font-family:나눔고딕;font-size:24pt;color:black;background-color:transparent;text-decoration:none;font-style:normal;font-weight:bold;}
         .__style_h2{font-family:나눔고딕;font-size:18pt;color:black;background-color:transparent;text-decoration:none;font-style:normal;font-weight:normal;margin-left:0em;margin-right:0em;margin-top:0em;margin-bottom:0em;padding-top:0em;padding-bottom:0em;line-height:1.5;text-align:justify;text-indent:0em;list-style-type:none;usrName:제목2;}
         p.style_h2{margin-left:0em;margin-right:0em;margin-top:0em;margin-bottom:0em;padding-top:0em;padding-bottom:0em;line-height:1.5;text-align:justify;text-indent:0em;font-size:18pt;font-family:나눔고딕;color:black;background-color:transparent;font-style:normal;font-weight:normal;}
         ul.style_h2{margin-top:0em;margin-bottom:0em;text-indent:0em;list-style-type:none;background-color:transparent;}
         ol.style_h2{margin-top:0em;margin-bottom:0em;text-indent:0em;list-style-type:none;background-color:transparent;}
         li.style_h2{margin-left:0em;margin-right:0em;margin-top:0em;margin-bottom:0em;padding-top:0em;padding-bottom:0em;line-height:1.5;text-align:justify;text-indent:0em;font-size:18pt;font-family:나눔고딕;color:black;background-color:transparent;font-style:normal;font-weight:normal;}
         span.style_h2{font-family:나눔고딕;font-size:18pt;color:black;background-color:transparent;text-decoration:none;font-style:normal;font-weight:normal;}
         .__style_subhead{font-family:나눔고딕;font-size:14pt;color:black;background-color:transparent;text-decoration:none;font-style:normal;font-weight:normal;margin-left:0em;margin-right:0em;margin-top:0em;margin-bottom:0em;padding-top:0em;padding-bottom:0em;line-height:1.5;text-align:justify;text-indent:0em;list-style-type:none;usrName:부제;}
         p.style_subhead{margin-left:0em;margin-right:0em;margin-top:0em;margin-bottom:0em;padding-top:0em;padding-bottom:0em;line-height:1.5;text-align:justify;text-indent:0em;font-size:14pt;font-family:나눔고딕;color:black;background-color:transparent;font-style:normal;font-weight:normal;}
         ul.style_subhead{margin-top:0em;margin-bottom:0em;text-indent:0em;list-style-type:none;background-color:transparent;}
         ol.style_subhead{margin-top:0em;margin-bottom:0em;text-indent:0em;list-style-type:none;background-color:transparent;}
         li.style_subhead{margin-left:0em;margin-right:0em;margin-top:0em;margin-bottom:0em;padding-top:0em;padding-bottom:0em;line-height:1.5;text-align:justify;text-indent:0em;font-size:14pt;font-family:나눔고딕;color:black;background-color:transparent;font-style:normal;font-weight:normal;}
         span.style_subhead{font-family:나눔고딕;font-size:14pt;color:black;background-color:transparent;text-decoration:none;font-style:normal;font-weight:normal;}
         .__style_accent{font-family:나눔고딕;font-size:10pt;color:#33CCFF;background-color:transparent;text-decoration:none;font-style:italic;font-weight:normal;margin-left:0em;margin-right:0em;margin-top:0em;margin-bottom:0em;padding-top:0em;padding-bottom:0em;line-height:1.5;text-align:justify;text-indent:0em;list-style-type:none;usrName:강조;}
         p.style_accent{margin-left:0em;margin-right:0em;margin-top:0em;margin-bottom:0em;padding-top:0em;padding-bottom:0em;line-height:1.5;text-align:justify;text-indent:0em;font-size:10pt;font-family:나눔고딕;color:#33CCFF;background-color:transparent;font-style:italic;font-weight:normal;}
         ul.style_accent{margin-top:0em;margin-bottom:0em;text-indent:0em;list-style-type:none;background-color:transparent;}
         ol.style_accent{margin-top:0em;margin-bottom:0em;text-indent:0em;list-style-type:none;background-color:transparent;}
         li.style_accent{margin-left:0em;margin-right:0em;margin-top:0em;margin-bottom:0em;padding-top:0em;padding-bottom:0em;line-height:1.5;text-align:justify;text-indent:0em;font-size:10pt;font-family:나눔고딕;color:#33CCFF;background-color:transparent;font-style:italic;font-weight:normal;}
         span.style_accent{font-family:나눔고딕;font-size:10pt;color:#33CCFF;background-color:transparent;text-decoration:none;font-style:italic;font-weight:normal;}
         .__style_quote{font-family:나눔고딕;font-size:10pt;color:black;background-color:transparent;text-decoration:none;font-style:italic;font-weight:normal;margin-left:0em;margin-right:0em;margin-top:0em;margin-bottom:0em;padding-top:0em;padding-bottom:0em;line-height:1.5;text-align:justify;text-indent:0em;list-style-type:none;usrName:인용;}
         p.style_quote{margin-left:0em;margin-right:0em;margin-top:0em;margin-bottom:0em;padding-top:0em;padding-bottom:0em;line-height:1.5;text-align:justify;text-indent:0em;font-size:10pt;font-family:나눔고딕;color:black;background-color:transparent;font-style:italic;font-weight:normal;}
         ul.style_quote{margin-top:0em;margin-bottom:0em;text-indent:0em;list-style-type:none;background-color:transparent;}
         ol.style_quote{margin-top:0em;margin-bottom:0em;text-indent:0em;list-style-type:none;background-color:transparent;}
         li.style_quote{margin-left:0em;margin-right:0em;margin-top:0em;margin-bottom:0em;padding-top:0em;padding-bottom:0em;line-height:1.5;text-align:justify;text-indent:0em;font-size:10pt;font-family:나눔고딕;color:black;background-color:transparent;font-style:italic;font-weight:normal;}
         span.style_quote{font-family:나눔고딕;font-size:10pt;color:black;background-color:transparent;text-decoration:none;font-style:italic;font-weight:normal;}
         .__style_reference{font-family:나눔고딕;font-size:10pt;color:red;background-color:transparent;text-decoration:underline;font-style:normal;font-weight:normal;margin-left:0em;margin-right:0em;margin-top:0em;margin-bottom:0em;padding-top:0em;padding-bottom:0em;line-height:1.5;text-align:justify;text-indent:0em;list-style-type:none;usrName:참조;}
         p.style_reference{margin-left:0em;margin-right:0em;margin-top:0em;margin-bottom:0em;padding-top:0em;padding-bottom:0em;line-height:1.5;text-align:justify;text-indent:0em;font-size:10pt;font-family:나눔고딕;color:red;background-color:transparent;font-style:normal;font-weight:normal;}
         ul.style_reference{margin-top:0em;margin-bottom:0em;text-indent:0em;list-style-type:none;background-color:transparent;}
         ol.style_reference{margin-top:0em;margin-bottom:0em;text-indent:0em;list-style-type:none;background-color:transparent;}
         li.style_reference{margin-left:0em;margin-right:0em;margin-top:0em;margin-bottom:0em;padding-top:0em;padding-bottom:0em;line-height:1.5;text-align:justify;text-indent:0em;font-size:10pt;font-family:나눔고딕;color:red;background-color:transparent;font-style:normal;font-weight:normal;}
         span.style_reference{font-family:나눔고딕;font-size:10pt;color:red;background-color:transparent;text-decoration:underline;font-style:normal;font-weight:normal;}
         body{font-family:나눔고딕;word-wrap:break-word;}
         .se2_check_spell{cursor:pointer;}
         .img_none_align{clear:none;}
         .img_center_align{clear:none;float:none;display:block;margin: 0px auto;}
         .img_left_align{clear:both;float:left;margin-right:10pt;}
         .img_right_align{clear:both;float:right;margin-left:10pt;}
         #synap_footnote_list P{font-size:10pt;}
         #synap_footnote_list SPAN{font-size:10pt;}
         p.horizontalLine{width:auto;height:2px;background-color:black;margin-top:5px;margin-bottom: 3px;font-size:0px;}
         sup.footnote a:link{color:#000000  !important;text-decoration:none  !important;}
         sup.footnote a:visited{color:#000000  !important;text-decoration:none  !important;}
         sup.footnote a span{color:#000000  !important;text-decoration:none  !important;}
         sup.endnote a:link{color:#000000 !important;text-decoration:none !important;}
         sup.endnote a:visited{color:#000000 !important;text-decoration:none !important;}
         sup.endnote a span{color:#000000 !important;text-decoration:none !important;}
         a:link{color:#0070C0;text-decoration:none;}
         a:visited{color:#0070C0;text-decoration:none;}
         a:link span{color:#0070C0;text-decoration:underline;}
         a:visited span{color:#0070C0;text-decoration:underline;}
         p.pagebreaker{width:auto;height:11px;font-size:0px;background:url(http://static.naver.com/word/images/word/pagebreaker_bg.png) 3px 7px repeat-x;text-align:center;margin-bottom:1px;padding-top:2px;}
         p.pagebreaker img.pagebreaker{width:96px;height:10px;}
         img{border:0pt;}
         .spellCheck a{color:#0070C0;text-decoration:underline;}
         .spellCheck a span{color:#0070C0;text-decoration:underline;}
         li{position:relative;}
         div.synap_word_header{clear:both;}
         div.synap_word_footer{clear:both;}
      </style>
      </head>
      <body>
         <table border="0" cellpadding="1" cellspacing="0" style="width:100%;height:100%;border-collapse: collapse; margin-left:0pt;" class="__se_tbl" adjusted="true">
            <tbody>
               <tr>
                  <td style="padding: 2.25pt 3pt 1.5pt 4.5pt; border: 0.75pt solid rgb(0, 0, 0); width: 246pt; height: 41.25pt; background-color: inherit;" class="" colspan="2" rowspan="1">
                     <p><span org_fontsize="10pt" style="font-family: 나눔고딕; font-size: 10pt; color: rgb(0, 0, 0); font-weight: normal; text-decoration: none; font-style: normal; vertical-align: baseline; border: 0pt; background-color: rgba(0, 0, 0, 0);">﻿</span><span org_fontsize="28pt" style="font-family: 나눔고딕; font-size: 28pt; color: rgb(0, 0, 0); font-weight: normal; text-decoration: none; font-style: normal; vertical-align: baseline; border: 0pt; background-color: rgba(0, 0, 0, 0);">기술용역표준계약서</span></p>
                  </td>
                  <td style="padding: 2.25pt 3pt 1.5pt 4.5pt; border: 0.75pt solid rgb(0, 0, 0); width: 233.25pt; height: 41.25pt; background-color: inherit;" class="">
                     <p><span org_fontsize="10pt" style="font-family: 나눔고딕; font-size: 10pt; color: rgb(0, 0, 0); font-weight: normal; text-decoration: none; font-style: normal; vertical-align: baseline; border: 0pt; background-color: rgba(0, 0, 0, 0);">﻿서비스 내부 계약코드 : <? echo $row['cid']; ?></span></p>
                     <p><span org_fontsize="10pt" style="font-family: 나눔고딕; font-size: 10pt; color: rgb(0, 0, 0); font-weight: normal; text-decoration: none; font-style: normal; vertical-align: baseline; border: 0pt; background-color: rgba(0, 0, 0, 0);">생성일자 :<? echo date("Y-m-d H:i:s",time());?></span></p>
                  </td>
               </tr>
               <tr>
                  <td style="padding: 2.25pt 3pt 1.5pt 4.5pt; border: 0.75pt solid rgb(0, 0, 0); width: 71.25pt; height: 146.25pt; background-color: inherit;" class="" colspan="1" rowspan="2">
                     <p><span org_fontsize="10pt" style="font-family: 나눔고딕; font-size: 10pt; color: rgb(0, 0, 0); font-weight: normal; text-decoration: none; font-style: normal; vertical-align: baseline; border: 0pt; background-color: rgba(0, 0, 0, 0);">﻿</span><span org_fontsize="18pt" style="font-family: 나눔고딕; font-size: 18pt; color: rgb(0, 0, 0); font-weight: normal; text-decoration: none; font-style: normal; vertical-align: baseline; border: 0pt; background-color: rgba(0, 0, 0, 0);">계약자</span></p>
                  </td>
                  <td style="padding: 2.25pt 3pt 1.5pt 4.5pt; border: 0.75pt solid rgb(0, 0, 0); width: 158.25pt; height: 81pt; background-color: inherit;" class="">
                     <p  style="text-align: center;;" ><span style="font-size: 18pt;">계약대상자의 </span><span style="font-size: 18pt;">정보</span></p>
                  </td>
                  <td style="padding: 2.25pt 3pt 1.5pt 4.5pt; border: 0.75pt solid rgb(0, 0, 0); width: 233.25pt; height: 81pt; background-color: inherit;" class="">
                     <p><span org_fontsize="10pt" style="font-family: 나눔고딕; font-size: 10pt; color: rgb(0, 0, 0); font-weight: normal; text-decoration: none; font-style: normal; vertical-align: baseline; border: 0pt; background-color: rgba(0, 0, 0, 0);">﻿</span><span org_fontsize="14pt" style="font-family: 나눔고딕; font-size: 14pt; color: rgb(0, 0, 0); font-weight: normal; text-decoration: none; font-style: normal; vertical-align: baseline; border: 0pt; background-color: rgba(0, 0, 0, 0);">이름: &nbsp; </span><span org_fontsize="12pt" style="font-family: 나눔고딕; font-size: 12pt; color: rgb(0, 0, 0); font-weight: normal; text-decoration: none; font-style: normal; vertical-align: baseline; border: 0pt; background-color: rgba(0, 0, 0, 0);"><? echo $row2['my_name']; ?></span></p>
                     <p><span org_fontsize="14pt" style="font-family: 나눔고딕; font-size: 14pt; color: rgb(0, 0, 0); font-weight: normal; text-decoration: none; font-style: normal; vertical-align: baseline; border: 0pt; background-color: rgba(0, 0, 0, 0);">생년월일: </span><span org_fontsize="12pt" style="font-family: 나눔고딕; font-size: 12pt; color: rgb(0, 0, 0); font-weight: normal; text-decoration: none; font-style: normal; vertical-align: baseline; border: 0pt; background-color: rgba(0, 0, 0, 0);"><? echo $row2['my_birth']; ?></span></p>
                     <p><span org_fontsize="14pt" style="font-family: 나눔고딕; font-size: 14pt; color: rgb(0, 0, 0); font-weight: normal; text-decoration: none; font-style: normal; vertical-align: baseline; border: 0pt; background-color: rgba(0, 0, 0, 0);">휴대전화: </span><span org_fontsize="12pt" style="font-family: 나눔고딕; font-size: 12pt; color: rgb(0, 0, 0); font-weight: normal; text-decoration: none; font-style: normal; vertical-align: baseline; border: 0pt; background-color: rgba(0, 0, 0, 0);"><? echo $row2['my_phone']; ?></span></p>
                     <p><span org_fontsize="14pt" style="font-family: 나눔고딕; font-size: 14pt; color: rgb(0, 0, 0); font-weight: normal; text-decoration: none; font-style: normal; vertical-align: baseline; border: 0pt; background-color: rgba(0, 0, 0, 0);">계좌정보: </span><span org_fontsize="12pt" style="font-family: 나눔고딕; font-size: 12pt; color: rgb(0, 0, 0); font-weight: normal; text-decoration: none; font-style: normal; vertical-align: baseline; border: 0pt; background-color: rgba(0, 0, 0, 0);"><? echo $row2['my_bank']." ".$row2['my_account']; ?></span></p>
                  </td>
               </tr>
               <tr>
                  <td style="padding: 2.25pt 3pt 1.5pt 4.5pt; border: 0.75pt solid rgb(0, 0, 0); width: 158.25pt; height: 60.75pt; background-color: inherit;" class="">
                     <p  style="text-align: center;;" ><span org_fontsize="18pt" style="font-family: 나눔고딕; font-size: 18pt; color: rgb(0, 0, 0); font-weight: normal; text-decoration: none; font-style: normal; vertical-align: baseline; border: 0pt; background-color: rgba(0, 0, 0, 0);">﻿발주자의 정보</span></p>
                  </td>
                  <td style="padding: 2.25pt 3pt 1.5pt 4.5pt; border: 0.75pt solid rgb(0, 0, 0); width: 233.25pt; height: 60.75pt; background-color: inherit;" class="">
                     <p><span org_fontsize="12pt" style="font-family: 나눔고딕; font-size: 12pt; color: rgb(0, 0, 0); font-weight: normal; text-decoration: none; font-style: normal; vertical-align: baseline; border: 0pt; background-color: rgba(0, 0, 0, 0);">﻿</span><span org_fontsize="14pt" style="font-family: 나눔고딕; font-size: 14pt; color: rgb(0, 0, 0); font-weight: normal; text-decoration: none; font-style: normal; vertical-align: baseline; border: 0pt; background-color: rgba(0, 0, 0, 0);">이름(상호명): &nbsp;</span><span org_fontsize="12pt" style="font-family: 나눔고딕; font-size: 12pt; color: rgb(0, 0, 0); font-weight: normal; text-decoration: none; font-style: normal; vertical-align: baseline; border: 0pt; background-color: rgba(0, 0, 0, 0);"><? echo $row['balju_name']."(".$row['balju_sangho'].")"; ?></span></p>
                     <p><span org_fontsize="14pt" style="font-family: 나눔고딕; font-size: 14pt; color: rgb(0, 0, 0); font-weight: normal; text-decoration: none; font-style: normal; vertical-align: baseline; border: 0pt; background-color: rgba(0, 0, 0, 0);">생년월일: </span><span org_fontsize="12pt" style="font-family: 나눔고딕; font-size: 12pt; color: rgb(0, 0, 0); font-weight: normal; text-decoration: none; font-style: normal; vertical-align: baseline; border: 0pt; background-color: rgba(0, 0, 0, 0);"><? echo $row['balju_birth']; ?></span></p>
                     <p><span style="font-size: 14pt;">휴대전화</span><span style="font-size: 11pt;">: </span><span style="font-size: 12pt;"><? echo $row['balju_phone'];?></span></p>
                  </td>
               </tr>
               <tr>
                  <td style="padding: 2.25pt 3pt 1.5pt 4.5pt; border: 0.75pt solid rgb(0, 0, 0); width: 71.25pt; height: 161.25pt; background-color: inherit;" class="" colspan="1" rowspan="5">
                     <p><span org_fontsize="10pt" style="font-family: 나눔고딕; font-size: 10pt; color: rgb(0, 0, 0); font-weight: normal; text-decoration: none; font-style: normal; vertical-align: baseline; border: 0pt; background-color: rgba(0, 0, 0, 0);">﻿</span><span org_fontsize="18pt" style="font-family: 나눔고딕; font-size: 18pt; color: rgb(0, 0, 0); font-weight: normal; text-decoration: none; font-style: normal; vertical-align: baseline; border: 0pt; background-color: rgba(0, 0, 0, 0);">계약내용</span></p>
                  </td>
                  <td style="padding: 2.25pt 3pt 1.5pt 4.5pt; border: 0.75pt solid rgb(0, 0, 0); width: 158.25pt; height: 27pt; background-color: inherit;">
                     <p><span org_fontsize="10pt" style="font-family: 나눔고딕; font-size: 10pt; color: rgb(0, 0, 0); font-weight: normal; text-decoration: none; font-style: normal; vertical-align: baseline; border: 0pt; background-color: rgba(0, 0, 0, 0);">﻿</span><span org_fontsize="18pt" style="font-family: 나눔고딕; font-size: 18pt; color: rgb(0, 0, 0); font-weight: normal; text-decoration: none; font-style: normal; vertical-align: baseline; border: 0pt; background-color: rgba(0, 0, 0, 0);">프로젝트명</span></p>
                  </td>
                  <td style="padding: 2.25pt 3pt 1.5pt 4.5pt; border: 0.75pt solid rgb(0, 0, 0); width: 233.25pt; height: 27pt; background-color: inherit;" class="">
                     <p><span org_fontsize="12pt" style="font-family: 나눔고딕; font-size: 12pt; color: rgb(0, 0, 0); font-weight: normal; text-decoration: none; font-style: normal; vertical-align: baseline; border: 0pt; background-color: rgba(0, 0, 0, 0);"><? echo $row['project_name'];?></span></p>
                  </td>
               </tr>
               <tr>
                  <td style="padding: 2.25pt 3pt 1.5pt 4.5pt; border: 0.75pt solid rgb(0, 0, 0); width: 158.25pt; height: 27pt; background-color: inherit;">
                     <p><span org_fontsize="10pt" style="font-family: 나눔고딕; font-size: 10pt; color: rgb(0, 0, 0); font-weight: normal; text-decoration: none; font-style: normal; vertical-align: baseline; border: 0pt; background-color: rgba(0, 0, 0, 0);"></span><span org_fontsize="18pt" style="font-family: 나눔고딕; font-size: 18pt; color: rgb(0, 0, 0); font-weight: normal; text-decoration: none; font-style: normal; vertical-align: baseline; border: 0pt; background-color: rgba(0, 0, 0, 0);">설명</span><span org_fontsize="10pt" style="font-family: 나눔고딕; font-size: 10pt; color: rgb(0, 0, 0); font-weight: normal; text-decoration: none; font-style: normal; vertical-align: baseline; border: 0pt; background-color: rgba(0, 0, 0, 0);">:</span></p>
                  </td>
                  <td style="padding: 2.25pt 3pt 1.5pt 4.5pt; border: 0.75pt solid rgb(0, 0, 0); width: 233.25pt; height: 27pt; background-color: inherit;" class="">
                     <p><span org_fontsize="12pt" style="font-family: 나눔고딕; font-size: 12pt; color: rgb(0, 0, 0); font-weight: normal; text-decoration: none; font-style: normal; vertical-align: baseline; border: 0pt; background-color: rgba(0, 0, 0, 0);"></span><span org_fontsize="11pt" style="font-family: 나눔고딕; font-size: 11pt; color: rgb(0, 0, 0); font-weight: normal; text-decoration: none; font-style: normal; vertical-align: baseline; border: 0pt; background-color: rgba(0, 0, 0, 0);"><?echo $row['project_des']; ?></span></p>
                  </td>
               </tr>
               <tr>
                  <td style="padding: 2.25pt 3pt 1.5pt 4.5pt; border: 0.75pt solid rgb(0, 0, 0); width: 158.25pt; height: 27pt; background-color: inherit;" class="">
                     <p><span org_fontsize="18pt" style="font-family: 나눔고딕; font-size: 18pt; color: rgb(0, 0, 0); font-weight: normal; text-decoration: none; font-style: normal; vertical-align: baseline; border: 0pt; background-color: rgba(0, 0, 0, 0);">계약기간</span></p>
                  </td>
                  <td style="padding: 2.25pt 3pt 1.5pt 4.5pt; border: 0.75pt solid rgb(0, 0, 0); width: 233.25pt; height: 27pt; background-color: inherit;" class="">
                     <p><span org_fontsize="12pt" style="font-family: 나눔고딕; font-size: 12pt; color: rgb(0, 0, 0); font-weight: normal; text-decoration: none; font-style: normal; vertical-align: baseline; border: 0pt; background-color: rgba(0, 0, 0, 0);"><? echo $row['contract_date']."일로부터 ".$row['contract_to']."일간";?></span></p>
                  </td>
               </tr>
               <tr>
                  <td style="padding: 2.25pt 3pt 1.5pt 4.5pt; border: 0.75pt solid rgb(0, 0, 0); width: 158.25pt; height: 27pt; background-color: inherit;" class="">
                     <p><span org_fontsize="18pt" style="font-family: 나눔고딕; font-size: 18pt; color: rgb(0, 0, 0); font-weight: normal; text-decoration: none; font-style: normal; vertical-align: baseline; border: 0pt; background-color: rgba(0, 0, 0, 0);">계약금액</span></p>
                  </td>
                  <td style="padding: 2.25pt 3pt 1.5pt 4.5pt; border: 0.75pt solid rgb(0, 0, 0); width: 233.25pt; height: 27pt; background-color: inherit;" class="">
                     <p><span org_fontsize="12pt" style="font-family: 나눔고딕; font-size: 12pt; color: rgb(0, 0, 0); font-weight: normal; text-decoration: none; font-style: normal; vertical-align: baseline; border: 0pt; background-color: rgba(0, 0, 0, 0);">金 <? echo number_format($row['contract_amount']);?>원</span></p>
                  </td>
               </tr>
               <tr>
                  <td style="padding: 2.25pt 3pt 1.5pt 4.5pt; border: 0.75pt solid rgb(0, 0, 0); width: 158.25pt; height: 35.25pt; background-color: inherit;" class="">
                     <p><span org_fontsize="18pt" style="font-family: 나눔고딕; font-size: 18pt; color: rgb(0, 0, 0); font-weight: normal; text-decoration: none; font-style: normal; vertical-align: baseline; border: 0pt; background-color: rgba(0, 0, 0, 0);">착수금</span></p>
                  </td>
                  <td style="padding: 2.25pt 3pt 1.5pt 4.5pt; border: 0.75pt solid rgb(0, 0, 0); width: 233.25pt; height: 35.25pt; background-color: inherit;" class="">
                     <p><span org_fontsize="12pt" style="font-family: 나눔고딕; font-size: 12pt; color: rgb(0, 0, 0); font-weight: normal; text-decoration: none; font-style: normal; vertical-align: baseline; border: 0pt; background-color: rgba(0, 0, 0, 0);">계약금액의 <?echo $row['contract_chaksu'];?>%</span></p>
                  </td>
               </tr>
               <tr>
                  <td style="padding: 2.25pt 3pt 1.5pt 4.5pt; border: 0.75pt solid rgb(0, 0, 0); width: 71.25pt; height: 72pt; background-color: inherit;" class="" colspan="1" rowspan="2">
                     <p><span style="font-family: 나눔고딕; font-size: 18pt; color: rgb(0, 0, 0); font-weight: normal; text-decoration: none; font-style: normal; vertical-align: baseline; border: 0pt; background-color: rgba(0, 0, 0, 0);"></span><span style="font-family: 나눔고딕; font-size: 18pt; color: rgb(0, 0, 0); font-weight: normal; text-decoration: none; font-style: normal; vertical-align: baseline; border: 0pt; background-color: rgba(0, 0, 0, 0);">유지보수</span></p>
                  </td>
                  <td style="padding: 2.25pt 3pt 1.5pt 4.5pt; border: 0.75pt solid rgb(0, 0, 0); width: 158.25pt; height: 35.25pt; background-color: inherit;" class="">
                     <p><span org_fontsize="18pt" style="font-family: 나눔고딕; font-size: 18pt; color: rgb(0, 0, 0); font-weight: normal; text-decoration: none; font-style: normal; vertical-align: baseline; border: 0pt; background-color: rgba(0, 0, 0, 0);">유지보수기간</span></p>
                  </td>
                  <td style="padding: 2.25pt 3pt 1.5pt 4.5pt; border: 0.75pt solid rgb(0, 0, 0); width: 233.25pt; height: 35.25pt; background-color: inherit;" class="">
                     <p><span org_fontsize="12pt" style="font-family: 나눔고딕; font-size: 12pt; color: rgb(0, 0, 0); font-weight: normal; text-decoration: none; font-style: normal; vertical-align: baseline; border: 0pt; background-color: rgba(0, 0, 0, 0);">제작완료일로부터 <? echo $row['bosu_to']; ?>일간</span></p>
                  </td>
               </tr>
               <tr>
                  <td style="padding: 2.25pt 3pt 1.5pt 4.5pt; border: 0.75pt solid rgb(0, 0, 0); width: 158.25pt; height: 32.25pt; background-color: inherit;" class="">
                     <p><span org_fontsize="18pt" style="font-family: 나눔고딕; font-size: 18pt; color: rgb(0, 0, 0); font-weight: normal; text-decoration: none; font-style: normal; vertical-align: baseline; border: 0pt; background-color: rgba(0, 0, 0, 0);">설명</span></p>
                  </td>
                  <td style="padding: 2.25pt 3pt 1.5pt 4.5pt; border: 0.75pt solid rgb(0, 0, 0); width: 233.25pt; height: 32.25pt; background-color: inherit;" class="">
                     <p><span org_fontsize="10pt" style="font-family: 나눔고딕; font-size: 10pt; color: rgb(0, 0, 0); font-weight: normal; text-decoration: none; font-style: normal; vertical-align: baseline; border: 0pt; background-color: rgba(0, 0, 0, 0);"><? echo $row['bosu_des'];?></span></p>
                  </td>
               </tr>
               <tr>
                  <td style="padding: 2.25pt 3pt 1.5pt 4.5pt; border: 0.75pt solid rgb(0, 0, 0); width: 71.25pt; height: 67.5pt; background-color: inherit;" class="" rowspan="2" colspan="1">
                     <p><span style="font-family: 나눔고딕; font-size: 10pt; color: rgb(0, 0, 0); font-weight: normal; text-decoration: none; font-style: normal; vertical-align: baseline; border: 0pt; background-color: rgba(0, 0, 0, 0);"></span><span style="font-family: 나눔고딕; font-size: 18pt; color: rgb(0, 0, 0); font-weight: normal; text-decoration: none; font-style: normal; vertical-align: baseline; border: 0pt; background-color: rgba(0, 0, 0, 0);">기타</span></p>
                  </td>
                  <td style="padding: 2.25pt 3pt 1.5pt 4.5pt; border: 0.75pt solid rgb(0, 0, 0); width: 158.25pt; height: 36pt; background-color: inherit;" class="" rowspan="1" colspan="1">
                     <p><span style="font-family: 나눔고딕; font-size: 18pt; color: rgb(0, 0, 0); font-weight: normal; text-decoration: none; font-style: normal; vertical-align: baseline; border: 0pt; background-color: rgba(0, 0, 0, 0);">해약조건:</span></p>
                  </td>
                  <td style="padding: 2.25pt 3pt 1.5pt 4.5pt; border: 0.75pt solid rgb(0, 0, 0); width: 233.25pt; height: 36pt; background-color: inherit;" class="" rowspan="1" colspan="1">
                     <p><span style="font-family: 나눔고딕; font-size: 10pt; color: rgb(0, 0, 0); font-weight: normal; text-decoration: none; font-style: normal; vertical-align: baseline; border: 0pt; background-color: rgba(0, 0, 0, 0);"><? echo $row['byebye_des']; ?></span></p>
                  </td>
               </tr>
               <tr>
                  <td style="padding: 2.25pt 3pt 1.5pt 4.5pt; border: 0.75pt solid rgb(0, 0, 0); width: 158.25pt; height: 27pt; background-color: inherit;" class="" rowspan="1" colspan="1">
                     <p><span style="font-family: 나눔고딕; font-size: 18pt; color: rgb(0, 0, 0); font-weight: normal; text-decoration: none; font-style: normal; vertical-align: baseline; border: 0pt; background-color: rgba(0, 0, 0, 0);">추가사안:</span></p>
                  </td>
                  <td style="padding: 2.25pt 3pt 1.5pt 4.5pt; border: 0.75pt solid rgb(0, 0, 0); width: 233.25pt; height: 27pt; background-color: inherit;" class="" rowspan="1" colspan="1">
                     <p><span style="font-family: 나눔고딕; font-size: 10pt; color: rgb(0, 0, 0); font-weight: normal; text-decoration: none; font-style: normal; vertical-align: baseline; border: 0pt; background-color: rgba(0, 0, 0, 0);"><? echo $row['contract_plus']; ?></span></p>
                  </td>
               </tr>
               <tr>
                  <td style="padding: 2.25pt 3pt 1.5pt 4.5pt; border: 0.75pt solid rgb(0, 0, 0); width: 487.5pt; height: 238.5pt; background-color: inherit;" class="" rowspan="1" colspan="3">
                  <center>
                     <p><span style="font-family: 나눔고딕; font-size: 18pt; color: rgb(0, 0, 0); font-weight: normal; text-decoration: none; font-style: normal; vertical-align: baseline; border: 0pt; background-color: rgba(0, 0, 0, 0);">위 계약의 내용을 확인하였으며</span></p>
                     <p><span style="font-family: 나눔고딕; font-size: 18pt; color: rgb(0, 0, 0); font-weight: normal; text-decoration: none; font-style: normal; vertical-align: baseline; border: 0pt; background-color: rgba(0, 0, 0, 0);">상호간 계약을 성실히 이행할 것 입니다.</span></p>
                     <p><span style="font-family: 나눔고딕; font-size: 18pt; color: rgb(0, 0, 0); font-weight: normal; text-decoration: none; font-style: normal; vertical-align: baseline; border: 0pt; background-color: rgba(0, 0, 0, 0);">만일, 계약에 위배되는 행위가 일어날 경우</span></p>
                     <p><span style="font-family: 나눔고딕; font-size: 18pt; color: rgb(0, 0, 0); font-weight: normal; text-decoration: none; font-style: normal; vertical-align: baseline; border: 0pt; background-color: rgba(0, 0, 0, 0);">형법에 따라 처벌받을 것임을 서약합니다.</span></p>
                     <p><span style="font-family: 나눔고딕; font-size: 18pt; color: rgb(0, 0, 0); font-weight: normal; text-decoration: none; font-style: normal; vertical-align: baseline; border: 0pt; background-color: rgba(0, 0, 0, 0);"><br></span></p>
                     </center>
                     
                     <table border="0" cellpadding="1" cellspacing="0" style="border-collapse: collapse; margin-left:0pt;" class="__se_tbl" adjusted="true">
                        <tbody>
                           <tr>
                              <td style="padding: 2.25pt 3pt 1.5pt 4.5pt; border: 0.75pt solid rgb(255, 255, 255); width: 198pt; height: 36pt; background-color: inherit;" class="">
                                 <p><span style="font-family: 나눔고딕; font-size: 24pt; color: rgb(0, 0, 0); font-weight: normal; text-decoration: none; font-style: normal; vertical-align: baseline; border: 0pt; background-color: rgba(0, 0, 0, 0);">계약대상자: </span><span style="font-family: 나눔고딕; font-size: 18pt; color: rgb(0, 0, 0); font-weight: normal; text-decoration: none; font-style: normal; vertical-align: baseline; border: 0pt; background-color: rgba(0, 0, 0, 0);"><? echo $row2['my_name']; ?> &nbsp; &nbsp;</span></p>
                                 <p></p>
                              </td>
                              <td style="padding: 2.25pt 3pt 1.5pt 4.5pt; border: 0.75pt solid rgb(255, 255, 255); width: 264pt; height: 36pt; background-color: inherit;" class="">
                                 <p><span org_fontsize="18pt" style="font-family: 나눔고딕; font-size: 18pt; color: rgb(0, 0, 0); font-weight: normal; text-decoration: none; font-style: normal; vertical-align: baseline; border: 0pt; background-color: rgba(0, 0, 0, 0);">﻿</span><img id="f9a41b42-7512-446a-b420-eb13b66122ca.png" src="sign/<?echo md5($cid.'my').'.png'; ?>" style="FONT-SIZE:10pt;WIDTH:237pt;HEIGHT:25.5pt;BACKGROUND-COLOR:inherit;border-top:0pt solid #000000;border-right:0pt solid #000000;border-bottom:0pt solid #000000;border-left:0pt solid #000000;" ></p>
                              </td>
                           </tr>
                           <tr>
                              <td style="padding: 2.25pt 3pt 1.5pt 4.5pt; border: 0.75pt solid rgb(255, 255, 255); width: 198pt; height: 36pt; background-color: inherit;" class="">
                                 <p><span org_fontsize="18pt" style="font-family: 나눔고딕; font-size: 18pt; color: rgb(0, 0, 0); font-weight: normal; text-decoration: none; font-style: normal; vertical-align: baseline; border: 0pt; background-color: rgba(0, 0, 0, 0);">﻿</span><span org_fontsize="24pt" style="font-family: 나눔고딕; font-size: 24pt; color: rgb(0, 0, 0); font-weight: normal; text-decoration: none; font-style: normal; vertical-align: baseline; border: 0pt; background-color: rgba(0, 0, 0, 0);">발주자:</span><span org_fontsize="18pt" style="font-family: 나눔고딕; font-size: 18pt; color: rgb(0, 0, 0); font-weight: normal; text-decoration: none; font-style: normal; vertical-align: baseline; border: 0pt; background-color: rgba(0, 0, 0, 0);"> <? echo $row['balju_name']; ?></span></p>
                              </td>
                              <td style="padding: 2.25pt 3pt 1.5pt 4.5pt; border: 0.75pt solid rgb(255, 255, 255); width: 264pt; height: 36pt; background-color: inherit;" class="">
                                 <p><span org_fontsize="18pt" style="font-family: 나눔고딕; font-size: 18pt; color: rgb(0, 0, 0); font-weight: normal; text-decoration: none; font-style: normal; vertical-align: baseline; border: 0pt; background-color: rgba(0, 0, 0, 0);">﻿</span><img id="f9a41b42-7512-446a-b420-eb13b66122ca.png" src="sign/<?echo md5($cid.'your').'.png'; ?>" style="FONT-SIZE:10pt;WIDTH:237pt;HEIGHT:25.5pt;BACKGROUND-COLOR:inherit;border-top:0pt solid #000000;border-right:0pt solid #000000;border-bottom:0pt solid #000000;border-left:0pt solid #000000;" ></p>
                              </td>
                           </tr>
                        </tbody>
                     </table>
                     <p><span>﻿</span></p>
                  </td>
               </tr>
            </tbody>
         </table>
         <p  style=";" ><span>&nbsp;</span></p>
   </body>
</html>
<script>var oApp={exec:function(){}}</script>