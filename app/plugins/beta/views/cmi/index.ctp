<table width="100%">
  <tr>
    <td valign="top" class="left-column" valign="top">
      <!-- begin menus -->
      <ul class="left-nav">
        <li class="menu">Sort by Date</li>
        <li>
          <?php
          echo $this->Form->create('Report', array('url' => '/beta/cmi/view', 'type' => 'get'));
          echo $this->Form->input('facility_id', array('options' => $cmi_facs));
          echo $this->Form->input('start', array('label' => 'Start Date', 'type' => 'date', 'format' => 'm-d-Y', 'monthNames' => false));
          echo $this->Form->input('end', array('label' => 'End Date', 'type' => 'date', 'format' => 'm-d-Y', 'monthNames' => false));
          echo $this->Form->submit('Filter');
          echo $this->Form->end();
          ?>
        </li>
      </ul>
    </td>
    <td valign="top" valign="top">
    	<h2>CMI Report</h2>
    </td>
    
  </tr>
</table>