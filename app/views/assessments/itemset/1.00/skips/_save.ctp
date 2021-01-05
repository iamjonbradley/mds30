	<script type="text/javascript" charset="utf-8">
  	$(document).ready(function() {  
      $('.lookup_idc9').popupWindow({ 
        centerScreen:1,
        scrollbars: 1
      }); 
  	  /* Set section information */
      var section = '';
      var id = '';
		 
		  $('a').click(function () { 
		    var values = {};
        $.each($('#addAssessment').serializeArray(), function(i, field) {
          values[field.name] = field.value;
        });
        $.post("/assessments/ajaxSave/<?php echo $section; ?>/<?php echo $id; ?>", values,
        function(data){
          
        });
		  })
		});
	</script>