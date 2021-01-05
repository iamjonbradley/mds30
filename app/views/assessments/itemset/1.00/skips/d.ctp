<script type="text/javascript">
  $(document).ready(function()  { 
    
  
    // defaults
    if ($('#D0200I1').val() == 1) $('.D0350').show();
    else  $('.D0350').hide();
    // on change
    $('#D0200I1').change(function() 
    {
      if ($('#D0200I1').val() == 1) $('.D0350').show();
      else  $('.D0350').hide();
    })
    
    // defaults
    if ($('#D0500I1').val() == 1) $('.D0650').show();
    else  $('.D0650').hide();
    // on change
    $('#D0500I1').change(function() 
    {
      if ($('#D0500I1').val() == 1) $('.D0650').show();
      else  $('.D0650').hide();
    })
    
    $('#SectionDD0200A1').change(function () {
      if ($('#SectionDD0200A1').val() == 0) { 
        var select = $("#SectionDD0200A2"); select[0].selectedIndex = 1; 
      }
    })
    
    $('#SectionDD0200B1').change(function () {
      if ($('#SectionDD0200B1').val() == 0) { 
        var select = $("#SectionDD0200B2"); select[0].selectedIndex = 1; 
      }
    })
    
    $('#SectionDD0200C1').change(function () {
      if ($('#SectionDD0200C1').val() == 0) { 
        var select = $("#SectionDD0200C2"); select[0].selectedIndex = 1; 
      }
    })
    
    $('#SectionDD0200D1').change(function () {
      if ($('#SectionDD0200D1').val() == 0) { 
        var select = $("#SectionDD0200D2"); select[0].selectedIndex = 1; 
      }
    })
    
    $('#SectionDD0200E1').change(function () {
      if ($('#SectionDD0200E1').val() == 0) { 
        var select = $("#SectionDD0200E2"); select[0].selectedIndex = 1; 
      }
    })
    
    $('#SectionDD0200F1').change(function () {
      if ($('#SectionDD0200F1').val() == 0) { 
        var select = $("#SectionDD0200F2"); select[0].selectedIndex = 1; 
      }
    })
    
    $('#SectionDD0200G1').change(function () {
      if ($('#SectionDD0200G1').val() == 0) { 
        var select = $("#SectionDD0200G2"); select[0].selectedIndex = 1; 
      }
    })
    
    $('#SectionDD0200H1').change(function () {
      if ($('#SectionDD0200H1').val() == 0) { 
        var select = $("#SectionDD0200H2"); select[0].selectedIndex = 1; 
      }
    })
    
    $('#D0200I1').change(function () {
      if ($('#D0200I1').val() == 0) { 
        var select = $("#SectionDD0200I2"); select[0].selectedIndex = i; 
      }
    })
    $('.column2').change(function() {
      var foo = 0;
      $('.column2 :selected').each(function(i, selected){
        if ($(selected).val() != 0)
          foo += parseInt($(selected).val()); 
      });
      $('#SectionDD0300').val(foo);
    })
     
    $('.column2B').change(function() {
      var foo = 0;
      $('.column2B :selected').each(function(i, selected){
        if ($(selected).val() != 0) {
          foo += parseInt($(selected).val());
        }
      });
      $('#SectionDD0600').val(foo);
    })
    
    
    // defaults
    if ($('#D0100').val() == 1) {
      $('.D0100-SKIP').show();
      var select = $("#C0600");
      select.selectedIndex = 2;
    } 
    else {
      $('.D0100-SKIP').hide();
      var select = $("#C0600");
      select.selectedIndex = 1; 
    }  
    // on change
    $('#D0100').change(function() 
    {
      if ($('#D0100').val() == 1) {
        $('.D0100-SKIP').show();
        var select = $("#C0600");
        select.selectedIndex = 2;
      } 
      else {
        $('.D0100-SKIP').hide();
        var select = $("#C0600");
        select.selectedIndex = 1;  
      }  
    }) 
    if ($('#SectionDD0300').val() == 99) { $('.D0500-SKIP').show(); }
    else if ($('#SectionDD0300').val() == '-') $('.D0500-SKIP').show();
    else if ($('#D0100').val() == '0') $('.D0500-SKIP').show();
    else $('.D0500-SKIP').hide();
    $('#SectionDD0300').keyup(function () {
      if ($('#SectionDD0300').val() == 99) { $('.D0500-SKIP').show(); }
      else if ($('#SectionDD0300').val() == '-') $('.D0500-SKIP').show();
      else if ($('#D0100').val() == '0') $('.D0500-SKIP').show();
      else $('.D0500-SKIP').hide();
    })
    
  }); 
</script>