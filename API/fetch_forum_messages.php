<?php

//fetch_forum_messages.php

include('database_connection.php');

session_start();

echo fetch_forum_messages($connect);

?>