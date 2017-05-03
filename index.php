<style>
.bbb { width:15px;height:10px;font-size:5px}
//.bbb { width:300px;height:50px;font-size:20px}
#remDisplay{font-size:9px;} //37px
</style>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>



<div>
<center>
<h3  class='boxedshadow'></h3>
</br>
</br>
</br>
</br>
</br>
</br>





<!--Alternative  version for  $date, can set  blank space,  can use  in future -->
<!--date_default_timezone_set('Europe/Kiev');
$date=date("Y-m-d")." ".date("h:i:sa");-->
<!--End -->





<!----------------------------------------------------------------------------------------->
<?php
//-START SAVING IP, time  and  date -which is  dispalayed in admin view;
//saving  date  and  time 
//add Chrome  to autostart
//SAVE  IPLIST
date_default_timezone_set("Europe/Kiev");
$ip=$_SERVER['REMOTE_ADDR'];//ip adress
$hardware=$_SERVER['HTTP_USER_AGENT']; // user  browser info
$fileIP = "ipTrack.txt";
$date=date("d.m.y.H:i");
$Saved_File = fopen($fileIP, 'a');
fwrite($Saved_File,$date.' ----- '.$ip." <span class='imgClick'>&#9660;</span> "."<p class='info' style='display:none;'>".$hardware."</p>"."\r\n\n"); // add a new line to the  string :)
fclose($Saved_File);   
//END SAVING IP, time  and  date
?>
<!---------------------------------------------------------------------------------------------------->









<!--------------START  Displaying the  counter-->
<!--display INT-->
<div id="remDisplay">
<?php
foreach (glob("remInt.txt") as $filename) {
    echo "<span style='color:black;'>".nl2br(file_get_contents($filename))."</span>";
    echo "<br></br>";
}


//++  is  made on every load ; button make  it  too-just  reloads  the  page;
//adding ++
    //if(isset($_POST['rem'])){
//name  of  file
$filename = "remInt.txt";
//$content = file($filename);
//$content=$content+1;
$d=file_get_contents($filename);
$int = (int)$d;
$int++;


$insertvote=$int;
//save 
$fp = fopen($filename,"w");
fputs($fp,$insertvote);
fclose($fp);
//end  save


//header("Location: http://example2.esy.es/tracker");

//exit;


//}  // ENDif(isset($_POST['rem'])){
?>
</div>
<!--End  dispaly INT-->










<form action="" method="post">
 <input type="submit" value="++" name="rem" class="bbb">
</form>











</center>
</div>