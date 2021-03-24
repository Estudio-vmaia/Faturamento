
<?php

include('config.php');

include('conn_db.php');

    function CountLinhas($tb, $campo, $dado, $conn)
    {
        $busca_detalhes = "select * from ".$tb." where ".$campo." = '".$dado."'";
        //print $busca_detalhes;

        $result_detalhes = mysqli_query($conn, $busca_detalhes) or die ("Erro 0x00110-SQLShowTables - ".mysqli_error($conn)); 

        $cont_rows_detalhes = mysqli_num_rows($result_detalhes);    

        //print $cont_rows_detalhes;
        return $cont_rows_detalhes;
    }


?>

<div class="row mb10">    

    <div class="col-sm-4 col-md-3">
        <div class="bs-component">
            <div class="panel panel-tile text-primary br-b bw5 br-primary-light" style="color:#f00">
                <div class="panel-body pl20 p5">
                    <i class="fa fa-users icon-bg" style="font-size: 70px"></i>

                    <h2 class="mt15 lh15">
                        <b><?php print CountLinhas('TB_Clientes', 'Status', '1', $conn); ?></b>
                    </h2>
                    <h5 class="text-muted">
                        <?php 
                        if(CountLinhas('TB_Clientes', 'Status', '1', $conn) > 1)
                        {
                            print 'Clientes';
                        }
                        else
                        {
                            print 'Cliente';
                        }
                        ?>
                    </h5>
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-4 col-md-3">
        <div class="bs-component">
            <div class="panel panel-tile text-primary br-b bw5 br-primary-light">
                <div class="panel-body pl20 p5">
                    <i class="fa fa-sitemap icon-bg" style="font-size: 70px"></i>

                    <h2 class="mt15 lh15">
                        <b><?php print CountLinhas('TB_Colaboradores', 'Status', '1', $conn); ?></b>
                    </h2>
                    <h5 class="text-muted">
                        <?php 
                        if(CountLinhas('TB_Colaboradores', 'Status', '1', $conn) > 1)
                        {
                            print 'Colaboradores';
                        }
                        else
                        {
                            print 'Colaborador';
                        }
                        ?>
                    </h5>
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-4 col-md-3">
        <div class="bs-component">
            <div class="panel panel-tile text-primary br-b bw5 br-primary-light">
                <div class="panel-body pl20 p5">
                    <i class="fa fa-desktop icon-bg" style="font-size: 70px"></i>

                    <h2 class="mt15 lh15">
                        <b><?php print CountLinhas('TB_Projetos', 'Status', '1', $conn); ?></b>
                    </h2>
                    <h5 class="text-muted">
                        <?php 
                        if(CountLinhas('TB_Projetos', 'Status', '1', $conn) > 1)
                        {
                            print 'Projetos';
                        }
                        else
                        {
                            print 'Projeto';
                        }
                        ?>
                    </h5>
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-4 col-md-3">
        <div class="bs-component">
            <div class="panel panel-tile text-primary br-b bw5 br-primary-light">
                <div class="panel-body pl20 p5">
                    <i class="fa fa-wrench icon-bg" style="font-size: 70px"></i>

                    <h2 class="mt15 lh15">
                        <b><?php print CountLinhas('TB_Ferramentas', 'Status', '1', $conn); ?></b>
                    </h2>
                    <h5 class="text-muted">
                        <?php 
                        if(CountLinhas('TB_Ferramentas', 'Status', '1', $conn) > 1)
                        {
                            print 'Ferramentas';
                        }
                        else
                        {
                            print 'Ferramenta';
                        }
                        ?>
                    </h5>
                </div>
            </div>
        </div>
    </div>
    
</div>