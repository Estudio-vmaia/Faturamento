<!DOCTYPE html>
<html>

<?php

include('config.php');

include('conn_db.php');

include('head.php');

?>

<style type="text/css">
    body.modal-open {
    /*
    overflow-y: auto;
    overflow-x: hidden;
    */
    overflow: hidden;

}
</style>


<body class="sales-stats-page sb-top sb-top-lg management-tools-modals">

<!-- Body Wrap -->
<div id="main">

<?php

include('header.php');

include('menu.php');

$tabRefencia = 'TB_Clientes';

$camposForm = '';

$loadimage = '<center><img src="imgs/load3.gif" width="100px"></center>';

?>


    <!-- Main Wrapper -->
    <section id="content_wrapper" class="mb80" style="padding-top: 180px;">
            

        <section class="content_container">
            

            <!-- Content -->
            <section id="content" class="animated fadeIn pt35 pb45" style="padding: 0px !important;">

                <div id="ContentCentral" class="content-right table-layout" style="width: 100%">

                    <?php
                    $conteudoDividido = ' <aside id="filtro" class="chute chute-left chute290 chute-icon-style br5" data-chute-height="match"> ';
                    $conteudoDividido .= ' </aside> ';

                    $conteudoDividido .= ' <div id="listagem" class="chute chute-center" > ';
                    $conteudoDividido .= ' </div> ';
                    ?>
                    <!--
                    <aside id="filtro" class="chute chute-left chute290 chute-icon-style br5" data-chute-height="match">
                    </aside>

                    <div id="listagem" class="chute chute-center" >
                    </div>
                    -->

                </div>



                


<?php

    include('js.php');

    include('ModalIframe.php');

    include('ModalAlert.php'); 

    include('ModalLoad.php');

?>

            </section>
            <!-- /Content -->

                    <!-- Page Footer -->
        <footer id="content-footer" style="padding: 0 0 30px 0;">
            <div class="row">
                <div class="col-md-12 text-center">
                    <br>
                    <span class="footer-legal"><?php print date('Y').' | © '. $titulo_sistema.' | '.$cliente_vmaia; ?></span>
                </div>
            </div>
        </footer>
        <!-- /Page Footer -->

        </section>
    </section>

<script type="text/javascript">
    
    window.addEventListener('load', function ()
    {
        console.log('Pagina carregada');
        closeLoad();
        //document.getElementById('closeLoad').click();
    })
    

</script>

</div>
<!-- /Body Wrap  -->

<?php include('jsFooter.php'); ?>

</body>

</html>



