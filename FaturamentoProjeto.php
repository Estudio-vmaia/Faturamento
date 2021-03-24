<?php 

include('config.php'); 
include('conn_db.php'); 

if (ISSET($_REQUEST['ACT'])) {
	$ACT = $_REQUEST['ACT'];
} else {
	$ACT = "";
}


if (ISSET($_REQUEST['por'])) {
	$por = $_REQUEST['por'];
} else {
	$por = "";
}

?>

        
<div class="chute-icon"></div>
<div class="scroller-chute scroller-primary chute-fh-xs mrn">
    <div class="allcp-form theme-primary">

    	<center>
            <h5 class="pln">- Faturamento -</h5>
        </center>

		<form class="form-horizontal" name="FormFaturamento" id="FormFaturamento" method="post" action="FaturamentoProjeto.php" onSubmit="return SendForm(this.id, 'ContentCentral');">  
		<input type="hidden" name="ACT" value="S">

			

			<h6 class="mb15">Cliente:</h6>
            <div class="section mb20">
                <label class="field select">
                    <select name="Cliente">
                    	<option value="" selected="selected">Selecione</option>
                        <?php
						$qry = "Select * from TB_Clientes order by Nome";

						$SQL = mysqli_query($conn, $qry) or die ("Erro 0x008527-SQL"); 
					    while($row = mysqli_fetch_array($SQL))    {
					    ?>
							<option value="<?php echo $row['ID_Cliente'] ?>">
								<?php echo $row['Nome'] ?>
							</option>
					    <?php } ?>
                    </select>
                    <i class="arrow double"></i>
                </label>
            </div>


            <h6 class="mb15">Projeto:</h6>
            <div class="section mb20">
                <label class="field select">
                    <select name="Projeto">
                    	<option value="" selected="selected">Selecione</option>
                        <?php
						$qry = "Select * from TB_Projetos order by Nome";

						$SQL = mysqli_query($conn, $qry) or die ("Erro 0x008527-SQL"); 
					    while($row = mysqli_fetch_array($SQL))    {
					    ?>
							<option value="<?php echo $row['ID_Projeto'] ?>">
								<?php echo $row['Nome'] ?>
							</option>
					    <?php    } ?>
                    </select>
                    <i class="arrow double"></i>
                </label>
            </div>

            <h6 class="mb15">Período:</h6>
            <div class="section mb20">
                <label class="field select">
                    <select name="Periodo">
                    	<option value="" selected="selected">Selecione</option>
                        <?php
						$qry = "SELECT SUBSTR(DTHR_Inicio, 1, 7) AS Periodos FROM TB_LancamentoHoras GROUP BY SUBSTR(DTHR_Inicio, 1, 7)";

						$SQL = mysqli_query($conn, $qry) or die ("Erro 0x008527-SQL"); 
					    while($row = mysqli_fetch_array($SQL))    {
					    ?>
							<option value="<?php echo $row['Periodos'] ?>">
								<?php echo $row['Periodos'] ?>
							</option>
					    <?php    } ?>
                    </select>
                    <i class="arrow double"></i>
                </label>
            </div>


            <hr class="short">

            <div class="section clr pb30">

               <div class="col-md-6">
                    <button class="btn btn-dark pull-left ph30" type="button" onclick="FormReset('FormFaturamento')" >Limpar</button>
                </div>

                <div class="col-md-6">
                    <button class="btn btn-primary pull-right ph30" type="submit" >Filtrar</button>
                </div>
               
            </div>

		</form>

	</div>
</div>

        


<?php

