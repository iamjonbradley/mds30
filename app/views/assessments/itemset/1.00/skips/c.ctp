<script type="text/javascript">
  <?php 
  $type = $this->AssessmentType->short($this->data);
  if ($type == 'ND') { 
  ?>
  $(document).ready(function()  {  
    // defaults
    if ($('#C0100').val() == 1) { 
      $('.C0100-SKIP').show();
      $('.C0600-SKIP').hide();
      var select = $("#C0600");
      select[0].selectedIndex = 2;
    }
    else if ($('#C0100').val() == '-') { 
      $('.C0100-SKIP').hide();
      $('.C0600-SKIP').show();
      var select = $("#C0600");
      select[0].selectedIndex = 2;
    }
    else { 
      $('.C0100-SKIP').hide();
      $('.C0600-SKIP').show();
      var select = $("#C0600");
      select[0].selectedIndex = 3;
    }
    // on change
    $('#C0100').change(function() 
    {
      if ($('#C0100').val() == 1) { 
        $('.C0100-SKIP').show();
        $('.C0600-SKIP').hide();
        var select = $("#C0600");
        select[0].selectedIndex = 2;
      }
      else if ($('#C0100').val() == '-') { 
        $('.C0100-SKIP').hide();
        $('.C0600-SKIP').show();
        var select = $("#C0600");
        select[0].selectedIndex = 2;
      }
      else { 
        $('.C0100-SKIP').hide();
        $('.C0600-SKIP').show();
        var select = $("#C0600");
        select[0].selectedIndex = 3;
      }
    })
    
    if ($('#SectionCC0500').val() == '99') { var select = $("#C0600"); select[0].selectedIndex = 3; $('.C0600-SKIP').show(); }
    else if ($('#SectionCC0500').val() == '-') { var select = $("#C0600"); select[0].selectedIndex = 3; $('.C0600-SKIP').show(); }
    else if ($('#SectionCC0500').val() == '--') { var select = $("#C0600"); select[0].selectedIndex = 3; $('.C0600-SKIP').show(); }
    else { select = $("#C0600"); select[0].selectedIndex = 2;  $('.C0600-SKIP').hide(); console.log(1); $('.C0600-SKIP').hide(); }
    $('#SectionCC0500').keyup(function () {
      if ($('#SectionCC0500').val() == '99') { var select = $("#C0600"); select[0].selectedIndex = 3; $('.C0600-SKIP').show(); }
      else if ($('#SectionCC0500').val() == '-') { var select = $("#C0600"); select[0].selectedIndex = 3; $('.C0600-SKIP').show(); }
      else if ($('#SectionCC0500').val() == '--') { var select = $("#C0600"); select[0].selectedIndex = 3; $('.C0600-SKIP').show(); }
      else { var select = $("#C0600"); select[0].selectedIndex = 2; $('.C0600-SKIP').hide(); }
    })
  <?php } else { ?>
    $(document).ready(function()  {  
    // defaults
    if ($('#C0100').val() == 1) { 
      $('.C0100-SKIP').show();
      $('.C0600-SKIP').hide();
      var select = $("#C0600");
      select[0].selectedIndex = 1;
    }
    else { 
      $('.C0100-SKIP').hide();
      $('.C0600-SKIP').show();
      var select = $("#C0600");
      select[0].selectedIndex = 2;
    }
    // on change
    $('#C0100').change(function() 
    {
      // defaults
      if ($('#C0100').val() == 1) { 
        $('.C0100-SKIP').show();
        $('.C0600-SKIP').hide();
        var select = $("#C0600");
        select[0].selectedIndex = 1;
      }
      else { 
        $('.C0100-SKIP').hide();
        $('.C0600-SKIP').show();
        var select = $("#C0600");
        select[0].selectedIndex = 2;
      }
    })
    
    if($('#SectionCC0500').val() == '99') {
      var select = $("#C0600");
      select[0].selectedIndex = 2;
      $('.C0600-SKIP').show();
    }
    else {
      var select = $("#C0600");
      select[0].selectedIndex = 1;
      $('.C0600-SKIP').hide();
    }
    $('#SectionCC0500').keyup(function () {
      if($('#SectionCC0500').val() == '99') {
        var select = $("#C0600");
        select[0].selectedIndex = 2;
        $('.C0100-SKIP').show();
        $('.C0600-SKIP').show();
      }
      else {
        var select = $("#C0600");
        select[0].selectedIndex = 1;
        $('.C0100-SKIP').show();
        $('.C0600-SKIP').hide();
      }
    })
    
  <?php } ?>
   
    $('.cCalc').change(function() {
      var foo = 0;
      $('.cCalc :selected').each(function(i, selected){
        if ($(selected).val() != 0)
          foo += parseInt($(selected).val()); 
      });
      $('#SectionCC0500').val(foo);
    })
    
    // defaults
    if ($('#C0600').val() == 1 || $('#C0100').val() == 0|| $('#C0100').val() == '-') $('.C0600-SKIP').show();
    else if ($('#C0600').val() == '-') $('.C0600-SKIP').show();
    else  $('.C0600-SKIP').hide();
    // on change
    $('#C0600').change(function() 
    {
      if ($('#C0600').val() == 1 || $('#C0100').val() == 0) $('.C0600-SKIP').show();
      else if ($('#C0600').val() == '-') $('.C0600-SKIP').show();
      else  $('.C0600-SKIP').hide();
    })
  }); 
</script>