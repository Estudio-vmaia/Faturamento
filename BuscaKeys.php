<?php

//$tb = 'TB_Contratacoes';

/*
$busca_keys = " SELECT fks.TABLE_NAME, COLUMN_NAME, fks.REFERENCED_TABLE_NAME, REFERENCED_COLUMN_NAME ";
$busca_keys .= " FROM information_schema.referential_constraints fks ";
$busca_keys .= " JOIN information_schema.key_column_usage kcu ";
$busca_keys .= " ON fks.constraint_schema = kcu.table_schema ";
$busca_keys .= " AND fks.table_name = kcu.table_name ";
$busca_keys .= " AND fks.constraint_name = kcu.constraint_name ";
$busca_keys .= " WHERE  fks.TABLE_NAME =  '".$tb."' ";
$busca_keys .= " GROUP BY fks.constraint_schema, ";
$busca_keys .= " fks.table_name, ";
$busca_keys .= " fks.unique_constraint_schema, ";
$busca_keys .= " fks.referenced_table_name, ";
$busca_keys .= " fks.constraint_name ";
$busca_keys .= " ORDER BY fks.constraint_schema, ";
$busca_keys .= " fks.table_name; ";
*/

$busca_keys = "SELECT * FROM TB_KEYS WHERE TABLE_NAME =  '".$tb."' ";


$result_keys = mysqli_query($conn, $busca_keys) or die ("Erro 0x00102-SQLBuscaKeys - ".mysqli_error($conn)); 

$num_rows_keys = mysqli_num_rows($result_keys);

$cont_rows_keys = 0;

$tableKeys = array();

while($row_keys = mysqli_fetch_array($result_keys))
{
    $SQLKeys_TABLE_NAME 			= $row_keys['TABLE_NAME'];
    $SQLKeys_COLUMN_NAME 			= $row_keys['COLUMN_NAME'];
    $SQLKeys_REFERENCED_TABLE_NAME 	= $row_keys['REFERENCED_TABLE_NAME'];
    $SQLKeys_REFERENCED_COLUMN_NAME = $row_keys['REFERENCED_COLUMN_NAME'];
    
    
    $tableKeys[$cont_rows_keys]['TABLE_NAME'] = $SQLKeys_TABLE_NAME;
    $tableKeys[$cont_rows_keys]['COLUMN_NAME'] = $SQLKeys_COLUMN_NAME;
    $tableKeys[$cont_rows_keys]['REFERENCED_TABLE_NAME'] = $SQLKeys_REFERENCED_TABLE_NAME;
    $tableKeys[$cont_rows_keys]['REFERENCED_COLUMN_NAME'] = $SQLKeys_REFERENCED_COLUMN_NAME;

    //Definção de Globals
    $GLOBALS[$tableKeys[$cont_rows_keys]['TABLE_NAME']] = $SQLKeys_TABLE_NAME;
    $GLOBALS[$tableKeys[$cont_rows_keys]['COLUMN_NAME']] = $SQLKeys_COLUMN_NAME;
    $GLOBALS[$tableKeys[$cont_rows_keys]['REFERENCED_TABLE_NAME']] = $SQLKeys_REFERENCED_TABLE_NAME;
    $GLOBALS[$tableKeys[$cont_rows_keys]['REFERENCED_COLUMN_NAME']] = $SQLKeys_REFERENCED_COLUMN_NAME;
 
    $cont_rows_keys += 1;     
}

//print $num_rows_keys.'aa <br>';
//print $tableKeys[0]['TABLE_NAME'].'<br>';
//print $tableKeys[0]['COLUMN_NAME'].'<br>';


function compareKey($key, $value, $array, $conn)
{
	foreach ($array as $row)
	{
		if($key == $row['COLUMN_NAME'])
		{
			$busca_keysResult = " select * from ". $row['REFERENCED_TABLE_NAME']." where ". $row['REFERENCED_COLUMN_NAME']." = ".$value;

	        $result_keysResult = mysqli_query($conn, $busca_keysResult) or die ("Erro 0x00107-SQLCompareKeys - ".mysqli_error($conn)); 

	        $cont_rows_keysResult = 0;

	        while($row_keysResult = mysqli_fetch_array($result_keysResult))
	        {
	            $SQL_KeyNome    = $row_keysResult['Nome'];
	            /*
	            $SQL_Type       = $row_keysResult['Type'];
	            $SQL_Collation  = $row_keysResult['Collation'];
	            $SQL_Null       = $row_keysResult['Null'];
	            $SQL_Key        = $row_keysResult['Key'];
	            $SQL_Default    = $row_keysResult['Default'];
	            $SQL_Extra      = $row_keysResult['Extra'];
	            $SQL_Privileges = $row_keysResult['Privileges'];
	            $SQL_Comment    = $row_keysResult['Comment'];	            
	            */
	        }
	        
			//return $value;
			$GLOBALS['valueKeySql'] = $SQL_KeyNome;
			return $GLOBALS['valueKeySql'];
			//return 'com_chave|'.$row['REFERENCED_TABLE_NAME'].'|'.$row['REFERENCED_COLUMN_NAME'];
		}		   	    
	}
}


//print compareKey('ID_Empresa',$tableKeys);
/*
foreach ($tableKeys as $row)
{
    echo $row['TABLE_NAME'].' - ';
    echo $row['COLUMN_NAME'].' - ';
    echo $row['REFERENCED_TABLE_NAME'].' - ';
    echo $row['REFERENCED_COLUMN_NAME'];
    print '<br>';
}

print '<pre>';
print_r($tableKeys);
print '</pre>';
*/

?>