<?php

//insert_forum_message.php

include('database_connection.php');

session_start();

$data = array(
	':from_user_id'		=>	$_SESSION['user_id'],
	':post_body'		=>	$_POST['post_body'],
);

$query = "
INSERT INTO forum (id, message, user_id, date) 
VALUES ('', :post_body, :from_user_id, NOW())
";

$statement = $connect->prepare($query);

if($statement->execute($data))
{

}

?>