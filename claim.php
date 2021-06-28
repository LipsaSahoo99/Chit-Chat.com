<?php
//Getting the value of post parameters

$room = $_POST['room'];

// Checking for string size

if(strlen($room)>20 or strlen($room)<2)
{
	$message = "Please choose a name between 2 to 20 characters";
	echo '<script language="javascript">';
	echo 'alert("'.$message.'");';
	echo 'window.location="http://localhost:8181/chatroom1";';
	echo '</script>';
}

// Checking whether room name is alphanumeric
elseif(!ctype_alnum($room))
{
	$message = "Please choose an alphanumeric room name";
	echo '<script language="javascript">';
	echo 'alert("'.$message.'");';
	echo 'window.location="http://localhost:8181/chatroom1";';
	echo '</script>';
}

else
{
	// Connect to the database
	include 'db_connect.php';
}

// Checks if the room name already exists or not

$sql = "SELECT * FROM `rooms` WHERE roomname = '$room'";
$result = mysqli_query($conn, $sql);

if($result)
{
	if(mysqli_num_rows($result) > 0)
	{
		$message = "Please choose a different room name. This room is already claimed";
		echo '<script language="javascript">';
		echo 'alert("'.$message.'");';
		echo 'window.location="http://localhost:8181/chatroom1";';
		echo '</script>';
	}

	// when mysqli_num_rows==0 then we can give the room to the user so we will insert record to the table
	else
	{

		$sql = "INSERT INTO `rooms` (`roomname`, `stime`) VALUES ('$room', current_timestamp());";
		if(mysqli_query($conn, $sql)) // after insert if the roooms gets ready then when can provide a message to the user
		{
			$message = "Your room is ready & you can chat row!";
			echo '<script language="javascript">';
			echo 'alert("'.$message.'");';
			echo 'window.location="http://localhost:8181/chatroom1/rooms.php?roomname=' . $room . '";';
			echo '</script>';
		}
	}
}

else
{
	echo "Error:". mysqli_error($conn);
}

?>