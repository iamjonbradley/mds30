<table width="100%">
    <tr>
      <td class="left-column resident" valign="top">
      
      <ul class="left-nav">
        <li class="menu">Menu</li>
        <li><?php echo $this->Html->link('List Facilities', array('action' => 'index'), array('escape' => false)); ?></li>
        <?php if ($this->Session->read('Auth.User.group_id') == 1) { ?>
          <li><?php echo $this->Html->link('Add Facility', array('action' => 'edit'), array('escape' => false)); ?></li>
        <?php } ?>
      </ul>
        
      </td>
      <td valign="top">
        <h2>Edit Facility</h2>
        <style type="text/css">
          table.results tr:nth-child(2n):hover td { background: none repeat scroll 0 0 #F5F5F5;}
        </style>
        <?php

        echo $this->Form->create('Facility');
        echo $this->Form->hidden('id');
        ?>
        <table cellspacing="0" cellpadding="0" class="results">
        <tr>
          <th>Basic Information</th>
          <th class="spacer">&nbsp;</th>
          <th>System Required</th>
          <th class="spacer">&nbsp;</th>
          <th>CMS Required</th>
          <th class="spacer">&nbsp;</th>
          <th>Location Information</th>
          <th class="spacer">&nbsp;</th>
          <th>&nbsp;</th>
        </tr>
        <tr>
        <td valign="top"> 
        <?php
        echo $this->Form->input('parent_id', array('label' => 'Parent', 'type' => 'select', 'options' => $facilities));
        echo $this->Form->input('TYPE', array('label' => 'Type of Nursing Home', 'type' => 'select', 'empty' => '( select an option )', 'options' => array(
          1 => '1. Nursing Home (SNF/NF)',
          2 => '2. Swing Bed'
        )));
        echo $this->Form->input('code', array('label' => 'Facility Code'));
        echo $this->Form->input('FNAME', array('label' => 'Name'));
        echo $this->Form->input('name', array('label' => 'Short Name'));
        ?>
        </td>
        <td class="spacer" width="40">&nbsp;</td>
        <td valign="top">
        <?php

        echo $this->Form->input('rec_type', array('label' => 'Record Type', 'type' => 'select', 'empty' => '( select an option )', 'options' => array(
          '0' => 'Facility',
          '1' => 'Operator'
        )));
        echo $this->Form->input('ap_software', array('label' => 'AR Software', 'type' => 'select', 'empty' => '( select an option )', 'options' => array(
          'ncs' => 'National Care Systems',
          'ubs' => 'IT Management'
        )));
        echo $this->Form->input('mr_software', array('label' => 'MR Software', 'type' => 'select', 'empty' => '( select an option )', 'options' => array(
          'ncs' => 'National Care Systems',
          'fieldbase' => 'IT Management'
        )));
        echo $this->Form->input('care_tracker', array('label' => 'Uses Care Tracker', 'type' => 'select', 'empty' => '( select an option )', 'options' => array(
          '1' => 'Active',
          '0' => 'In-Active'
        )));
        echo $this->Form->input('status', array('label' => 'Status', 'type' => 'select', 'empty' => '( select an option )', 'options' => array(
          '1' => 'Active',
          '0' => 'In-Active'
        )));
        ?>
        </td>
        <td class="spacer" width="40">&nbsp;</td>
        <td valign="top">
        <?php
        echo $this->Form->input('FAC_ID', array('label' => 'FAC_ID'));
        echo $this->Form->input('F_STATE', array('label' => 'STATE_CD'));
        echo $this->Form->input('F_MCARENBR', array('label' => 'Medicare #'));
        echo $this->Form->input('F_MCAIDNBR', array('label' => 'Medicaid #'));
        echo $this->Form->input('NPI', array('label' => 'NPI Number'));
        echo $this->Form->input('CCN', array('label' => 'CMS Number'));
        echo $this->Form->input('STATE_PROVIDER_NUM', array('label' => 'State Provider Number'));
        ?>
        </td>
        <td class="spacer" width="40">&nbsp;</td>
        <td valign="top">
        <?php
        echo $this->Form->input('F_ADDR', array('label' => 'Address'));
        echo $this->Form->input('F_MADDR', array('label' => 'Mailing Address'));
        echo $this->Form->input('F_CITY', array('label' => 'City'));
        echo $this->Form->input('F_STATE', array('label' => 'State'));
        echo $this->Form->input('F_ZIP', array('label' => 'Zip'));
        echo $this->Form->input('F_PHONE', array('label' => 'Phone Number'));
        ?>
        </td>
        <td class="spacer">&nbsp;</td>
        <td valign="top">
        </td>
        </tr>
        </table>
        <?php
        echo $this->Form->submit('Submit');
        echo $this->Form->end();
        ?>
    </td>
    
  </tr>
  
  
</table>