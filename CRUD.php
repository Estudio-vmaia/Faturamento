<?php

$tb = '';
if (ISSET($_REQUEST['tb'])) {
	$tb = $_REQUEST['tb'];
}

$id = '';
if (ISSET($_REQUEST['id'])) {
	$id = $_REQUEST['id'];
}

include('config.php');

include('conn_db.php');

include('BuscaKeys.php');

include('Functions.php');


 	$busca_table = "SHOW FULL COLUMNS FROM ".$tb;

    $result_table = mysqli_query($conn, $busca_table) or die ("Erro 0x001085-SQLShowTables - ".mysqli_error($conn)); 

    $cont_rows_table = 0;

    $tableColumns = array();
    $NameColumns = array();
    

    $QryCampos = '';

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

        //if($SQL_Comment != '')
        //{
            
            if($cont_rows_table == 0)
            {
                $titleFiltro = $SQL_Comment;                                   
            }
            
            $QryCampos .= $SQL_Field.', ';

            if($SQL_Comment != '')
    		{
                array_push($NameColumns, $SQL_Comment);
            }
            else
            {
            	array_push($NameColumns, $SQL_Field);
            }
                array_push($tableColumns, $SQL_Field);
            
            
        //}

        $cont_rows_table += 1;     
    }


    $busca_column = "select * from ".$tb." where ".$tableColumns[0]." = ".$id;

    //print $busca_column;

	$result_column = mysqli_query($conn, $busca_column) or die ("Erro 0x00110-SQLShowColumn - ".mysqli_error($conn)); 

	$conCloumns = 0;

	//CRIAR ARRY PARA NÃO MOSTRAR CAMPOS NA EDIÇÃO.
	//CRIAR ARRY PARA MUDAR O TIPO DO CAMPO NA EDIÇÃO.
	// BATER ESSES ARRYS COM O LOOP ABAIXO



?>
<div class="chute-icon"></div>
<div class="scroller-chute scroller-primary chute-fh-xs mrn">
    <div class="allcp-form theme-primary">

		<form  name="FormCRUD" id="FormCRUD" method="post" action="SendCRUD.php" onSubmit="return SendForm(this.id, 'listagem');">  
		<input type="hidden" name="redirect" id="redirect" value="Listagem.php">
		<input type="hidden" name="tb" id="tb" value="<?php print $tb; ?>">
		

		<?php

		 $num_rows_keys = $num_rows_keys - 1;

		while($row_column = mysqli_fetch_array($result_column))
		{
			$contArray = 0;

			foreach ($tableColumns as &$Column)
	        { 
	        	${"SQL_" . $Column} = $row_column[$Column];  

	        	//print $contArray.'-';
	        	if($contArray == 0)
	        	{
	        		print ' <input type="hidden" name="form_'.$Column.'" id="form_'.$Column.'" value="'.${"SQL_" . $Column} .'" >';
	        	}
	        	else
	        	{
		            //print $value.' = '.${"SQL_" . $value}.'<br>';

		            if($NameColumns[$contArray] != 'Status')
	                { 

		            	$arrExplode = '';

		                for ($i = 0; $i <= $num_rows_keys; $i++)
		                {

		                    if($Column == $GLOBALS[$tableKeys[$i]['COLUMN_NAME']])
		                    {
		                        //print $Column.'<hr>';   
		                        $arrExplode = PopulaCombo($tb, $Column, $GLOBALS[$tableKeys[$i]['REFERENCED_TABLE_NAME']],  $conn);                         

		                        //print $arrExplode.' <-- <br>';                        
		                    }
		                }

		                if($arrExplode == '')
	                    {
		            ?>

		            <div class="col-md-6">
		            	<h6 class="mb15"><?php print $NameColumns[$contArray]; ?>:</h6>
			            <div class="section mb20">
			               <label for="<?php print 'form_'.$Column; ?>" class="field prepend-icon">
				                <input type="text" name="<?php print 'form_'.$Column; ?>" id="<?php print 'form_'.$Column; ?>" class="gui-input" placeholder="#" value="<?php print ${"SQL_" . $Column}; ?>" >
				                <span class="field-icon">
				                    <i class="fa fa-user"></i>
				                </span>
				            </label>
			            </div>
		        	</div>

		            <?php

		        		}
		        		else
	                    {
	                        ?>

	                        <div class="col-md-6 section mb20">
	                        	<h6 class="mb15"><?php print  $NameColumns[$contArray]; ?>:</h6>
	                            <label class="field select">
	                                <select id="<?php print 'form_'.$Column; ?>" name="<?php print 'form_'.$Column; ?>" style="height: 45px;">
	                                    <?php

	                                        $array = explode(',', trim($arrExplode));
	                                        foreach ($array as $values)
	                                        {
	                                            $arrValues = explode('|', trim($values));
	                                            $selectCampo = '';
	                                            if(${"SQL_" . $Column} == trim($arrValues[0]))
	                                            {
	                                            	$selectCampo =  'selected="selected"';
	                                            } 

	                                            print '  <option value="'.trim($arrValues[0]).'" '.$selectCampo.' >'.trim($arrValues[1]).'</option> ';
	                                        }
	                                    ?>                                
	                                </select>
	                                <i class="arrow double"></i>
	                            </label>
	                        </div>
	                    
	                        <?php  
	                    }
		        	}
		        }

				$contArray += 1;

	        }
		}
        ?>

        <div class="col-md-12 section clr pb10" style="margin-bottom: 0px;">

               <div class="col-md-6">
               		<button class="btn btn-dark pull-right ph30" type="button" data-dismiss="modal" style="height: 30px; padding-bottom: 25px;">Fechar</button>                    
                </div>

                <div class="col-md-6">
                    <button class="btn btn-warning pull-left ph30" type="submit" style="height: 30px;  padding-bottom: 25px;" >Salvar</button>
                </div>
            </div>

 
        </form>

    </div>
</div>

