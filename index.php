<?php

include('API/database_connection.php');

session_start();

if(!isset($_SESSION['user_id']))
{
	header("location:login.php");
}

?>

<html>  
    <head>
		<meta http-equiv="content-type" content="text/html; charset=utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>Czat</title>
		<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.rawgit.com/mervick/emojionearea/master/dist/emojionearea.min.css">
		<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  		<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  		<script src="https://cdn.rawgit.com/mervick/emojionearea/master/dist/emojionearea.min.js"></script>
  		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.2.2/jquery.form.js"></script>

        <style>
        .textAlign {
            text-align: right;
        }

        @media only screen and (max-width: 991px) {
            .textAlign {
                text-align: left;
                margin-left: -15px;
            }
        }
        
        .message {
            width: auto;
            height: auto;
            color: white;
        }

		.messageUser {
			width: auto;
            height: auto;
            color: white;
		}
		.messageDate {
			font-size: 12px;
			margin-bottom: 0;
		}
        </style> 

    </head>  
    <body>
		<nav class="navbar navbar-expand-lg navbar-light bg-light">
			<a class="navbar-brand" href="index.php">Czat</a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarNavAltMarkup">
				<div class="navbar-nav col-sm-6">
				<a class="nav-item nav-link" href="index.php">Strona głowna</a>
				<a class="nav-item nav-link" href="chat.php">Czat</a>
				</div>
				<div class="fd-flex col-sm-6 textAlign">
					<span>
						<a class="ml-3 btn btn-primary" href="logout.php">Wyloguj</a>
					</span>
				</div>
			</div>
		</nav>
        <div class="container pt-5">
            <h1 class="text-center">Forum</h1>
            <div id="forum_messages" class="mb-5 mt-5">

            </div>
            <div class="form-group">
                <textarea id="post_body" class="form-control"  name="post_body" placeholder="Wpisz treść wiadomości..." rows="1"></textarea>
                <button id="submit_forum_post" class="btn btn-primary mt-2" name="submit_forum_post">Wyślij</button>
            </div>
		</div>
		<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    </body>  
</html>

<script>

    $( document ).ready(function() {
        $.ajax({
			url:"API/fetch_forum_messages.php",
			method:"POST",
			success:function(data){
				$('#forum_messages').html(data);
			}
		})

		setInterval(function(){
			show_forum_messages();
		}, 2000);
    });

	function show_forum_messages(){
		$.ajax({
			url:"API/fetch_forum_messages.php",
			method:"POST",
			success:function(data){
				$('#forum_messages').html(data);
			}
		})
	}

    $(document).on('click', '#submit_forum_post', function(){

		var post_body = $.trim($('#post_body').val());
		if(post_body != '')
		{
			$.ajax({
				url:"API/insert_forum_message.php",
				method:"POST",
				data:{post_body:post_body},
                success:function(data) {
                    console.log(post_body);
                }
			})
		}
		else
		{
			alert('Type something');
		}
	});

    function fetch_forum_messages()
	{
		
	}
</script>