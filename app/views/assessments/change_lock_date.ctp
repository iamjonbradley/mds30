<style type="text/css">
  #section {
    margin-left: 1px;
  }
</style>
<div class="spacer"></div>
<?php echo $this->element('../assessments/_tabs'); ?>
<div id="assessment">
  <div id="tabs">
    <ul>
      <?php 
        $this->AvailableSection->letters($this->data, 'r', $this->data['Assessment']['id']);
      ?>
    </ul>
  </div>
  <div id="section">

<h2>Change the Lock Date</h2>

<div class="header">Assessment Details</div>

<table class="results" cellspacing="0">
  <tr>
    <td style="font-size: 10pt;  text-align: left; font-weight: bold;">Resident</td>
    <td style="font-size: 10pt; text-align: left"><?php echo $this->data['Resident']['PATLNAME']; ?>, <?php echo $this->data['Resident']['PATFNAME']; ?></td>
    <td> &nbsp; </td>
    <td style="font-size: 10pt;  text-align: left; font-weight: bold;">Assessment ID #</td>
    <td style="font-size: 10pt; text-align: left"><?php echo $this->data['Assessment']['id']; ?></td> 
  </tr>
  <tr>
    <td style="font-size: 10pt;  text-align: left; font-weight: bold;">Facility</td>
    <td style="font-size: 10pt; text-align: left"><?php echo $this->data['Facility']['FNAME']; ?></td>
    <td> &nbsp; </td>
    <td style="width: 150px; font-size: 10pt;  text-align: left; font-weight: bold;">Assessment Type</td>
    <td style="font-size: 10pt; text-align: left"><?php echo $this->AssessmentType->get($this->data); ?></td> 
  </tr>
  <tr>
    <td style="font-size: 10pt;  text-align: left; font-weight: bold;">Current Lock Date</td>
    <td style="font-size: 10pt; text-align: left"><?php echo $this->data['Assessment']['lock_date']; ?></td>
    <td> &nbsp; </td>
    <td style="font-size: 10pt;  text-align: left; font-weight: bold;">Record Type</td>
    <td style="font-size: 10pt; text-align: left">
      <?php 
      switch ($this->data['SectionX']['X0100']) {
        case 1: $type = 'NEW'; break;  
        case 2: $type = 'MODIFICATION'; break;  
        case 3: $type = 'INACTIVATION'; break;  
        default: $type = '';
      }
      echo $type;
      ?>
    </td>
  </tr>
</table>
</form>
<h3>Submit Lock Date Change Request</h3>

<?php 
echo $this->Form->create('Assessment', array('action' => 'change_lock_date'));
echo $this->Form->hidden('ChangeRequest.assessment_id', array('value' => $this->data['Assessment']['id']));
echo $this->Form->hidden('ChangeRequest.current_lock_date', array('value' => $this->data['Assessment']['lock_date']));
echo $this->Form->hidden('ChangeRequest.user_id', array('value' => $this->Session->read('Auth.User.id')));
echo $this->Form->hidden('ChangeRequest.status', array('value' => 0));
echo $this->Form->input('ChangeRequest.current_lock_date', array('label' => 'Current Lock Date', 'value' => $this->data['Assessment']['lock_date'], 'disabled' => 'disabled'));
echo $this->Form->input('ChangeRequest.lock_date', array('label' => 'New Lock Date'));
echo $this->Form->input('ChangeRequest.reason', array('required' => true));
echo $this->Form->submit('Request Lock Date Change');
echo $this->Form->end();