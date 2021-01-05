<table>
  <tr>
    <td class="left-column" valign="top">
      <!-- begin menus -->
      <ul class="left-nav">
        <li class="menu">Users</li>
        <li><?php echo $this->Html->link('View Users', array('controller' => 'users', 'action' => 'index'), array('escape' => false)); ?></li>
        <li><?php echo $this->Html->link('Add User', array('controller' => 'users', 'action' => 'add'), array('escape' => false)); ?></li>
        
        <?php if ($this->Session->read('Auth.User.group_id') <= 4) { ?>
          <li><?php echo $this->Html->link('Upload Users', array('controller' => 'users', 'action' => 'upload'), array('escape' => false)); ?></li>
        <?php } ?>
      </ul>
      <?php if ($this->Session->read('Auth.User.group_id') <= 2) { ?>
      <ul class="left-nav">
        <li class="menu">Groups</li>
        <li><?php echo $this->Html->link('View Groups', array('controller' => 'groups', 'action' => 'index'), array('escape' => false)); ?></li>
        <li><?php echo $this->Html->link('Add Group', array('controller' => 'groups', 'action' => 'edit'), array('escape' => false)); ?></li>
      </ul>
      <ul class="left-nav">
        <li class="menu">Settings</li>
        <li><?php echo $this->Html->link('View Settings', array('controller' => 'settings', 'action' => 'index'), array('escape' => false)); ?></li>
        <li><?php echo $this->Html->link('Add Setting', array('controller' => 'settings', 'action' => 'add'), array('escape' => false)); ?></li>
      </ul>
      <?php } ?>
    </td>
    <td valign="top">
    	<table>
          <tr>
            <td>
            <?php if ($this->Session->read('Auth.User.group_id') <= 2) { ?>
              <?php if (!isset($importErrors)) { ?>
                <h2>Upload Users</h2>
                <?php 
                echo $this->Form->create('User', array('action' => 'upload', 'type' => 'file'));
                echo $this->Form->input('logo_filename',array('type'=>'hidden'));
                echo $this->Form->input('main_filename',array('type'=>'hidden'));
                echo $this->Form->input('image', array('type'=>'file', 'label' => 'Users CSV File'));   
                echo $this->Form->end(__('Submit', true));
              }
              else 	{ 
              ?>  	
                <h2>Upload User Errors</h2>
                <table width="100%" cellspacing="0" class="results">
                <tr>
                  <th>Facility</th>
                  <th>Group</th>
                  <th>Name</th>
                  <th>Username</th>
                  <th>Password</th>
                  <th>Email</th>
                  <th>Status</th>
                  <th>Error</th>
                </tr>
                
                <?php foreach ($userErrors as $key => $value): ?>
                <tr>
                  <td class="align-center"><?php echo $value['facility']; ?></td>
                  <td class="align-center"><?php echo $value['group']; ?></td>
                  <td class="align-center"><?php echo $value['name']; ?></td>
                  <td class="align-center"><?php echo $value['username']; ?></td>
                  <td class="align-center"><?php echo $value['password']; ?></td>
                  <td class="align-center"><?php echo $value['email']; ?></td>
                  <td class="align-center"><?php echo $value['status']; ?></td>
                  <td class="align-center"><?php echo $value['error']; ?></td>
                </tr>
                <?php endforeach; ?>
              </table>
              <?php } ?>
            </td>
          </tr>
        <?php } 
				
						$filepath = '/admin/users/download';

				?>  
					<tr>
          	<td> <h2>How to Upload Multiple Users</h2>The <b>Upload Users</b> feature will allow multiple users to be added to MDS at one time without the hassle of inputting each user one by one.  Please read the below "<b>Detailed Instructions</b>" section to properly submit the user data.  <a href="<?php echo $filepath ;?>" title="Download the SampleUserData.csv File" >Download</a> a sample data spreadsheet, add the user data while following the sample data examples and send the file to us.  The MDS system will automatically import your user data for instant access.
          </tr>        
          <tr>
            <td>
              <!-- 3 Content Boxes -->
              <div class="service-capture" id="home-rotator">
                  <ul>
                      <li class="first">start with sample data<div class="more"><a href="<?php echo $filepath ;?>" title="Download the SampleUserData.csv File">download here</a></li>
                      <li class="divider">&nbsp;</li>
                      <li class="second">enter your user data </li>
                      <li class="divider">&nbsp;</li>
                      <li class="third">send us the user data<div class="more"><span>it's that easy</span></div></li>
                  </ul>
              </div>
            </td>
          </tr>
          <tr >
          	<td style="padding-top: 40pt;"><h4>Detailed Instructions</h4>
            		<ol>
                	<li>Download the sample excel csv file.  Click <a href="<?php echo $filepath ;?>" title="Download the SampleUserData.xls File">here</a> to download file.</li>
                  <li>Open the <b>SampleUserData.xls</b> in Excel.</li>
                  <li>There are 7 columns that must be inputted to properly import the users:
                  	<ul>
                    	<li><b>Facility</b></li>
                      <li><b>Group</b>
                      	<ul>
                        	<li>The <b>Group</b> value must be one of the following:
                          	<ul>
                            	<li>Corporate</li>
                              <li>Regional Coordinator</li>
                              <li>MDS Coordinator</li>
                           	</ul>
                          </li>
                        </ul>
                      </li>
                      <li><b>Name</b></li>
                      <li><b>Username</b>
                      	<ul>
                        	<li>Note: <b>Usernames</b> must be unique</li>
                        </ul>
                      </li>
                      <li><b>Password</b></li>
                      <li><b>Email</b></li>
                      <li><b>Status</b>
                      	<ul>
                        	<li>The <b>Status</b> value must be '0' or '1':
                          	<ul>
                            	<li>'1' = Active user.</li>
                              <li>'0' = Deactived user.</li>
                           	</ul>
                          </li>
                        </ul>
                      </li>                      
                   	</ul>
                	</li>
                  <li>Save the file, we recommend to do a "Save As" and change the filename to something othen than "SampleUserData".</li>
                  <li>Email us the file.</li>
									<li>We will review the data, if the data is validated a rep will import the user data into MDS.</li>
                </ol>
         		</td>
          </tr>
          	
    	</table>
    </td>
  </tr>
</table
