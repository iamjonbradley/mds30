<script type="text/javascript">
  $(document).ready(function()  {  
    $('.V0100-SKIP').hide();
    if (     $('#A0310E').val() == '0' &&  $('#A0310A').val() == '01') { $('.V0100-SKIP').hide(); }
    else if ($('#A0310E').val() == '0' &&  $('#A0310A').val() == '02') { $('.V0100-SKIP').show(); }
    else if ($('#A0310E').val() == '0' &&  $('#A0310A').val() == '03') { $('.V0100-SKIP').show(); }
    else if ($('#A0310E').val() == '0' &&  $('#A0310A').val() == '04') { $('.V0100-SKIP').show(); }
    else if ($('#A0310E').val() == '0' &&  $('#A0310A').val() == '05') { $('.V0100-SKIP').show(); }
    else if ($('#A0310E').val() == '0' &&  $('#A0310A').val() == '06') { $('.V0100-SKIP').show(); }
    else if ($('#A0310B').val() == '0' &&  $('#A0310B').val() == '01') { $('.V0100-SKIP').show(); }
    else if ($('#A0310B').val() == '0' &&  $('#A0310B').val() == '02') { $('.V0100-SKIP').show(); }
    else if ($('#A0310B').val() == '0' &&  $('#A0310B').val() == '03') { $('.V0100-SKIP').show(); }
    else if ($('#A0310B').val() == '0' &&  $('#A0310B').val() == '04') { $('.V0100-SKIP').show(); }
    else if ($('#A0310B').val() == '0' &&  $('#A0310B').val() == '05') { $('.V0100-SKIP').show(); }
    else if ($('#A0310B').val() == '0' &&  $('#A0310B').val() == '06') { $('.V0100-SKIP').show(); }
    else {   $('.V0100-SKIP').hide(); }
    
  })
</script>