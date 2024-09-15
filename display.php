<?php  
//THIS  SHOWS  ALL  RECORDS ,  normal  &  Ajax//<!--check pass and  set SESSION['X']+unset when logged-->
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
.format{width:60%;}
.imgClick:hover{cursor:pointer;color:red;}// arrow  down  style
.imgClick{padding-left:65px;}
.hiddennn{display:none;}
</style>
</head>
<body><center>
<!-- admin part  for  viewing log  for  anyone  having password-->


<?php
session_start();
//$_SESSION['auth']=true;   BUGGG

if(!isset($_SESSION['auth'])){ ?>    


<!------------------------------------------------If not authorized---------------------------------------->
<div id="login" class="shadow2 ">
<!--<img scr="http://example2.esy.es/tr/images/accessd.png" alt="access"/>-->

<p class="imgClick">&#9660;</p> <p style="display:none;font-size:46px;" class="hiddennn">NO ACCESS  GRANTED</p>
</br></br>
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




<div id="log" class="boxedshadow format">
</br><a style="color:red;border:1px solid  red;padding:4px;" href="/tr/display.php/?logout">Log out</a></br>
<!-----------------------------------------------------------------------------------Display log----------------------------------------------------------->


<?php
//echo file_get_contents( "ipTrack.txt" ); // get the contents in REVERSE , and echo it out
//doing  reverse-temporary  disabled,trying  to  ressigned  to AJAX

$coutriesIP = array(
        'Lithuania'   => '188.69.232.129',
	'Paris'       => '176.161.170.36',
	'Estonia'     => '213.35.160.50',
	'Switzerland' => '46.253.189.218',
	'Hungary'     => '93.189.114.202',
	'Latvia'      => '213.175.127.228',
	'Bulgaria'    => '82.137.91.112',
	'Nice'        => '193.57.185.10',
	'Brussels'    => '85.119.216.74',
	'Netherland'  => '92.70.92.181',
    'Turkey'      => '95.2.184.235',
);
$file = file("ipTrack.txt");
$file = array_reverse($file);
foreach($file as $f){
    //if(trim($f) !='') {var_dump($f);}
    echo $f; //display the file line itself (ip address, time, etc)
    //display alert sign if IP is foreign(not DK)
    if (trim($f) !='' && !preg_match('/93.165.147.58|82.163.120.154|152.115.135.54/', $f)) { 
	    echo '<span style="color:red;font-size:0.6em;">foreign </span>'; 
		//dispaly foreign country if it is in $coutriesIP
		foreach($coutriesIP as $key => $val){ 
			if(preg_match("/$val/", $f)) { 
			    echo '<span style="color:red; font-size:0.6em;">' .  $key . '</span>'; 
			}
			
		}
	}	
	echo "<br/>";
	//if (trim($f) !='' && !preg_match('/93.165.147.58/', $f)) { echo '<span style="color:red;">foreign </span>'; }
	//if (str_contains('93.165.147.58', $f)) { echo 'foreign '; }
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
   if   ($_POST['login1']=='account***' && $_POST['pass1']=='v***') 
 {$_SESSION['auth']=true;echo'true';header ('Location: http://example2.esy.es/tr/display.php');
                                    } else {echo'<p style="color:red;">Failed</p>';}

} // End  if(isset($_POST['pass1']))


//Log OUT
if(isset($_GET['logout'])){
session_destroy();unset($_SESSION['auth']); header ("Location: http://example2.esy.es/tr/display.php");
}

?>








</center>
</body>
</html>
