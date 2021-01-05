<?php

App::import('Core', array('File', 'HttpSocket'));
class CensusController extends AppController {

  public $uses = array('Resident');

  /**
   * static end point mapping
   * 
   * The endpoint mapping for each facility that is processed
   */
  public $endpoint =  array(
    41 => array(
      'name' => 'Milton',
      'facility_id' => 1,
      'url' => 'https://web9.caretrackeronline.com/42323/eis/eis.asmx'
    ),
    42 => array(
      'name' => 'Watsontown',
      'facility_id' => 1,
      'url' => 'https://web9.caretrackeronline.com/42324/eis/eis.asmx'
    )
  );
  
  public function index () {
    $this->Session->setFlash('Please select a facility for the Census export', 'default', array('class' => 'warning'));
  }

  /**
   * Verify
   * 
   * Verify the XML data to be sent
   *
   * @param $function string This is the function to be processed
   * @param $id integer This is the facility id
   * @return $xml string the xml data to be sent with the request
   * @return $headers array header information for the soap request
   */
  public function process ($function, $id) {
    $this->_sendRequest ($function, $id);
  }

  /**
   * Verify
   * 
   * Verify the XML data to be sent
   *
   * @param $id integer This is the facility id
   * @return $xml string the xml data to be sent with the request
   * @return $headers array header information for the soap request
   */
  public function verify ($id = null) {

    $inner = self::_setData($id);

    $output  = '<?xml version="1.0" encoding="utf-8"?>';
    $output .= '<soap:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">';
    $output .= '<soap:Body>';
    $output .= '<ValidateDataByXMLStream xmlns="http://www.ResourceSystem.com/EIS/">';
    $output .= '<IncomingXMLStream>';

    // begin xml stream for residents
    $output .= '&lt;?xml version="1.0" encoding="utf-8"?&gt;';
    $output .= '&lt;ResidentInfo xmlns="urn:residents-schema"&gt;';
    $output .= '&lt;ResidentList&gt;';
    $output .= $inner;
    $output .= '&lt;/ResidentList&gt;';
    $output .= '&lt;/ResidentInfo&gt;';
    // end xml stream for residents

    $output .= '</IncomingXMLStream>';
    $output .= '<FileCategory>ResidentValidate</FileCategory>';
    $output .= '</ModifyDataByXMLStream>';
    $output .= '</soap:Body>';
    $output .= '</soap:Envelope>';

    $headers = array(
      "Content-Type: text/xml; charset=utf-8",
      "SOAPAction: http://www.ResourceSystem.com/EIS/ValidateDataByXMLStream", 
      "Content-length: ". strlen($output)
    );

    return array(
      'xml' => $output,
      'headers' => $headers
    );

  }

  /**
   * Generate
   * 
   * Generates a census feed based on facility id
   *
   * @param $id integer This is the facility id
   * @return $xml string the xml data to be sent with the request
   * @return $headers array header information for the soap request
   */
  public function generate ($id = null) {

    $inner = self::_setData($id);

    $output  = '<?xml version="1.0" encoding="utf-8"?>';
    $output .= '<soap:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">';
    $output .= '<soap:Body>';
    $output .= '<ModifyDataByXMLStream xmlns="http://www.ResourceSystem.com/EIS/">';
    $output .= '<IncomingXMLStream>';

    // begin xml stream for residents
    $output .= '&lt;?xml version="1.0" encoding="utf-8"?&gt;';
    $output .= '&lt;ResidentInfo xmlns="urn:residents-schema"&gt;';
    $output .= '&lt;ResidentList&gt;';
    $output .= $inner;
    $output .= '&lt;/ResidentList&gt;';
    $output .= '&lt;/ResidentInfo&gt;';
    // end xml stream for residents

    $output .= '</IncomingXMLStream>';
    $output .= '<FileCategory>Resident</FileCategory>';
    $output .= '</ModifyDataByXMLStream>';
    $output .= '</soap:Body>';
    $output .= '</soap:Envelope>';

    $headers = array(
      "Content-Type: text/xml; charset=utf-8",
      "SOAPAction: http://www.ResourceSystem.com/EIS/ModifyDataByXMLStream", 
      "Content-length: ". strlen($output)
    );

    return array(
      'xml' => $output,
      'headers' => $headers
    );

  }

