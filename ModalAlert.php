<div class="container">  
  <div class="modal fade" id="ModalAlert" role="dialog">
    <div class="modal-dialog">
    
      <div class="modal-content" style="margin-top: 50%; -webkit-border-radius: 10px; -moz-border-radius: 10px; border-radius: 10px; ">
        
        <button id="closeAlerta" type="button" data-dismiss="modal" style="display: none">&times;</button>  

        <div class="modal-body" style="text-align: center; font-size: 16px;" id="bodyalert">          
        </div>

      </div>
      
    </div>
  </div>  
</div>


<button id="btnAlert" type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#ModalAlert" style="display: none">Alert</button>

<script type="text/javascript">
  function AlertBox(msg)
  {
    document.getElementById('btnAlert').click();
    document.getElementById('bodyalert').innerHTML = msg;

    setTimeout(function()
    {
      document.getElementById('closeAlerta').click();
    }, 3000);

  }
</script>
