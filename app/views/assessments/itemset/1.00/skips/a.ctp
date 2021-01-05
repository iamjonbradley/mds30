<script type="text/javascript" charset="utf-8">

  $(document).ready(function() {   
    
    if ($('#A0200').val() == '1') { $('.A0310D').hide(); }
    else { $('.A0310D').show(); }
    $('#A0310A').change(function() 
    {
      if ($('#A0200').val() == '1') { $('.A0310D').hide(); }
      else { $('.A0310D').show(); }
    }) 
    
    if ($('#A0310A').val() == '05' || $('#A0310A').val() == '01') $('.A2200').show();
    else $('.A2200').hide();
    $('#A0310A').change(function() 
    {
      if ($('#A0310A').val() == '05' || $('#A0310A').val() == '01')  $('.A2200').show();
      else $('.A2200').hide();
    }) 
    
    if (($('#age').val() >= '22') && ($('#A0310A').val() == '01')) $('.A1550').show();
    else if (($('#age').val() <= '21') && (($('#A0310A').val() == '01') || ($('#A0310A').val() == '03') || ($('#A0310A').val() == '04') || ($('#A0310A').val() == '05'))) $('.A1550').show();
    else { $('.A1550').hide(); }
    $('#A0310A').change(function() 
    {
      if (($('#age').val() >= '22') && ($('#A0310A').val() == '01')) $('.A1550').show();
      else if (($('#age').val() <= '21') && (($('#A0310A').val() == '01') || ($('#A0310A').val() == '03') || ($('#A0310A').val() == '04') || ($('#A0310A').val() == '05'))) $('.A1550').show();
      else { $('.A1550').hide(); }
    }) 
  
    // defaults
    if ($('#A1100A').val() == 1) $('.A1100B').show();
    else  $('.A1100B').hide();
    // on change
    $('#A1100A').change(function() 
    {
      if ($('#A1100A').val() == 1) { 
        $('.A1100B').show();
      }
      else  $('.A1100B').hide();
    })

    // defaults
    if ($('#A0310F').val() == 10 || $('#A0310F').val() == 11 || $('#A0310F').val() == 12) {
      $('.A2000').show();
      $('.A2100').show();
    } 
    else {
      $('.A2000').hide();
      $('.A2100').hide();
    }  
    // on change
    $('#A0310F').change(function() 
    {
      if ($('#A0310F').val() == 10 || $('#A0310F').val() == 11 || $('#A0310F').val() == 12) {
        $('.A2000').show();
        $('.A2100').show();
      } 
      else {
        $('.A2000').hide();
        $('.A2100').hide();
      }  
    })

    // defaults
    if ($('#A2400A').val() == 1) {
      $('.A2400B').show();
      $('.A2400C').show();
    } 
    else {
      $('.A2400B').hide();
      $('.A2400C').hide();
    }  
    // on change
    $('#A2400A').change(function() 
    {
      if ($('#A2400A').val() == 1) {
        $('.A2400B').show();
        $('.A2400C').show();
      } 
      else {
        $('.A2400B').hide();
        $('.A2400C').hide();
      }  
    })
  }); 
</script>