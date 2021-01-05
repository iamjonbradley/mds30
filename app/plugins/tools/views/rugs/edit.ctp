<table width="100%">
  <tr>
    <td valign="top" class="left-column" valign="top">
      <!-- begin menus -->
      
      <?php echo $this->element('_facility_list', array('plugin' => 'tools')); ?>
    </td>
    <td valign="top" valign="top">
      <?php 
      if (!empty($this->data)) {
      echo $this->Form->create(
        'RugRate', 
        array(
          'url' => '/tools/rugs/edit/'. $this->params['pass'][0]

        )
      ); 
      ?>
      <table class="results" cellspacing="0" cellpadding="4" style="width: auto">
        <tr>
          <th>Rug ID</th>
          <th>Facility</th>
          <th>RUG Score</th>
          <th>Rate</th>
        </tr>

        <?php foreach ($this->data as $key => $value) { ?>

        <tr>
          <td style="text-align: center; vertical-align: middle">
            <?php echo $value['RugRate']['id']; ?>
            <?php echo $this->Form->hidden($key .'.id', array('value' => $value['RugRate']['id'])); ?>
          </td>
          <td style="text-align: center; vertical-align: middle">
            <?php echo $value['Facility']['name']; ?>
          </td>
          <td style="text-align: center; vertical-align: middle">
            <?php echo $value['Rug']['name']; ?>
          </td>
          <td style="text-align: center">
            <?php
              echo $this->Form->input($key .'.rate', array(
                'div' => false,
                'label' => false,
                'value' => $value['RugRate']['rate']
              ));
            ?>
          </td>
        </tr>

        <?php } ?>

      </table>
      <?php echo $this->Form->submit('Update'); ?>
      <?php echo $this->Form->end(); ?>
      <?php } ?>
    </td>
    
  </tr>
</table>