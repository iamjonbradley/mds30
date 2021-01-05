<script type="text/javascript">
  $(document).ready(function()  {  
    if ($('#day_diff').val() > 13) {
      $('.column_one').hide();
    }

	/*
    if (
	    ($('#A0310C').val() == 0 || $('#A0310C').val() == 1 || $('#A0310C').val() == 4) || 
	    ($('#A0310F').val() == '01' || $('#A0310F').val() == '10' || $('#A0310F').val() == '11' || $('#A0310F').val() == '12')
	 ) {
	 	$('.O0450').show();
	 	
	    if ($('#SectionOO0450A').val() == 0) $('.O0450A').hide();
	    else $('.O0450A').show();

		$('#SectionOO0450A').change(function() {
		    if ($('#SectionOO0450A').val() == 0) $('.O0450A').hide();
		    else $('.O0450A').show();
		
		});
	 }
	 */

    if (
	    ($('#A0310C').val() == 2 || $('#A0310C').val() == 3) && 
	    ($('#A0310F').val() == 99)
	 ) {
	 	$('.O0450').show();
	 	
	    if ($('#SectionOO0450A').val() == 0) $('.O0450A').hide();
	    else $('.O0450A').show();

		$('#SectionOO0450A').change(function() {
		    if ($('#SectionOO0450A').val() == 0) $('.O0450A').hide();
		    else $('.O0450A').show();
		
		});
	 }
	 else {


		$('.O0450').hide();
	 }

  })
</script>