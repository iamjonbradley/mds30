<?php

App::import('Vendor', 'Excel');
App::import('Vendor', 'Excelreader', array('file' => 'reader.php'));

class ExcelComponent extends Component {
  
  function generate($data) {
    
    foreach ($data as $key => $value) {
      if (!is_array($value)) 
        $info[] = explode(',', $value); 
      else $info[] = $value;
    }
    
    try{
      $PhpToXls = new Excel($info, WWW_ROOT .'export'. DS, str_replace(array('.', ' '), '', microtime()), true);
      $PhpToXls->SendFile();
    }
    catch(Exception $Except){
      Excel::ExceptPrint($Except);
    }
  }

  function read ($file) {
    $excel = new Spreadsheet_Excel_Reader();
    $excel->setOutputEncoding('CP1251');
    $excel->read($file);

    return $excel;

  }
  
  function eightZeroTwo($data) {
    try{
      $PhpToXls = new Excel($data, WWW_ROOT .'export'. DS, str_replace(array('.', ' '), '', microtime()), true);
      $PhpToXls->SendFile();
    }
    catch(Exception $Except){
      Excel::ExceptPrint($Except);
    }
  }
  
}