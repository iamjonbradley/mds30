<script type="text/javascript">
  $(document).ready(function()  {  
    
    // defaults
    if ($('#J0200').val() == 1) { $('.J0200-SKIP').show(); $('.J0700-SKIP').hide(); var select = $('#J0700'); select[0].selectedIndex = 1; }
  	else { $('.J0200-SKIP').hide(); $('.J0700-SKIP').show(); var select = $('#J0700'); select[0].selectedIndex = 2; }
    // on change
    $('#J0200').change(function() {
      if ($('#J0200').val() == 1) { 
        $('.J0200-SKIP').show(); $('.J0700-SKIP').hide(); 
    	  var select = $('#J0700'); select[0].selectedIndex = 1;
      }
    	else { 
    	  $('.J0200-SKIP').hide(); $('.J0700-SKIP').show(); 
    	  var select = $('#J0700'); select[0].selectedIndex = 2;
  	  }
    })

    if ($('#B0100').val() == 1) $('.B01000-SKIP').hide(); 
    if ($('#B0100').val() == 0) $('.B01000-SKIP').show(); 
    
    if ($('#J0700').val() == 1 && $('#J0200').val() == 1) { 
      $('.J0200-SKIP').show(); $('.J0700-SKIP').show(); 
    }
    if ($('#J0700').val() == 1 && $('#J0200').val() == 0) { 
      $('.J0200-SKIP').hide(); $('.J0700-SKIP').show(); 
    }
    if ($('#J0700').val() == 1 && $('#J0200').val() == 0) { 
      $('.J0200-SKIP').show(); $('.J0700-SKIP').hide(); 
    }
    $('#J0700').change(function() {
      if ($('#J0700').val() == 1 && $('#J0200').val() == 1) { 
        $('.J0200-SKIP').show(); $('.J0700-SKIP').show(); 
      }
      if ($('#J0700').val() == 1 && $('#J0200').val() == 0) { 
        $('.J0200-SKIP').hide(); $('.J0700-SKIP').show(); 
      }
      if ($('#J0700').val() == 1 && $('#J0200').val() == 0) { 
        $('.J0200-SKIP').show(); $('.J0700-SKIP').hide(); 
      }
    })
    
    
    // defaults
    if ($('#A0310A').val() == '01' || $('#A0310E').val() == 1) { $('.J1700').show();  }
    else  { $('.J1700').hide(); }
    // on change
    $('#A0310A').change(function() 
    {
      if ($('#A0310A').val() == '01' || $('#A0310E').val() == 1) $('.J1700').show();
      else  $('.J1700').hide();
    })
    
    
    // defaults
    if ($('#J1800').val() == 1) $('.J1800-SKIP').show();
    else  $('.J1800-SKIP').hide();
    // on change
    $('#J1800').change(function() 
    {
      if ($('#J1800').val() == 1) $('.J1800-SKIP').show();
      else  $('.J1800-SKIP').hide();
    })
    
    // defaults
    if ($('#J1800').val() == 1) $('.J1800-SKIP').show();
    else  $('.J1800-SKIP').hide();
    // on change
    $('#J1800').change(function() 
    {
      if ($('#J1800').val() == 1) $('.J1800-SKIP').show();
      else  $('.J1800-SKIP').hide();
    })
    
    // defaults
    if ($('#A0310A').val() == '01' || $('#A0310E').val() == 1) { $('.J1700').show();  }
    else  { $('.J1700').hide(); }
    // on change
    $('#A0310A').change(function() 
    {
      if ($('#A0310A').val() == '01' || $('#A0310E').val() == 1) $('.J1700').show();
      else  $('.J1700').hide();
    })
    
    // defaults
    if ($('#J0300').val() == '0') {  $('.J0300-SKIP').hide();  $('.J0700-SKIP').hide(); }
    else if ($('#J0300').val() == '1') { $('.J0300-SKIP').show(); $('.J0700-SKIP').hide(); }
    else if ($('#J0300').val() == '9') { $('.J0300-SKIP').hide(); $('.J0700-SKIP').show(); }
    else $('.J0300-SKIP').show(); 
    // on change
    $('#J0300').change(function() 
    {
      if ($('#J0300').val() == '0') { $('.J0300-SKIP').hide();  $('.J0700-SKIP').hide(); }
      else if ($('#J0300').val() == '1') { $('.J0300-SKIP').show(); $('.J0700-SKIP').hide(); }
      else if ($('#J0300').val() == '9') { $('.J0300-SKIP').hide(); $('.J0700-SKIP').show(); }
    	else $('.J0300-SKIP').show(); 
    })
    
    if ($('#SectionJJ0800Z').is(':checked')) { $('.J0850').hide(); }
    else $('.J0850').show();
    $('#SectionJJ0800Z').click(function () {
      if ($('#SectionJJ0800Z').is(':checked')) { $('.J0850').hide(); }
      else $('.J0850').show();
    })
    
    if ($('#J0200').val() == 0) { 
      $('.J0200-SKIP').hide(); $('.J0700-SKIP').show(); 
    }

    if ($('#J0400').val() == 9) { 
        var J0700 = $('#J0700'); J0700[0].selectedIndex = 2;
        $('.J0700-SKIP').show();
    }
    $('#J0400').change(function() {
      if ($('#J0400').val() == '9') {
        var J0700 = $('#J0700'); J0700[0].selectedIndex = 2;
        $('.J0700-SKIP').show();
      }
    })
    
  }); 
</script>