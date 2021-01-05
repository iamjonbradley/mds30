<script type="text/javascript">
  $(document).ready(function()  { 
    
    // defaults
    if ($('#Q0400A').val() == 1) $('.Q0400-SKIP').hide();
    else  $('.Q0400-SKIP').show();
    // on change
    $('#Q0400A').change(function() 
    {
      if ($('#Q0400A').val() == 1) $('.Q0400-SKIP').hide();
      else  $('.Q0400-SKIP').show();
    })
    
    // defaults
    if ($('#Q0400B').val() == 2) $('.Q0500-SKIP').hide();
    else  $('.Q0500-SKIP').show();
    // on change
    $('#Q0400B').change(function() 
    {
      if ($('#Q0400B').val() == 2) $('.Q0500-SKIP').hide();
      else  $('.Q0500-SKIP').show();
    })
    
    if ($('#SectionQQ0500A').val() == 2) $('.Q0500B').hide();
    else $('.Q0500B').show();
    $('#SectionQQ0500A').change(function() {
      if ($('#SectionQQ0500A').val() == 2) $('.Q0500B').hide();
      else $('.Q0500B').show();
    })
    
    // defaults
    if ($('#A0310E').val() == 1) { $('.Q0300-SKIP').show(); }
    else { $('.Q0300-SKIP').hide(); }
    // on change
    
    if ($('#Q0400B').val() == 1) { $('.Q0500').hide(); $('.Q0500A').hide(); $('.Q0500B').hide(); }
    else { $('.Q0500').show(); $('.Q0500A').show(); $('.Q0500B').show(); }
    $('#Q0500').change(function() {
      if ($('#Q0500').val() == 1) { $('.Q0500').hide(); $('.Q0500A').hide(); $('.Q0500B').hide(); }
      else { $('.Q0500').show(); $('.Q0500A').show(); $('.Q0500B').show(); }
    })
  
    
  }); 
</script>