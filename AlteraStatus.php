<?php

include('config.php');

include('conn_db.php');

$get_id = @$_GET['id'];
$get_tb = @$_GET['tb'];
$get_column = @$_GET['cl'];

		$busca_status = "Select * from ".$get_tb." where ".$get_column." = ".$get_id;
		print $busca_status.'<br>';

		$result_status = mysqli_query($conn, $busca_status) or die ("Erro 0x00110-SQLShowStatus - ".mysqli_error($conn)); 

        while($row_status = mysqli_fetch_array($result_status))
        {
            $SQL_Status = $row_status['Status'];
			print 'Status = '.$SQL_Status.'<br>';

			if($SQL_Status == 1)
			{
				$get_status = 0;
			}
			else
			{
				$get_status = 1;
			}

			print 'Novo Status = '.$get_status.'<br>';;

			$alterStatus = " UPDATE ".$get_tb;
			$alterStatus .= " SET Status = ".$get_status;
			$alterStatus .= " WHERE ".$get_column." = ".$get_id;

			print $alterStatus;

			$result_table = mysqli_query($conn, $alterStatus) or die ("Erro 0x00110-UpdateStatus - ".mysqli_error($conn)); 
		}	

?>