<?php

Configure::write('debug', 0);
class FixDatesShell extends Shell {  

    public $tasks = array('Dump');

	function main() {
		
        $this->Assessment = ClassRegistry::init('Assessment');
        $this->SectionA = ClassRegistry::init('SectionA');
    	
    	$data = $this->SectionA->find('all', array(
            'conditions' => array("SectionA.A2300 NOT LIKE '%-%' "),
    		'order' => array('SectionA.id' => 'ASC'),
            'fields' => array('SectionA.assessment_id', 'SectionA.id'),
            'recursive' => -1
    	));

        $this->Dump->execute();
    	
    	foreach ($data as $key => $value) {

           $id = $value['SectionA']['id'];
    		
            $asmt = $this->SectionA->find('first', array(
                'conditions' => array("Assessment.id" => $id),
            ));

            if (!empty($asmt)) {

                $asmt['SectionA']['id']             = $id;
                $asmt['SectionA']['assessment_id']  = $id;
                $asmt['SectionA']['A2000']          = self::fix($asmt['SectionA']['A2000']);
                $asmt['SectionA']['A2300']          = self::fix($asmt['SectionA']['A2300']);
                $this->Assessment->SectionA->save($asmt['SectionA'], false);
                
                $asmt['SectionM']['id']             = $id;
                $asmt['SectionM']['assessment_id']  = $id;
                $asmt['SectionM']['M0300B3']        = self::fix($asmt['SectionM']['M0300B3']);
                $this->Assessment->SectionM->save($asmt['SectionM'], false);
                
                $asmt['SectionO']['id']             = $id;
                $asmt['SectionO']['assessment_id']  = $id;
                $asmt['SectionO']['O0250B']         = self::fix($asmt['SectionO']['O0250B']);
                $asmt['SectionO']['O0400A5']        = self::fix($asmt['SectionO']['O0400A5']);
                $asmt['SectionO']['O0400A6']        = self::fix($asmt['SectionO']['O0400A6']);
                $asmt['SectionO']['O0400B5']        = self::fix($asmt['SectionO']['O0400B5']);
                $asmt['SectionO']['O0400B6']        = self::fix($asmt['SectionO']['O0400B6']);
                $asmt['SectionO']['O0400C5']        = self::fix($asmt['SectionO']['O0400C5']);
                $asmt['SectionO']['O0400C6']        = self::fix($asmt['SectionO']['O0400C6']);
                $asmt['SectionO']['O0400B6']        = self::fix($asmt['SectionO']['O0400B6']);
                $asmt['SectionO']['O0400B6']        = self::fix($asmt['SectionO']['O0400B6']);
                $this->Assessment->SectionO->save($asmt['SectionO'], false);
                
                $asmt['SectionS']['id']             = $id;
                $asmt['SectionS']['assessment_id']  = $id;
                $asmt['SectionS']['S9080D']         = self::fix($asmt['SectionS']['S9080D']);
                $asmt['SectionS']['S9100C']         = self::fix($asmt['SectionS']['S9100C']);
                $this->Assessment->SectionS->save($asmt['SectionS'], false);
                
            }
    		
    	}
    	
    	echo '--------------------------------------------------------' ."\r\n";
    	echo '                   FINISHED FINALLY                     ' ."\r\n";
    	echo '--------------------------------------------------------' ."\r\n";
    	
		
	}
	
	function fix ($date) {
		
		if (empty($date))
			return $date;

		if (strlen($date) == 8 && substr($date, 0, 4) == '2011') {
			$y = substr($date, 0, 4);
			$m = substr($date, 4, 2);
			$d = substr($date, 6, 2);
			
			$date = $y .'-'. $m .'-'. $d;
		}

		if (strlen($date) == 8 && substr($date, 0, 4) == '2010') {
			$y = substr($date, 0, 4);
			$m = substr($date, 4, 2);
			$d = substr($date, 6, 2);
			
			$date = $y .'-'. $m .'-'. $d;
		}

		if (strlen($date) == 8 && substr($date, 4, 4) == '2010') {
			$y = substr($date, 4, 4);
			$m = substr($date, 0, 2);
			$d = substr($date, 2, 2);
			
			$date = $y .'-'. $m .'-'. $d;
		}

		if (strlen($date) == 8 && substr($date, 4, 4) == '2011') {
			$y = substr($date, 4, 4);
			$m = substr($date, 0, 2);
			$d = substr($date, 2, 2);
			
			$date = $y .'-'. $m .'-'. $d;
		}

		return $date;
				
	}
	
}