<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Message board</title>
	<link rel="stylesheet" href="mine.css" type="text/css">
</head>
<body>	
	<div id="home"><a href="../hw1/index.html"><img src="../hw4/home.jpeg" alt=""></a></div>
	<h1>Message Board</h1>
	<form  method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
		<table>
			<tr>
				<td>Name:<td><input name="name" type="text" maxlength="25" required></td></td>
				<td>Title:<td><input name="title" type="text" maxlength="255" required></td></td>
			</tr>
			<tr>
				<td>Content:</td>
				<td colspan="3"><textarea name="content" type="text" maxlength="255" required></textarea></td>
			<tr>
				<td></td>
				<td colspan="2"><input type="hidden" name="time">
				<input id="submit" type="submit" name="submit" value="leave a message!"></td>
			</tr>
		</table>
		<div id="top"><img src="top.jpg" alt="post-it" width="300px" height="300px"></div>
	</form>
	<div id="board">
<?php
//connect to database
    $conn=mysqli_connect('140.117.74.140','webclass2015','student107');
    //$conn=mysqli_connect('localhost','root','root');
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    echo "Connected successfully";
    mysqli_select_db($conn,"webclass2015");

//接form的答案    
    if(isset($_POST["submit"])){
		$name=$_POST["name"];
		$title=$_POST["title"];
		$content=$_POST["content"];
		date_default_timezone_set('Asia/Taipei');
		$tmptime=$_POST["time"]= date("Y-m-d H:i:s");
	    mysqli_query($conn,$query);
	}
    $query="INSERT INTO `b034020009`(`userName`,`msgTitle`,`msgContent`,`msgTime`) VALUES ('".$name."', '".$title."', '".$content."', '".$tmptime."')";


//選取訊息
    $select="SELECT `userName`,`msgTitle`,`msgContent`,`msgTime` FROM `b034020009` ORDER BY `msgTime` DESC";
    $result=mysqli_query($conn,$select);
    while($one_msg=mysqli_fetch_assoc($result)){
		echo "<div class='one_msg'><h1>";

		echo $one_msg["userName"];
		echo "</h1><div class='dialogue'><h2>";
		echo $one_msg["msgTitle"];
		echo "</h2><p>";
		echo $one_msg["msgContent"];
		echo "</p></div><div id='time'>";
		echo $one_msg["msgTime"];

		echo "</span></div></div>";
	}
	mysqli_free_result($result);
	mysqli_close($conn);
?>
	</div>
</body>
</html>