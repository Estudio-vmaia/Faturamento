<?php

$tb = @$_GET['tb'];

include('config.php');

include('conn_db.php');

//print $tb;



?>

<script>
$(document).ready(function(){
  $("#CampoFiltro").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#TableResulteListagem tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});
</script>




<!-- Table -->
<div class="panel mbn" >
  
    <div class="panel-body pn " > 
        <div class="table-responsive " id="DivTableListagem" style="overflow-x: hidden; overflow-y: auto; margin-top: -50px;">


            <div class="allcp-form theme-primary">
                <br>
                <div class="section mb20">
                    <label for="customer-id" class="field prepend-icon">
                        <input id="CampoFiltro" type="text" placeholder="Filtrar resultado..." class="gui-input">
                        <span class="field-icon">
                            <i class="fa fa-filter"></i>
                        </span>
                    </label>
                </div>
            </div>

            <table class="table allcp-form theme-warning tc-checkbox-1 btn-gradient-grey fs13" style="height: 100%"  >
                <thead>
                <tr class="">

                    <?php

                    $busca_table = "SHOW FULL COLUMNS FROM ".$tb;

                    $result_table = mysqli_query($conn, $busca_table) or die ("Erro 0x00110-SQLShowTables - ".mysqli_error($conn)); 

                    $cont_rows_table = 0;

                    $tableColumns = array();

                    $QryCampos = '';

                    $QryWhere = '';

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

                        //print $SQL_Field.'<br>';

                        if ( isset($_POST['form_'.$SQL_Field]))
                        {
                            if($_POST['form_'.$SQL_Field] != '')
                            {                                
                                ${"form_" . $SQL_Field} = @$_POST['form_'.$SQL_Field];
                                $QryWhere .= $SQL_Field." like '%".${"form_" . $SQL_Field}."%' and ";
                                //print $SQL_Field.' -> '.${"form_" . $SQL_Field}.'<br>';
                            }
                        }
                        
                        
                        

                        if($SQL_Comment != '')
                        {
                            if($cont_rows_table == 0)
                            {
                                $SQL_Comment = 'ID';                                   
                            }
                            print ' <th class="text-center">'.$SQL_Comment.'</th> ';                            

                            $QryCampos .= $SQL_Field.', ';

                            array_push($tableColumns, $SQL_Field);
                        }

                        $cont_rows_table += 1;     
                    }

                    print ' <th class="text-center">Ação</th> ';

                    ?>

                </tr>
                </thead>
                <tbody id="TableResulteListagem">

                <?php

                //print_r($tableColumns);

                $QryWhere = substr($QryWhere, 0, -4); 
                if($QryWhere != '')
                {
                    $QryWhere = ' WHERE '.$QryWhere;
                }
                //print $QryWhere.'<br>';

                $QryCampos = substr($QryCampos, 0, -2);                
                $busca_column = "select ".$QryCampos." from ".$tb.$QryWhere;

                //print $busca_column;
                
                $result_column = mysqli_query($conn, $busca_column) or die ("Erro 0x00110-SQLShowColumn - ".mysqli_error($conn)); 

                $conCloumns = 0;

                include('BuscaKeys.php');

                $campoText = '';

                while($row_column = mysqli_fetch_array($result_column))
                {
                    print ' <tr> ';
                    foreach ($tableColumns as &$value)
                    {
                        $SQL_Field = $row_table['Field'];

                        ${"SQL_" . $value} = $row_column[$value];   

                        if(compareKey($value, $row_column[$value], $tableKeys, $conn) != '')
                        {
                            $campoText = $GLOBALS['valueKeySql'];
                        }
                        else
                        {
                            $campoText = ${"SQL_" . $value};
                        }

                            $limiteChr = 25;
                            if(strlen($campoText) > $limiteChr)
                            {
                                $campoText = substr($campoText, 0, $limiteChr).'...';
                            }

                        if($value == 'Status')
                        {
                            if(${"SQL_" . $value} == 1)
                            {
                                $checkd = 'checked';
                            }
                            else
                            {
                                 $checkd = '';
                            }

                            //print ${"SQL_" . $tableColumns[0]};
                        ?>       
                        <td class="text-right" style="text-align: center; width: 80px;" >
                            <div class="flipswitch switch-info-light switch-inline text-left" >
                                <input type="checkbox" name="flipswitch" class="flipswitch-cb" id="fs<?php print $conCloumns; ?>"  onclick="changeStatus('<?php print  ${"SQL_" . $tableColumns[0]}."','".$tableColumns[0]; ?>');"  <?php print $checkd; ?> >
                                <label class="flipswitch-label" for="fs<?php print $conCloumns; ?>">
                                    <div class="flipswitch-inner"></div>
                                    <div class="flipswitch-switch"></div>
                                </label>
                            </div>
                        </td>                
                        <?php

                        }
                        else
                        {
                            //print ' <td class="hidden-xs" style="text-align: center;">'.${"SQL_" . $value}.'</td> ';
                            print ' <td class="hidden-xs" style="text-align: center;">'.$campoText.'</td> ';

                        }

                         $conCloumns += 1;

                    }
                    ?>
                     <td class="text-right" style="width: 80px;margin-top: 0px;  text-align: center;" >
                        <span class="panel-controls" style="margin: 0px; padding: 0px;">

                            <a href="javascript:void(0)" class="panel-control-title" style="font-size: 20px"  alt="Editar" title="Editar" onclick="openCRUD('<?php print $tb; ?>', '<?php print ${"SQL_" . $tableColumns[0]} ;  ?>')"></a>
                            <a href="javascript:void(0)" class="panel-control-remove" style="font-size: 20px; margin-left: 5px;" alt="Apagar" title="Apagar"></a>
                            
                        </span>
                    </td>  
                    <?php

                    print ' </tr> ';
                }

                ?>




              
                </tbody>
            </table>
        </div>
    </div>
</div>

<script type="text/javascript">

//FormFiltro
//DivTableListagem

var elmnt = document.getElementById("FormFiltro");
console.log(elmnt.offsetHeight);

document.getElementById("DivTableListagem").style.maxHeight  = (elmnt.offsetHeight-50)+"px";

    function changeStatus(id, column)
    {
        //event.preventDefault();

        $.ajax({
              url: 'AlteraStatus.php?id='+id+'&cl='+column+'&tb=<?php print $tb?>',
              //data: $('#formURL').serialize(),
              success: function () {
                //alert('form was submitted');
                //document.getElementById('closeModal').click();  
                //document.getElementById("FormCadastro").reset();
                //loadVeiculos();
              }
          });
    }
    
</script>

