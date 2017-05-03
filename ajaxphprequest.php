<?php 
//NOT used  AT ALL!!!!!!!!!!!!!!!! as  we  don't  deal  with  SQL  DB  and  have  no need to  use  PHP to SELECT something
//used  in dipsplay.php  as  well as  ajaxscript.js  //getFile

session_start();

//WORKS
//GET  triggerred  in JQUERY setTimeOUT  $['GET'] des  not  exist  , u create  it  by JQ  request

if (isset($_GET['getFile']))     //disable  just in  test mode -RETURN
 {   
$file = file("ipTrack.txt");
$file = array_reverse($file);
foreach($file as $f){
    /*echo*/  echo json_encode ($f."<br />");}
//echo json_encode($rows);
 } 