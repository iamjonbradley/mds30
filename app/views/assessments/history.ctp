
<h2>Please pick a section</h2>
<?php 
echo $this->Form->create('SectionV', array('url' => '/assessments/caa/'. $this->data['Assessment']['id'], 'id' => 'addAssessment'));
echo $this->Form->hidden('id', array('value' =>  $this->data['SectionV']['id']));
echo $this->Form->hidden('assessment_id', array('value' => $this->data['Assessment']['id']));
echo $this->Form->hidden('state', array('value' => $this->data['Facility']['F_STATE']));
echo $this->Form->hidden('SectionA.validated', array('id' => 'SectionA-validated', 'value' => $this->data['SectionA']['validated']));
echo $this->Form->hidden('Misc.section', array('id' => 'section', 'value' => $section));
echo $form->hidden('Assessment.type', array('value' => $this->AssessmentType->short($this->data)));

  echo $this->Form->hidden('B0100', array('id' => 'B0100', 'value' => $this->data['SectionB']['B0100']));
?>

<div class="spacer"></div>
<?php echo $this->element('../assessments/_tabs'); ?>
<div id="assessment">
  <div id="tabs">
    <ul>
      <?php 
        $this->AvailableSection->letters(
          $this->data, 
          $this->AssessmentType->short($this->data), 
          $this->data['Facility']['F_STATE'], 
          $section, 
          $this->data['Assessment']['id']
        );
      ?>
    </ul>
  </div>
  <div id="section">
<h2>Assessment Change Set History</h2>
<div class="note"><img src="/img/icons/lightbulb.png" class="note-img" /> <strong>NOTE:</strong> Click on the row to see a detailed view of what has changed</div>
<table class="results" cellspacing="0">
	<tr>
		<th class="align-left"><?php echo $this->Paginator->sort('Address', 'ip_address') ?></th>
		<th class="align-left"><?php echo $this->Paginator->sort('description', 'description') ?></th>
		<th class="align-left"><?php echo $this->Paginator->sort('Item', 'model') ?></th>
		<th class="align-left"><?php echo $this->Paginator->sort('Item ID', 'model') ?></th>
		<th class="align-left"><?php echo $this->Paginator->sort('created', 'created') ?></th>
    <?php if ($this->Session->read('Auth.User.group_id') <= 2) { ?>
	  	  <th class="align-center"><?php echo "Rollback"; ?></th>
    <?php } ?>
	</tr>
	<?php if (!empty($data)) { ?>
		<?php foreach ($data as $key => $value) { ?>
			<tr class="history-show" id="<?php echo $value['Log']['id']; ?>">
				<td><?php echo $value['Log']['ip_address']; ?></td>
				<td><?php echo $value['Log']['description']; ?></td>
				<td><?php echo $value['Log']['model']; ?></td>
				<td><?php echo $value['Log']['model_id']; ?></td>
				<td><?php echo $value['Log']['created']; ?></td>
        <?php if ($this->Session->read('Auth.User.group_id') <= 2) { ?>
          <td class="align-center"><a href="/assessments/rollback/<?php echo $value['Log']['id']; ?>" >
                <img alt="view" src="/img/actions/rollback.png" />
              </a>
          </td>
				<?php } ?>
			</tr>
			<tr class="history <?php echo $value['Log']['id']; ?>">
				<?php if ($this->Session->read('Auth.User.group_id') <= 2) { ?>
		        <td colspan="6">
         <?php } else { ?>
         		<td colspan="5">
         <?php } ?>
					<?php echo $value['Log']['change']; ?>
				</td>
			</tr>
		<?php } ?>
	<?php } else { ?>
  	<?php if ($this->Session->read('Auth.User.group_id') <= 2) { ?>
				<tr><td colspan="6">Sorry we have no change set information for this Assessment at this time.</td></tr>	
    <?php } else { ?>
				<tr><td colspan="5">Sorry we have no change set information for this Assessment at this time.</td></tr>	    
  	<?php } ?>      
	<?php } ?>
</table>
<?php
  echo $this->Paginator->prev('« Previous ', null, null, array('class' => 'disabled'));
  echo '&nbsp;';
  echo $this->Paginator->numbers(); 
  echo '&nbsp;';
  echo $this->Paginator->next(' Next »', null, null, array('class' => 'disabled'));
?>
  </div>
</div>
<?php echo $this->Form->end(); ?>