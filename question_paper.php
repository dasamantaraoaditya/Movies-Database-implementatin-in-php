
<html>
<title>paper</title>
<head>
<h1>PAPER
</h1>
<style>
h1 {
	text-align:center;
}
table {
	
		border-collapse:collapse;
		margin-top:130px;
		margin-left:150px;
}
</style>
</head>
<body>
<?php
		 
            $dbhost = '127.0.0.1';
            $dbuser = 'root';
            $dbpass = ''; //no password is there for my root
            $dbname='exam_sheet'; //database name
            $conn = mysqli_connect($dbhost, $dbuser, $dbpass,$dbname); //opening connection
            
            if(! $conn ) //if connection is failed
            {
               die('Could not connect: ' . mysqli_error()); //show the error
            }

            else //if success
            {
				$sql="select * from paper1 order by rand()";
				$result=mysqli_query($conn,$sql);
				if(mysqli_num_rows($result))
				{	echo "<table border=2 width=80%>";
					echo "<th>QUESTION</th> <th>OPTION 1 </th> <th>OPTION 2</th><th>OPTION 3 </th> <th>OPTION 4 </th> <th> ANSWER</th>";
					   while($row=mysqli_fetch_assoc($result))
					   {
						   echo "<tr><td>".$row['question']."</td><td>".$row['opt1']."</td><td>".$row['opt2']."</td><td>".$row['opt3']."</td><td>".$row['opt4']."</td><td>".$row['answer']."</td></tr>";
					   }
					    echo "</center>";
				}
				else
				{
					echo "<center><br><br><b>NO QUESTIONS FOUND</b></center>";
				}
            mysqli_close($conn); //close the connection
			}

?>
</body>
</html>