if (trim($ACT) != "") { 
	
	$ID_Projeto = $_REQUEST['Projeto'];
	$Periodo 	= $_REQUEST['Periodo'];
?>


<Table width="70%">
	<tr>
		<td width="40%">
			Nome
		</td>
		<td width="10%">
			Horas  Consumidas
		</td>
		<td width="10%">
			Valor/Hora
		</td>
		<td width="10%">
			Valor Total de Horas
		</td>
		<td width="10%">
			Saldo Horas - Projeto
		</td>
		<td width="10%">
			Valor Ajuda de Custo
		</td>
		<td width="10%">
			Valor Total - Mês
		</td>
	</tr>

<?php 

$sql = "";
$sql = $sql . " SELECT ";

$sql = $sql . " P.ID_Projeto, ";
$sql = $sql . " P.Nome AS NomeProjeto,  ";
$sql = $sql . " C.ID_Colaborador,  ";
$sql = $sql . " C.Nome AS Colaborador,  ";
$sql = $sql . " SUM(HR.QTD_Hrs) AS TotalHorasColab, ";
$sql = $sql . " CO.QTD_Hrs, ";
$sql = $sql . " P.Budget AS Budget,";
$sql = $sql . " (CO.QTD_Hrs - SUM(HR.QTD_Hrs)) AS SaldoHoras, ";
$sql = $sql . " CO.VLR_HR AS ValorHora, ";
$sql = $sql . " (CO.VLR_HR * SUM(HR.QTD_Hrs)) AS ValorTotalHoras, ";
$sql = $sql . " IF(P.AjudaCusto = 'S',  ";
$sql = $sql . " (SUM(HR.VLR_AjudaCusto)),  ";
$sql = $sql . " '0')AS TotalAjudaCusto, ";
$sql = $sql . " IF(P.AjudaCusto = 'S',  ";
$sql = $sql . " (SUM(HR.VLR_AjudaCusto) + (CO.VLR_HR * SUM(HR.QTD_Hrs))), ";
$sql = $sql . " (CO.VLR_HR * SUM(HR.QTD_Hrs)))AS TotalValor ";
$sql = $sql . " FROM  ";
$sql = $sql . " 	TB_LancamentoHoras HR,  ";
$sql = $sql . " 	TB_Projetos P, ";
$sql = $sql . " 	TB_Colaboradores C, ";
$sql = $sql . " 	TB_Contratacoes CO ";
$sql = $sql . " WHERE ";
$sql = $sql . " 	CO.ID_Contratacao = HR.ID_Contratacao ";
$sql = $sql . " AND ";
$sql = $sql . " 	C.ID_COlaborador = HR.ID_Colaborador	 ";
$sql = $sql . " AND ";
$sql = $sql . " 	P.ID_projeto = " . $ID_Projeto ;
//$sql = $sql . " AND ";
//$sql = $sql . " 	SUBSTR(HR.DTHR_Inicio, 1, 7) = '" . $Periodo . "'   ";
$sql = $sql . " GROUP BY  ";
$sql = $sql . " 	P.ID_Projeto,  ";
$sql = $sql . " 	P.Nome, ";
$sql = $sql . " 	C.ID_Colaborador, ";
$sql = $sql . " 	C.Nome ";

$rs = mysqli_query($conn, $sql);

$ValorTotalProj = 0;

while($list = mysqli_fetch_array($rs))    {

	$Budget = $list['Budget'];

?>

<tr>
		<td>
			<?php echo $list['Colaborador'] ?>
		</td>
		<td>
		<?php echo $list['TotalHorasColab'] ?>
		</td>
		<td>
			<?php echo $list['ValorHora'] ?>
		</td>
		<td>
			<?php echo $list['ValorTotalHoras'] ?>
		</td>
		<td>
			<?php echo $list['SaldoHoras'] ?>
		</td>
		<td>
			<?php echo $list['TotalAjudaCusto'] ?>
		</td>
		<td>
			<?php 
			echo $list['TotalValor'];
			$ValorTotalProj = $ValorTotalProj + $list['TotalValor'];
			?>
		</td>
	</tr>

<?php    }  // IF WHILE GRID?>
</table>

<p>&nbsp;</p>
<?php
$PGasto = ($ValorTotalProj * 100) / $Budget;
$PGasto = number_format($PGasto, 2, ',', ' ');
?>

Budget: <?php echo $Budget ?>
<br>
Gasto:	<?php echo $ValorTotalProj ?> (<?php echo $PGasto ?>%)
<br>
Saldo: <?php echo $Budget - $ValorTotalProj ?>

	</td>


</tr>





<?php }    //IF ACT ?>

</div>






