<?php



function PopulaCombo($tb, $campo, $tbRef, $conn)
{
	
	//$busca_combo = " select distinct(".$campo.") from ".$tb;

	$busca_combo = " select distinct(ref.Nome), tab.".$campo;
	$busca_combo .= " from ".$tb." tab, ".$tbRef." ref ";
	$busca_combo .= " where tab.".$campo." = ref.".$campo." ";

	//print '<hr>'.$busca_combo.'<br>';
    
    $result_combo = mysqli_query($conn, $busca_combo) or die ("Erro 0x00109-SQLPopulaCombo - ".mysqli_error($conn)); 

    $cont_rows_combo = 0;


    ${'array_combo_' . $campo} = '';
    
    while($row_combo = mysqli_fetch_array($result_combo))
    {
        $SQL_Campo = $row_combo[$campo];
        $SQL_Nome = $row_combo['Nome'];
        
        //print '--> '.$SQL_Campo.'<br>';
        ${'array_combo_' . $campo} .= $SQL_Campo.'|'.$SQL_Nome.',';

        $cont_rows_combo += 1;     
    }
   	
   	$listaCombo = substr(${'array_combo_' . $campo}, 0, -1);

   	return $listaCombo;
    //print ${'array_combo_' . $campo}.' <-- <br>';

}

?>
