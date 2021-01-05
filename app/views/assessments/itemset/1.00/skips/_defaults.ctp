<script type="text/javascript">
  $(document).ready(function()  {  
    
  // defaults
  if ($('#B0100').val() == 0) {
    $('.B0100-SKIP').show();
    $('.section-c').show();
    $('.section-d').show();
    $('.section-e').show();
    $('.section-f').show();
    $('#section-c').show();
    $('#section-d').show();
    $('#section-e').show();
    $('#section-f').show();
  } 
  else {
    $('.B0100-SKIP').hide();
    $('.section-c').hide();
    $('.section-d').hide();
    $('.section-e').hide();
    $('.section-f').hide();
    $('#section-c').hide();
    $('#section-d').hide();
    $('#section-e').hide();
    $('#section-f').hide();
  }   
  // on change
  $('#B0100').change(function() 
  {
    if ($('#B0100').val() == 0) {
      $('.B0100-SKIP').show();
      $('.section-c').show();
      $('.section-d').show();
      $('.section-e').show();
      $('.section-f').show();
      $('#section-c').show();
      $('#section-d').show();
      $('#section-e').show();
      $('#section-f').show();
    } 
    else {
      $('.B0100-SKIP').hide();
      $('.section-c').hide();
      $('.section-d').hide();
      $('.section-e').hide();
      $('.section-f').hide();
      $('#section-c').hide();
      $('#section-d').hide();
      $('#section-e').hide();
      $('#section-f').hide();
    } 
  })
    
  })
</script>