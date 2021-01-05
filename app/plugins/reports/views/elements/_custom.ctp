<script type="text/javascript">
  $(document).ready(function()  {  
    
    if ($('#CheckedARD').is(':checked')) { $('.ARD-DATES').show(); }
    else $('.ARD-DATES').hide();
    $('#CheckedARD').click(function () {
      if ($('#CheckedARD').is(':checked')) { $('.ARD-DATES').show(); }
      else $('.ARD-DATES').hide();
    })
    
    if ($('#CheckedLOCK').is(':checked')) { $('.LOCK-DATES').show(); }
    else $('.LOCK-DATES').hide();
    $('#CheckedLOCK').click(function () {
      if ($('#CheckedLOCK').is(':checked')) { $('.LOCK-DATES').show(); }
      else $('.LOCK-DATES').hide();
    })
    
    if ($('#CheckedATYPE').is(':checked')) { $('.ATYPE').show(); }
    else $('.ATYPE').hide();
    $('#CheckedATYPE').click(function () {
      if ($('#CheckedATYPE').is(':checked')) { $('.ATYPE').show(); }
      else $('.ATYPE').hide();
    })
    
    if ($('#CheckedRTYPE').is(':checked')) { $('.RTYPE').show(); }
    else $('.RTYPE').hide();
    $('#CheckedRTYPE').click(function () {
      if ($('#CheckedRTYPE').is(':checked')) { $('.RTYPE').show(); }
      else $('.RTYPE').hide();
    })
    
  })
</script>