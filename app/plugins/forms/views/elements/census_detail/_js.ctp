<script type="text/javascript">
	$(document).ready(function() {
	    // $(".inner").hide();
		$(".show_hide").show();
			
		$('.show_hide').click(function(){
			$('.' + this.id).toggle();
		});

	}); 
</script>