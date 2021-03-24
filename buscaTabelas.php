<?php
/*
                
    $tablesNameDB = 'Tables_in_serraidi_vmaia377';

    $busca_tabelas = "SHOW FULL TABLES";

    $result_tabelas = mysqli_query($conn, $busca_tabelas) or die ("Erro 0x00110-SQLMaster - ".mysqli_error($conn)); 
    $cont_rows_tabelas = 0;

    $tableName = array();

    while($row_tabelas = mysqli_fetch_array($result_tabelas))
    {
        $SQL_tablesNameDB  = $row_tabelas[$tablesNameDB];
        //print $SQL_tablesNameDB;

        $busca_table = "SHOW FULL COLUMNS FROM ".$SQL_tablesNameDB;

        $result_table = mysqli_query($conn, $busca_table) or die ("Erro 0x00110-SQLShowTables - ".mysqli_error($conn)); 

        $cont_rows_table = 0;

        while($row_table = mysqli_fetch_array($result_table))
        {
            $SQL_Field      = $row_table['Field'];
            $SQL_Type       = $row_table['Type'];
            $SQL_Collation  = $row_table['Collation'];
            $SQL_Null       = $row_table['Null'];
            $SQL_Key        = $row_table['Key'];
            $SQL_Default    = $row_table['Default'];
            $SQL_Extra      = $row_table['Extra'];
            $SQL_Privileges = $row_table['Privileges'];
            $SQL_Comment    = $row_table['Comment'];

            //$array_a[$SQL_Field] = $SQL_Field;
            //${"array_DB_" . $tableMySql}[$SQL_Field] = $SQL_Field;

            
            if($SQL_Comment != '' and $cont_rows_table == 0)
            {
                array_push($tableName, $SQL_Comment.'|'.$SQL_tablesNameDB);
            }

            $cont_rows_table += 1;     
        }
    }

    //print_r($tableName);
    */

   


    $tablesNameDB = 'Tables_in_serraidi_vmaia377';

    $busca_tabelas = " SELECT 
    T.TABLE_NAME,
    C.COLUMN_NAME,
    C.COLUMN_COMMENT    
    FROM 
        information_schema.tables T,
        information_schema.columns C
    WHERE 
        T.TABLE_TYPE = 'BASE TABLE'
    AND
        T.TABLE_NAME = C.TABLE_NAME
    AND 
        T.TABLE_SCHEMA = 'serraidi_vmaia377'
     AND 
         C.COLUMN_NAME LIKE CONCAT('ID_' , SUBSTR(T.TABLE_NAME, 4, 3) , '%')
    AND 
        (C.COLUMN_COMMENT IS NOT NULL AND TRIM(C.COLUMN_COMMENT) <> '') ";
    
    $result_tabelas = mysqli_query($conn, $busca_tabelas) or die ("Erro 0x00110-SQLMaster - ".mysqli_error($conn)); 
    $cont_rows_tabelas = 0;

    $tableName = array();

    while($row_tabelas = mysqli_fetch_array($result_tabelas))
    {
        $SQL_TABLE_NAME      = $row_tabelas['TABLE_NAME'];
        $SQL_COLUMN_NAME     = $row_tabelas['COLUMN_NAME'];
        $SQL_COLUMN_COMMENT  = $row_tabelas['COLUMN_COMMENT'];
        
        array_push($tableName, $SQL_COLUMN_COMMENT.'|'.$SQL_TABLE_NAME);

           
    }


?>