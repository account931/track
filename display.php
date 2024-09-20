<?php
ob_start(); //fix error Headers already sent
session_start();  
//This  file shows  ALL  RECORDS (ip addresses, time, etc from /ipTrack.txt) ,  normal  &  Ajax//<!--check pass and  set SESSION['X']+unset when logged-->
//<!--uses ajaxscript.js+ ajaxphprequest.php-->
?>
<!DOCTYPE html>
<html>
<head>
<title>Admin Section</title>
<link rel="stylesheet" type="text/css" href="style.css" />
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
<script src="ajaxscript.js"></script><!--AJAX script-->
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<!-- bootstrap -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
  

<script> //click on arrow  down to  see  UserAgent  info  //&#9660
$(document).ready(function(){  
    $(".imgClick").click(function(){         
        $(this).next("p").toggle(300); //open  and closes
             // shifting tiangles  with HTML Entity http://www.fileformat.info/info/unicode/char/25b2/index.htm
                 if($(this).text()=="\u25BC"){$(this).html("\u25B2"); }  else {$(this).html("\u25BC");}
    });
});
</script>


<style>
.shadow2R{text-shadow: 2px 2px 4px  black/*#000000*/; }
.boxedshadow{box-shadow: 0 0 10px rgba(0,0,0,1.5);}
.format{width:90%;}
.imgClick:hover{cursor:pointer;color:red;}// arrow  down  style
.imgClick{padding-left:65px;}
.hiddennn{display:none;}
</style>
</head>
<body><center>
<!-- admin part  for  viewing log  for  anyone  having password-->


<?php

//$_SESSION['auth']=true;   BUGGG

if(!isset($_SESSION['auth'])){ 
?>    


<!------------------------------------------------If not authorized---------------------------------------->
<div id="login" class="shadow2 col-sm-12 col-xs-12">
<!--<img scr="http://example2.esy.es/tr/images/accessd.png" alt="access"/>-->

<p class="imgClick">&#9660;</p> <p style="display:none;font-size:46px;" class="hiddennn">NO ACCESS  GRANTED</p>
</br></br>
<p><i class="fa fa-drivers-license-o" style="font-size:24px"></i> Welcome acc***1, pass: currEmp</p>
<form action="" method="post">
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Login:&nbsp<input type="text" name="login1" required class="resultRu">
</br></br>
Password:&nbsp<input type="password" name="pass1" required class="resultRu">
<br><br>
<input type="submit" value="Submit" class="convert">

</form></br></br>
</div>
<!------------------------------------------------END If not authorized---------------------------------------->
<?php
// else  password is  correct
 } else {  
?>




<div id="log" class="boxedshadow format col-sm-12 col-xs-12 ">
</br><a style="color:red;border:1px solid red;padding:4px;" href="display.php/?logout">Log out</a>  <span style="color:red;font-size:1.7em;"> &#10052; </span> </br>
<!-----------------------------------------------------------------------------------Display log----------------------------------------------------------->


<?php
//echo file_get_contents( "ipTrack.txt" ); // get the contents in REVERSE , and echo it out
//doing  reverse-temporary  disabled,trying  to  ressigned  to AJAX

$coutriesIP = array(
    'Brussels'    => '85.119.216.74',
	'Bulgaria'    => '82.137.91.112',
	'Estonia'     => '213.35.160.50',
	'Hungary'     => '93.189.114.202',
	'Latvia'      => '213.175.127.228',
	'Lithuania'   => '188.69.232.129',
	'Netherland'  => '92.70.92.181',
	'Nice'        => '193.57.185.10',
	'Norway'      => '176.221.91.52',
	'Paris'       => '176.161.170.36',
	'Switzerland' => '46.253.189.218',
	'Turkey'      => '5.2.184.235',
	                  
);
$file = file("ipTrack.txt");
$file = array_reverse($file);
//$copenIP = "/\93.165.147\b/";
 $copenIP = '/93.165.147.58(\.com)?/';
foreach($file as $f){  
    //if(trim($f) !='') {var_dump($f);}
	
    echo $f; //display the file line itself (ip address, time, etc)
	//display alert sign if IP is foreign(not DK)
	if (trim($f) !='' && !preg_match('/93.165.147.58|82.163.120.154|152.115.135.54/', $f)) { 
	    echo '<span style="color:red;font-size:0.5em;">foreign </span> 
		     <span style="color:red;font-size:0.7em;"> &#9730; : </span>';   //html icon
		//dispaly foreign country if it is in $coutriesIP
		$detectedCountry = "not in the list";
		foreach($coutriesIP as $key => $val){ 
			if(preg_match("/$val/", $f)) { 
			    $detectedCountry = $key;
			}
			
		}
		echo '<span style="color:red; text-decoration: underline; font-size:0.6em;">' .  $detectedCountry . '</span>'; 
	}
	echo "<br/>";

}




//below  works  but  not  making reverse  list*********
/*foreach (glob( "ipTrack.txt") as $filename) {
    echo nl2br(file_get_contents($filename));
    echo "<br></br>";
}*/
// END below  works  but  not  making reverse  list-----------

?>


<!--  for  ajax  htmling-->
<!-----------------  Logic  of  ajaxing   is located   in  scriptajax.js , USES  REVERSED ARRAY!!!!!----------> 
</br></br></br>
<H1 class="boxedshadow">Ajax Responses</h1>
<div id ="displayDiv"></div>  
<!-- END  for  ajax  htmling-->
<!--<ul></ul>--> <!--  Ajax   Ul  without  PHP  part-->

<?php
}//else
?>
<!-- END  Display  comment-->

</div>










<?php
//checking password
if(isset($_POST['pass1'])){
    if($_POST['login1']=='account931' && $_POST['pass1']=='loyalty') {
        $_SESSION['auth']=true;echo'true';
		header ('Location: display.php');
    } else {
		echo'<p style="color:red;">Failed</p>';
	}

} // End  if(isset($_POST['pass1']))


//Log OUT
if(isset($_GET['logout'])){
    session_destroy();
	unset($_SESSION['auth']); 
	header ("Location: display.php");
}
ob_end_flush(); //fix error Headers already sent
?>


</center>
</body>
</html>
