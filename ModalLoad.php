<div class="container">  
  <div class="modal fade" id="ModalLoad" role="dialog">
    <div class="modal-dialog">
    
      <div class="modal-content" style="background: transparent; border: 0px; box-shadow: none; margin-top: 50%;" >
        
        <button id="closeLoad" type="button" data-dismiss="modal" style="display: none">&times;</button>  

        <div class="modal-body" style="text-align: center; font-size: 16px;">
        <?php print $loadimage; ?>          
        </div>

      </div>
      
    </div>
  </div>  
</div>


<button id="btnLoadd" type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#ModalLoad" style="display: none">LOADDD</button>

<script type="text/javascript">
  function ModalLoad()
  {
    document.getElementById('btnLoadd').click();
  }

  function closeLoad()
  {
    document.getElementById('closeLoad').click();
    
    //$("html, body").animate({ scrollTop: 0 }, "fast");    
  }
</script>
