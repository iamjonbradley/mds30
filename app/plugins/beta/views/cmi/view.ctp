<table width="100%">
  <tr>
    <td valign="top" class="left-column" valign="top">
      <!-- begin menus -->
      <ul class="left-nav">
        <li class="menu">Sort by Date</li>
        <li>
          <?php
          echo $this->Form->create('Report', array('url' => '/beta/cmi/view', 'type' => 'get'));
          echo $this->Form->input('facility_id', array('options' => $cmi_facs, 'empty' => '( select a facility )'));
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

      <table class="results" cellspacing="0" width="100">
        <tr>
          <th class="align-left" valign="bottom">Asessment</th>
          <th class="align-left" valign="bottom">Resident</th>
          <th class="align-left" valign="bottom">MR #</th>
          <th valign="bottom">Type</th>
          <th valign="bottom">ARD</th>
          <th valign="bottom">RUG IV<br />(Therapy)</th>
          <th valign="bottom">RUG IV<br />(Nursing)</th>
          <th valign="bottom">RUG IV<br />(Modifier)</th>
          <th valign="bottom">RUG III<br />(44 Group)</th>
          <th valign="bottom">CMI</th>
        </tr>
        <?php foreach ($data as $key => $value) { ?>

          <tr>
            <td><?php echo $value['Assessment']['id']; ?></td>
            <td><?php echo ucwords(strtolower($value['Resident']['PATLNAME'] .', '. $value['Resident']['PATFNAME'])); ?></td>

            <td><?php echo $value['Resident']['PATNUM']; ?></td>

            <td class="align-center"><?php echo $value['Assessment']['type']; ?></td>

            <td class="align-center"><?php echo $value['SectionA']['A2300']; ?></td>

            <td class="align-center"><?php echo $value['RUGIV']['Therapy']; ?></td>
            <td class="align-center"><?php echo $value['RUGIV']['Nursing']; ?></td>
            <td class="align-center"><?php echo $value['RUGIV']['Modifier']; ?></td>

            <td class="align-center"><?php echo $value['Cmi']['final']['rug']; ?></td>
            <td class="align-center"><?php echo $value['Cmi']['final']['cmi']; ?></td>

          </tr>

        <?php } ?>

      </table>

    </td>
    
  </tr>
</table>