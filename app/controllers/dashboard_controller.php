<?php

class DashboardController extends AppController {
  
  public $name = 'Dashboard';
  public $uses = array('Ticket', 'Facility', 'Stat');
  public $components = array('Dashboard');
  public $helpers = array('Number', 'Time');
  public $cacheAction = "1 hour";
  
  public function index () {
    $results['tickets']      = $this->Ticket->getNotices(10);
    $results['assessments']  = $this->Facility->getAssessmentCounts();
    $results['residents']    = array();
    $this->set('results', $results);
  }

  public function regional () {

    $facility_id  = 3;
    $date_start   = '2012-12-01';
    $date_end     = '2012-12-21';

    Controller::loadModel('RugCache');

    $rugs = $this->RugCache->rug_groups($facility_id, $date_start, $date_end);
    $rug_group = $this->Dashboard->rugs($rugs);

  }
  
  public function admin () {
    $results['assessments']  = $this->Facility->getAssessmentCounts($this->Auth->user('facility_id'));
    $results['online']       = $this->Stat->getOnline();
    $results['tickets']      = $this->Ticket->getNotices(5);
    $this->set('results', $results);
  }
  
  public function news () {
    $results['tickets']      = $this->Ticket->getNotices();
    $this->set('results', $results);
  }

  public function jump () {

  	if (empty($this->data))
  		$this->redirect('index', null, false);
  	
  	if (!empty($this->data)) {
  		switch ($this->data['Jump']['type']) {
  			case 'bulk':
  				$this->redirect(array('controller' => $this->data['Jump']['type'], 'action' => 'view', $this->data['Jump']['id']), null, false);
  				break;
  			case 'ticket':
  				$this->redirect(array('controller' => 'tickets', 'action' => 'view', $this->data['Jump']['id']), null, false);
  				break;
  			case 'assessment':
  				$this->redirect(array('controller' => 'assessments', 'action' => 'report', $this->data['Jump']['id']), null, false);
  				break;
        default:
          $this->redirect('index', null, false);
  		}
  	}

  }
  
}