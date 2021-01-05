<script type="text/javascript" charset="utf-8">
  $(document).ready(function() {   
    
    
    
    
    if ($('#F0600').val() == 9) { var select = $("#F0700"); select[0].selectedIndex = 2; $('.F0700-SKIP').show(); }
    else { var select = $("#F0700"); select[0].selectedIndex = 1; $('.F0700-SKIP').hide(); }
    $('#F0600').change(function() 
    {
      if ($('#F0600').val() == 9) { var select = $("#F0700"); select[0].selectedIndex = 2; $('.F0700-SKIP').show(); }
      else { var select = $("#F0700"); select[0].selectedIndex = 1; $('.F0700-SKIP').hide(); }
    })
    
    // defaults
    if ($('#F0300').val() == 1) { 
      $('.F0300-SKIP').show();
      $('.F0700-SKIP').hide();
    }
    if ($('#F0300').val() == 0) { 
      $('.F0700-SKIP').show();
      $('.F0300-SKIP').hide(); 
    }
    // on change
    $('#F0300').change(function() 
    {
      if ($('#F0300').val() == 1) { 
        $('.F0300-SKIP').show();
        $('.F0700-SKIP').hide();
      }
      if ($('#F0300').val() == 0) { 
        $('.F0700-SKIP').show();
        $('.F0300-SKIP').hide(); 
      }
    })
    
      if ($('#F0700').val() == 1) { 
        $('.F0700-SKIP').show();
      }
  }); 
</script>