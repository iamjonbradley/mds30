<?php if (in_array($this->Session->read('Auth.User.group_id'), array(9))) { ?>
	<script type="text/javascript">
		$(document).ready(function() {    
			$('input').attr("disabled", true);
			$('select').attr("disabled", true);
			$('checkbox').attr("disabled", true);
			console.log('test');
		});
	</script>
	<style type="text/css" media="screen">
		input, select {
			border: 1px solid #CCC;
			background-color: #FFF;
			color: #000;
		}
		<?php if ($section == 'caa') { ?>
			input {
				width: 150px;
			}
		<?php } ?>
	</style>
<?php } ?>