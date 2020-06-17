<!--
//login.php
!-->

<?php

include('API/database_connection.php');

session_start();

$message = '';

if(isset($_SESSION['user_id']))
{
	header('location:index.php');
}

if(isset($_POST['login']))
{
	$query = "
		SELECT * FROM login 
  		WHERE username = :username
	";
	$statement = $connect->prepare($query);
	$statement->execute(
		array(
			':username' => $_POST["username"]
		)
	);	
	$count = $statement->rowCount();
	if($count > 0)
	{
		$result = $statement->fetchAll();
		foreach($result as $row)
		{
			if(password_verify($_POST["password"], $row["password"]))
			{
				$_SESSION['user_id'] = $row['user_id'];
				$_SESSION['username'] = $row['username'];
				$sub_query = "
				INSERT INTO login_details 
	     		(user_id) 
	     		VALUES ('".$row['user_id']."')
				";
				$statement = $connect->prepare($sub_query);
				$statement->execute();
				$_SESSION['login_details_id'] = $connect->lastInsertId();
				header('location:index.php');
			}
			else
			{
				$message = '<label>Wrong Password</label>';
			}
		}
	}
	else
	{
		$message = '<label>Wrong Username</labe>';
	}
}


?>

<html>  
    <head>  
        <title>Chat Application using PHP Ajax Jquery</title>  
		<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
		<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  		<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    </head>  
    <body>  
        <div class="container">
			<br />
			
			<h3 align="center">Aplikacja Czatu</h3><br />
			<br />
			<div class="panel panel-default">
				<div class="panel-body">
					<p class="text-danger"><?php echo $message; ?></p>
					<form method="post">
						<div class="form-group">
							<label>Wpisz nazwę użytkownika</label>
							<input type="text" name="username" class="form-control" required />
						</div>
						<div class="form-group">
							<label>Wpisz hasło</label>
							<input type="password" name="password" class="form-control" required />
						</div>
						<div class="form-group">
							<input type="submit" name="login" class="btn btn-info" value="Zaloguj" />
						</div>
						<div class="form-group">
							<p>Dostępni użytkownicy</p>
							<div class="mb-3">
								<span style="display: block;"><b>Tomek - Nauczyciel</b></span>
								<span style="display: block;">Login: Tomek</span>
								<span style="display: block;">Hało: password</span>
							</div>
							<div class="mb-3">
								<span style="display: block;"><b>Ania - Rodzic</b></span>
								<span style="display: block;">Login: Ania</span>
								<span style="display: block;">Hało: password</span>
							</div>
							<div class="mb-3">
								<span style="display: block;"><b>Dawid - Rodzic</b></span>
								<span style="display: block;">Login: Dawid</span>
								<span style="display: block;">Hało: password</span>
							</div>
							<div class="mb-3">
								<span style="display: block;"><b>Magda - Rodzic</b></span>
								<span style="display: block;">Login: Magda</span>
								<span style="display: block;">Hało: password</span>
							</div>
							<div class="mb-3">
								<span style="display: block;"><b>Wojtek - Rodzic</b></span>
								<span style="display: block;">Login: Wojtek</span>
								<span style="display: block;">Hało: password</span>
							</div>
						</div>
					</form>
					<br />
					<br />
					<br />
					<br />
				</div>
			</div>
		</div>

    </body>  
</html>