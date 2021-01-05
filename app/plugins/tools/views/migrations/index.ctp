<h2>Create a Migration Export</h2>
<table width="100%">
	<tr>
		<td class="left-column" valign="top">
			<?php
			if (isset($facility_id)) {
			?>
			<ul class="left-nav">
				<li class="menu">Sort by Date</li>
				<li>
					<?php
					echo $this->Form->create('Migration', array('url' => '/tools/migrations/index/'. $facility_id, 'type' => 'get'));
					echo $this->Form->input('start', array('label' => 'Start Date', 'type' => 'date', 'format' => 'm-d-Y', 'monthNames' => false));
					echo $this->Form->input('end', array('label' => 'End Date', 'type' => 'date', 'format' => 'm-d-Y', 'monthNames' => false));
					echo $this->Form->submit('Filter');
					echo $this->Form->end();
					?>
				</li>
			</ul>
			<br />
			<?php } ?>
			<?php echo $this->element('menus/migration', array('plugin' => 'tools', 'data' => $allowed_facilities)); ?>
		</td>
		<td valign="top">
		</td>    
	</tr>  
</table>