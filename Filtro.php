<?php

$tb = @$_GET['tb'];

include('config.php');

include('conn_db.php');

include('BuscaKeys.php');

include('Functions.php');

    $busca_table = "SHOW FULL COLUMNS FROM ".$tb;

    $result_table = mysqli_query($conn, $busca_table) or die ("Erro 0x00110-SQLShowTables - ".mysqli_error($conn)); 

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

        if($SQL_Comment != '')
        {
            
            if($cont_rows_table == 0)
            {
                $titleFiltro = $SQL_Comment;                                   
            }
            
            
            if($cont_rows_table > 0)
            {
                $QryCampos .= $SQL_Field.', ';

                array_push($NameColumns, $SQL_Comment);
                array_push($tableColumns, $SQL_Field);
            }
        }

        $cont_rows_table += 1;     
    }




?> 

<!-- Column Left -->
    <div class="chute-icon"></div>
    <div class="scroller-chute scroller-primary chute-fh-xs mrn">
        <div class="allcp-form theme-primary">


            <!-- <form name="Filtro" id="Filtro" method="post" action="Listagem.php?tb=<?php print $tb; ?>" onSubmit="return SendForm(this.id);"> -->
            <form name="FormFiltro" id="FormFiltro" method="post" action="Listagem.php?tb=<?php print $tb; ?>" onSubmit="return validateForm(this.id);">

            <center>
                <h5 class="pln">- Filtro <?php print $titleFiltro; ?> -</h5>
            </center>

            <?php

            $contArray = 0;
            $num_rows_keys = $num_rows_keys - 1;
            //print $num_rows_keys.'<br>';

            $camposForm = '';

            foreach ($tableColumns as &$Column)
            {

            
                print ' <h6 class="mb15"> '.$NameColumns[$contArray]. '</h6> ';

                if($NameColumns[$contArray] == 'Status')
                { ?>
                     <div class="section mb20">
                            <label class="field select">
                                <select id="<?php print 'form_'.$Column; ?>" name="<?php print 'form_'.$Column; ?>">
                                    <option value="" selected="selected">Selecione</option>
                                    <option value="1">Ativo</option>
                                    <option value="0">Inativo</option>
                                </select>
                                <i class="arrow double"></i>
                            </label>
                        </div>
                <?php
                }
                else
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
                        <div class="section mb20">
                            <label for="customer-id" class="field prepend-icon">
                                <input type="text" name="<?php print 'form_'.$Column; ?>" id="<?php print 'form_'.$Column; ?>" class="gui-input" placeholder="#">
                                <span class="field-icon">
                                    <i class="fa fa-user"></i>
                                </span>
                            </label>
                        </div>
                        <?php                
                    }else
                    {
                        ?>
                        <div class="section mb20">
                            <label class="field select">
                                <select id="<?php print 'form_'.$Column; ?>" name="<?php print 'form_'.$Column; ?>">
                                    <option value="" selected="selected">Selecione</option>
                                    <?php

                                        $array = explode(',', trim($arrExplode));
                                        foreach ($array as $values)
                                        {
                                            $arrValues = explode('|', trim($values));
                                            print '  <option value="'.trim($arrValues[0]).'">'.trim($arrValues[1]).'</option> ';
                                        }
                                    ?>                                
                                </select>
                                <i class="arrow double"></i>
                            </label>
                        </div>
                        <?php  
                    }

                   

                    $contArray += 1;
                }

                 $camposForm .= '"form_'.$Column.'", ';
            }

            $camposForm = substr($camposForm, 0, -2); 
            ?>

          
            <hr class="short">

            <div class="section clr pb30">

               <div class="col-md-6">
                    <button class="btn btn-dark pull-left ph30" type="button" onclick="FormReset('FormFiltro')" >Limpar</button>
                </div>

                <div class="col-md-6">
                    <button class="btn btn-primary pull-right ph30" type="submit" >Filtrar</button>
                </div>
                <div class="col-md-12" style="margin-top: 10px;" >                    
                    <button class="btn btn-warning" type="button" style="width: 100%" onclick="AlertBox('insira algo porra')">Cadastrar</button>                
                </div>
            </div>

        </form>



        </div>
    </div>
<!-- /Column Left -->

<script type="text/javascript">

function validateForm(form)
{
    
    var campoVazio = 0;
    //var fields = ["name, phone", "compname", "mail", "compphone", "adres", "zip"];
    var fields = [<?php print $camposForm; ?>];    

    var qtdCampos = fields.length;

    //console.log(qtdCampos);

    var i, l = fields.length;
    var fieldname;
    for (i = 0; i < l; i++)
    {
        fieldname = fields[i];
        if (document.forms[form][fieldname].value === "")
        {
            campoVazio += 1;
            //alert(fieldname + " can not be empty");            
        }        
        //console.log('campoVazio = '+campoVazio);
    }

    if (campoVazio == qtdCampos)
    {
        AlertBox('Preencha ou Selecione algum campo antes de aplicar o Filtro!');
        campoVazio = '';
    }
    else
    {
        SendForm(form, 'listagem');
        //return true;
    }

    return false;
}

</script>