<?php

$tb = @$_POST['tb'];

include('config.php');

include('conn_db.php');

$SQl_Update = ' UPDATE '.$tb.' SET ';

$contPosts = 0;

if ($_SERVER['REQUEST_METHOD'] === 'POST')
{
	foreach ($_POST as $key => $value)
	{
		$CampoTb = str_replace("form_", "", $key);

		if($key != 'redirect' && $key != 'tb')
		{
			if($contPosts == 0)
			{
				$CondWhere = $CampoTb." = '". $value."'";
			}

			$SQl_Update .= $CampoTb." = '".$value."', ";

			//echo "Field ".htmlspecialchars($key)." is ".htmlspecialchars($value)."<br>";

			$contPosts += 1;
		}
	}
}

$SQl_Update = substr($SQl_Update, 0, -2);

$SQl_Update .= ' WHERE '.$CondWhere;

//print $SQl_Update;

$SQl_Update = mysqli_query($conn, $SQl_Update) or die ("Erro 0x00110-SQLUpdateCRUD - ".mysqli_error($conn)); 


$redirect = @$_POST['redirect'].'?tb='.$tb;

//print $redirect;
?>

<script type="text/javascript">
	loadUnicPage('<?php print $redirect;  ?>', 'listagem');	
</script>

