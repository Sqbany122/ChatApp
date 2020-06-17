<?php

//fetch_user.php

include('database_connection.php');

session_start();

$query = "
SELECT * 
FROM login 
WHERE user_id != '".$_SESSION['user_id']."' 
";

$statement = $connect->prepare($query);

$statement->execute();

$result = $statement->fetchAll();

$output = '
<table class="table table-bordered table-striped">
	<tr>
		<th width="90%">Nazwa użytkownika</td>
		<th width="10%">Akcja</td>
	</tr>
';

foreach($result as $row)
{
	if ($row['username'] == 'Tomek') {
		$rola = ' - Nauczyciel';
	} else {
		$rola = ' - Rodzic';
	}
	$output .= '
	<tr>
		<td>'.$row['username'].' '.$rola.count_unseen_message($row['user_id'], $_SESSION['user_id'], $connect).' '.fetch_is_type_status($row['user_id'], $connect).'</td>
		<td><button type="button" class="btn btn-primary btn-xs start_chat" data-touserid="'.$row['user_id'].'" data-tousername="'.$row['username'].'">Rozmawiaj</button></td>
	</tr>
	';
}

$output .= '</table>';

echo $output;

?>