  /**
   * Verify
   * 
   * Sets the data to be used in the XML Stream
   *
   * @param $id integer This is the facility id
   * @return $inner string the xml data for the resident stream
   */
  private function _setData ($id) {


    if (!$id)
      $this->Session->setFlash('Please select a facility for the Census export', 'default', array('class' => 'warning'));

    $data = $this->Resident->find('all', array(
      'conditions' => array(
        'Resident.facility_id' => $id, 
        'Resident.PATLNAME !=' => '', 
        'Resident.PATLNAME IS NOT NULL', 
        'Resident.PATFNAME !=' => '', 
        'Resident.PATFNAME IS NOT NULL', 
        'Resident.PATNUM IS NOT NULL', 
        'Resident.id LIKE' => "%". $id ."-%"
      ),
      'fields' => array(
        'Resident.facility_id', 'Resident.ADATE', 'Resident.PATNUM', 'Resident.PMI', 'Resident.PATLNAME', 'Resident.PATFNAME', 
        'Resident.ROOM', 'Resident.BED', 'Resident.STATION', 'Resident.READM', 'Resident.created', 'Resident.modified', 'Resident.id'
      )
    ));

    $inner = '';
    foreach ($data as $key => $value) {

      // set if active or inactive
      switch ($value['Resident']['READM']) {
        case 'D'; case 'E'; case 'L';
          $status = 'INACTIVE';
          break;
        default: 
          $status = 'ACTIVE';
      }

      // set resident bed
      $station = $value['Resident']['STATION'];
      $room = $value['Resident']['ROOM'];
      $bed = $value['Resident']['BED'];

      $bc = strlen($bed);
      $bf = substr($bed, 0, 1);
      $bl = substr($bed, $bc-1, 1);
      if (!is_numeric($bf)) $station = $bf;
      if (!is_numeric($bl)) $bed = $bl;

      $room = str_replace(array($station, $bed), '', $bed) . $bed;

      // clean up the name
      $firstname  = $value['Resident']['PATFNAME'];
      $middlename = $value['Resident']['PMI'];
      $lastname  = $value['Resident']['PATLNAME'];

      if (preg_match('| |', $firstname)) {
        list($firstname, $middlename) = explode(' ', $value['Resident']['PATFNAME']);
      }

      // clean up the room, station, bed
      $station = $value['Resident']['STATION'];
      $room = $value['Resident']['ROOM'];
      $bed = $value['Resident']['BED'];

      if ($value['Resident']['modified'] == '0000-00-00 00:00:00')
        $modified = $value['Resident']['created'];
      else
        $modified = $value['Resident']['modified'];

      if ($modified == '0000-00-00 00:00:00')
        $modified = date('Y-m-d H:i:s');

      $inner .= '&lt;Resident FacilityId="'. $this->endpoint[$id]['facility_id'] .'" ResidentRef="'. $value['Resident']['PATNUM'] .'" ResidentFirstName="'. $firstname .'" ResidentMiddleInitial="'. substr($middlename, 0, 1) .'" ResidentLastName="'. $lastname .'" Category="SNF" ResidentLocation="'. $station .'" ResidentRoom="'. $room .'" ResidentStatus="'. $status .'" StatusEffectiveDate="'. $modified .'" /&gt;';
    }

    return $inner;

  }


  /**
   * Verify
   * 
   * Sends the request 
   *
   * @param $function string This is the function to be processed
   * @param $id integer This is the facility id
   */
  public function _sendRequest ($function, $id) {

    switch ($function) {
      case 'generate':
        $data = $this->generate ($id);
        break;
      case 'verify':
        $data = $this->verify ($id);
        break;
    }

    // PHP cURL  for https connection with auth
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $this->endpoint[$id]['url']);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data['xml']); // the SOAP request
    curl_setopt($ch, CURLOPT_HTTPHEADER, $data['headers']);

    // converting
    $response = curl_exec($ch); 
    curl_close($ch);

    echo '<pre>';
    print_r ($response);
    die;
  }

}