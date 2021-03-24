<script type="text/javascript">

    window.onload = function() {
      //loadFiltro('<?php print $tabRefencia; ?>');
      //loadPagina('<?php print $tabRefencia; ?>');    
      loadUnicPage('home.php', 'ContentCentral');    
      ModalLoad();                  
    }


    function loadPage(tabeladb, idMenu)
    {
        loadFiltro(tabeladb);
        //loadPagina(tabeladb);

        for (var i = 0; i < <?php print $contMenu; ?>; i++) {
           document.getElementById('menu_'+i).classList.remove("active");                           
        }
      
        var element = document.getElementById(idMenu);
        element.classList.add("active");                            
        //element.classList.remove("mystyle");    
    }

    function loadFiltro(tabeladb)
    {
      $('#ContentCentral').html('<?php print $conteudoDividido; ?>'); 

      $('#listagem').html(''); 

      //$('#filtro').html('<?php print $loadimage; ?>'); 
      ModalLoad();
      $.ajax({
        url: "Filtro.php?tb="+tabeladb
      }).done(function(data) { // 
        $('#filtro').html(data);
        closeLoad();
      });
    }

    function loadPagina(tabeladb)
    {
      console.log('chama listagem');
      //$('#listagem').html('<?php print $loadimage; ?>'); 
      ModalLoad();
      //$('#'+localExec).html('<?php print $loadimage; ?>'); 
      $.ajax({
        url: "Listagem.php?tb="+tabeladb
      }).done(function(data) { // 
        $('#listagem').html(data);
        closeLoad();
        //$('#'+localExec).html(data);
      });
    }

    function loadUnicPage(page, localExec)
    {
      if(localExec == 'filtro')
      {
        $('#ContentCentral').html('<?php print $conteudoDividido; ?>'); 
      }
      //$('#listagem').html('<?php print $loadimage; ?>'); 
      //$('#'+localExec).html('<?php print $loadimage; ?>'); 
      ModalLoad();
      $.ajax({
        url: page
      }).done(function(data) { // 
        //$('#listagem').html(data);
        $('#'+localExec).html(data);
        closeLoad();
      });
    }


    function SendForm(form, localExec)
    {
        formAction = $('#'+form).attr('action');           
        console.log('Envia form -> '+form+' -> '+formAction);
                     
        $.ajax({
            type: 'POST',
            url: formAction,
            data: $('#'+form).serialize(), 
            beforeSend: function() {                                
                //$('#'+localExec).html('<?php print $loadimage; ?>');   
                //$('#ContentCentral').html('<?php print $loadimage; ?>');   
                ModalLoad();
            },
            success: function (data) {
                console.log('form Carregado');
                $('#'+localExec).html(data);

                document.getElementById('BtnCloseModalCRUD').click();
                
                //$('#listagem').html(data);
            },
            complete: function (data) {
                closeLoad();
            }
        });

        return false;
    }


    function FormReset(form)
    {
        $('#listagem').html(''); 
        document.getElementById(form).reset();
    }

    function openCRUD($tb, $id)
    {
      
      console.log($tb+' - '+$id);
      $("body").addClass("modal-open");

      $.ajax({
      url: 'CRUD.php?tb='+$tb+'&id='+$id
      }).done(function(data) { // 
        //$('#listagem').html(data);
        $('#ModalCRUDContent').html(data);
        //$("body").removeClass("modal-open");
        closeLoad();
      });

      document.getElementById('BtnModalCRUD').click();

    }


    function anchorTop()
    {
      $("html, body").animate({ scrollTop: 0 }, "fast");
      //window.location.href = "#main";
      //$(window).scrollTop(0);
      console.log('scroll')
    }


</script>