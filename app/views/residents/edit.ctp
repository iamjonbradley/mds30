<table width="100%">
  <tr>
    <td class="left-column resident" valign="top">
      <?php echo $this->element('../residents/_menu'); ?>
    </td>
    <td valign="top">
      <?php 
        echo $this->Form->create('Resident'); 
        echo $this->Form->hidden('id');
        echo $this->Form->hidden('previous_id', array('value' => $this->data['Resident']['id']));
      ?>
      <style>
        td {padding: 5px;}
        .add-resident input, .add-resident select { border: 1px solid #CCC; padding: 7px; }
        .add-resident td.field { font-weight: bold; font-size: 8pt; border: 0; width: 100px; }
        .add-resident td.header { font-weight: bold; font-size: 8pt; border: 0; background: #CCC; border: 1px solid #333; }
        .add-resident input[type=submit] { float: right; }
      </style>
      <h2><?php echo ucwords(strtolower($this->params['action'])); ?> a Resident</h2>
      
      
      <table style="background: #FFF;" class="add-resident">
        <tr>
          <td valign="top">
            <table style="background: #FFF;" class="add-resident">
              <tr><td colspan="2" class="header">Basic Information</td></tr>
              <tr>
                <td class="field">Patient #</td>
                <td><?php echo $this->Form->input('Resident.PATNUM', array('label' => false, 'div' => false, 'size' => 8, 'maxLength' => 8)); ?></td>
              </tr>  
              <tr>
                <td class="field">Resident #</td>
                <td><?php echo $this->Form->input('Resident.RESNO', array('label' => false, 'div' => false, 'size' => 8, 'maxLength' => 8)); ?></td>
              </tr>  
              <tr>
                <td class="field">First name</td>
                <td><?php echo $this->Form->input('Resident.PATFNAME', array('label' => false, 'div' => false, 'size' => 25, 'maxLength' => 25)); ?></td>
              </tr>  
              <tr>
                <td class="field">M.I.</td>
                <td><?php echo $this->Form->input('Resident.PMI', array('label' => false, 'div' => false, 'size' => 1, 'maxLength' => 1)); ?></td>
              </tr>  
              <tr>
                <td class="field">Last name</td>
                <td><?php echo $this->Form->input('Resident.PATLNAME', array('label' => false, 'div' => false, 'size' => 25, 'maxLength' => 25)); ?></td>
              </tr>  
              <tr>
                <td class="field">SSN</td>
                <td><?php echo $this->Form->input('Resident.SSNUM', array('label' => false, 'div' => false, 'size' => 11, 'maxLength' => 11)); ?></td>
              </tr>  
              <tr>
                <td class="field">Birth Date</td>
                <td><?php echo $this->Form->input('Resident.BDATE', array('label' => false, 'div' => false, 'type' => 'date', 'minYear' => date('Y') - 100, 'maxYear' => date('Y'))); ?></td>
              </tr>  
              <tr>
                <td class="field">Marital Status</td>
                <td><?php echo $this->Form->input('Resident.MARSTAT', array('type' => 'select', 'div' => 'false', 'label' => false, 'options' => array('N' => 'Never Married/Single', 'M' => 'Married', 'W' => 'Widowed', 'S' => 'Separated', 'D' => 'Divorced'))); ?></td>
              </tr>    
              <tr>
                <td class="field">Occupation</td>
                <td><?php echo $this->Form->input('Resident.OCCUPATION', array('label' => false, 'div' => false, 'size' => 15, 'maxLength' => 15)); ?></td>
              </tr>  
              <tr>
                <td class="field">Gender</td>
                <td><?php echo $this->Form->input('Resident.SEX', array('type' => 'select', 'div' => 'false', 'label' => false, 'options' => array('M' => 'Male', 'F' => 'Female'))); ?></td>
              </tr>    
            </table>
          </td>
          <td valign="top">
            <table style="background: #FFF;" class="add-resident">
              <tr><td colspan="2" class="header">Facility Information</td></tr>
              <tr>
                <td class="field">Facility Name</td>
                <td>
                <?php 
                foreach ($facilities as $key => $value) {
                  $facilities[$key] = $value .' - ID # '. $key;
                }

                echo $this->Form->input('Resident.facility_id', array('type' => 'select', 'div' => 'false', 'label' => false, 'options' => $facilities)); ?>
              </td>
              </tr>    
              <tr>
                <td class="field">Entry Date</td>
                <td><?php echo $this->Form->input('Resident.ADATE', array('label' => false, 'div' => false, 'type' => 'date', 'minYear' => date('Y') - 100, 'maxYear' => date('Y'))); ?></td>
              </tr> 
              <tr>
                <td class="field">Station</td>
                <td><?php echo $this->Form->input('Resident.STATION', array('label' => false, 'div' => false, 'size' => 3, 'maxLength' => 3)); ?></td>
              </tr>  
              <tr>
                <td class="field">Room #</td>
                <td><?php echo $this->Form->input('Resident.ROOM', array('label' => false, 'div' => false, 'size' => 4, 'maxLength' => 4)); ?></td>
              </tr>  
              <tr>
                <td class="field">Bed</td>
                <td><?php echo $this->Form->input('Resident.BED', array('label' => false, 'div' => false, 'size' => 3, 'maxLength' => 3)); ?></td>
              <tr>
                <td class="field">Are they in an Apartment?</td>
                <td><?php echo $this->Form->input('Resident.apartment', array('label' => false, 'div' => false, 'size' => 3, 'maxLength' => 3)); ?></td>
              </tr>  
            </table>
            <table style="background: #FFF;" class="add-resident">
              <tr><td colspan="2" class="header">Billing Information</td></tr>
              <tr>
                <td class="field">Medicare #</td>
                <td><?php echo $this->Form->input('Resident.MEDICARE', array('label' => false, 'div' => false, 'size' => 12, 'maxLength' => 12)); ?></td>
              </tr>  
              <tr>
                <td class="field">Medicaid #</td>
                <td><?php echo $this->Form->input('Resident.MEDICAID', array('label' => false, 'div' => false, 'size' => 16, 'maxLength' => 16)); ?></td>
              </tr>  
              <tr>
                <td class="field">Resident Status</td>
                <td><?php echo $this->Form->input('Resident.READM', array('label' => false, 'div' => false, 'type' => 'select', 'options' => array(
                		'' => 'In House',
                		'D' => 'Discharged',
                		'E' => 'Expired',
                		'L' => 'On-Leave',
                	))); ?></td>
              </tr>  
            </table>
          </td>
          <td valign="top">
            <table style="background: #FFF;" class="add-resident">
              <tr><td colspan="2" class="header">Previous Address</td></tr>
              <tr>
                <td class="field">Address</td>
                <td><?php echo $this->Form->input('Resident.ADDRESS1', array('label' => false, 'div' => false, 'size' => 30, 'maxLength' => 30)); ?></td>
              </tr>  
              <tr>
                <td class="field">Address (optional)</td>
                <td><?php echo $this->Form->input('Resident.ADDRESS2', array('label' => false, 'div' => false, 'size' => 30, 'maxLength' => 30)); ?></td>
              </tr>  
              <tr>
                <td class="field">City</td>
                <td><?php echo $this->Form->input('Resident.CITY', array('label' => false, 'div' => false, 'size' => 20, 'maxLength' => 20)); ?></td>
              </tr>  
              <tr>
                <td class="field">State</td>
                <td><?php echo $this->Form->input('Resident.STATE', array('label' => false, 'div' => false, 'type' => 'select', 'options' => $states)); ?></td>
              </tr>   
              <tr>
                <td class="field">Zip Code</td>
                <td><?php echo $this->Form->input('Resident.ZIP', array('label' => false, 'div' => false, 'size' => 10, 'maxLength' => 10)); ?></td>
              </tr>  
              <tr>
                <td class="field">Home Phone</td>
                <td><?php echo $this->Form->input('Resident.PHONEH', array('label' => false, 'div' => false, 'size' => 20, 'maxLength' => 20)); ?></td>
              </tr> 
            </table>
          </td>
        </tr>
        <tr>
          <td colspan="3">
            <?php
            echo $this->Form->submit('Save Resident');
            echo $this->Form->end();
            ?>
          </td>
        </tr>
      </table>
    </td>
    
  </tr>
  
  
</table>