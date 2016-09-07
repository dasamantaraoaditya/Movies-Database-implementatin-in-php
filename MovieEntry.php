<!DOCTYPE html>
<html>
<title>
Movie Entry
</title>
<body>
<center><b>Movie Entry Form</b></center>

<div id="movieentry">
<form id="moviedata" action="MovieEntry.php" method="post">
<center>
<table>
<tr><td align=left>Movie Title:</td><td align=left><input type=text name=title size=20 id=title></td><td align=left><input type=submit name=save value=save id=save></td></tr>
<tr><td align=left>Year Of The Movie:</td><td align=left><input type=text name=year size=20 id=year></td><td align=left><input type=reset name=clear value=clear id=clear><td></tr>
<tr><td align=left>Genre (Horror,Comedy,action ,etc):</td><td align=left><input type='text' name=genre id=genre size=20></td><td><input type=button onclick="myFunction();" value="View Movie List"></td></tr>
<tr><td align=left>Lead Actor:</td><td align=left><input type=text name=actor size=20 id=actor></td></tr>
<tr><td align=left>Awards:</td><td align=left><input type=text name=awards size=20 id=awards></td></tr>
</table>
</center>
<p id="demo"></p>
<script type="text/javascript">
function myFunction() {
	
	var data=<?php 
	$txt="Movie data.txt";
	$lines = file($txt);
	natsort($lines);
file_put_contents($txt,  $lines);

	$fp=fopen($txt,'r');
	$read="<center>";
	do {
  $read .= fgets($fp) . "<br>";
}while(!feof($fp));

fclose($fp);
	echo json_encode($read);?>;
	document.getElementById("demo").innerHTML =data ;
}

</script>
</form>
</div>


<?php
$txt="Movie data.txt";

if(!empty($_POST['title']) && !empty($_POST['year'])&& !empty($_POST['awards'])&& !empty($_POST['actor'])&& !empty($_POST['genre'])) 
{ 	
 $data =$_POST['title'] . '-' . $_POST['year']. '-' . $_POST['genre']. '-' . $_POST['actor']. '-' . $_POST['awards']."\r\n";
    $fp = fopen($txt, 'a');  // Write information to the file
	$lines = file($txt);
	$flag=True;
	natsort($lines);
file_put_contents($txt,  $lines);
foreach ($lines as $line_num => $line) {
	 if (strpos(htmlspecialchars($line),$_POST['title']) !== false) {
		$flag=False;
		break;
}
}
if($flag)
{
	$ret=fwrite($fp,$data);
	if($ret===FALSE) {
        die('There was an error while updating please try again!!');
    }
    else {
        echo "your data is updated";
    }
	fclose($fp);
}
else
{
	echo "Title already exists !!! ";
}
}
else {
   die('Please fill up all the fields');
}

?>
    
</body>
</html>
