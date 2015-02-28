<?php
include_once(APP . 'Plugin' . DS . 'PhpExcel' . DS . 'Vendor' . DS . 'PHPExcel' . DS . 'IOFactory.php');
include_once(APP . 'Plugin' . DS . 'PhpExcel' . DS . 'Vendor' . DS . 'PHPExcel' . DS . 'PHPExcel.php');


class CsvHelper extends AppHelper { 
     
	var $objPHPExcel;
	var $title;
    var $writer; 
    var $sheet; 
    var $data; 
    var $blacklist = array(); 
     
    public function csvHelper() {
	$this->log('run this'); 
		$this->objPHPExcel = new PHPExcel();
		$this->objPHPExcel->setActiveSheetIndex(0);
        //$this->objPHPExcel->getActiveSheet() = $this->objPHPExcel->getActiveSheet(); 
    } 
                  
    public function create($title = 'Report') { 
         $this->title = $title; 
    } 

	public function end() {
		header("Content-type: text/csv");  
        header('Content-Disposition: attachment;filename="'.$this->title.'.csv"'); 
        header('Cache-Control: max-age=0'); 

		$this->writer = PHPExcel_IOFactory::createWriter($this->objPHPExcel, 'CSV');
	        
        
        $this->writer->save('php://output'); 
		
	}
	
	public function setCellValue($coordinates, $value) {
		return $this->objPHPExcel->getActiveSheet()->setCellValue($coordinates, $value);
	}
     
    function _title($title) { 
        $this->objPHPExcel->getActiveSheet()->setCellValue('A2', $title); 
    } 

    function _headers() { 
        $i=0; 

		$this->log($this->data);

        foreach ($this->data[0] as $field => $value) { 
            if (!in_array($field,$this->blacklist)) { 
	
                $columnName = Inflector::humanize($field); 
                $this->objPHPExcel->getActiveSheet()->getCellByColumnAndRow($i++, 4, $columnName); 

            } 
        } 
		/**
        $this->objPHPExcel->getActiveSheet()->getStyle('A4')->getFont()->setBold(true); 
        $this->objPHPExcel->getActiveSheet()->getStyle('A4')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID); 
        $this->objPHPExcel->getActiveSheet()->getStyle('A4')->getFill()->getStartColor()->setRGB('969696'); 
        $this->objPHPExcel->getActiveSheet()->duplicateStyle( $this->objPHPExcel->getActiveSheet()->getStyle('A4'), 'B4:'.$this->objPHPExcel->getActiveSheet()->getHighestColumn().'4'); 
        for ($j=1; $j<$i; $j++) { 
            $this->objPHPExcel->getActiveSheet()->getColumnDimension(PHPExcel_Cell::stringFromColumnIndex($j))->setAutoSize(true); 
        } 
        ***/
    } 
         
    function _rows() { 
        $i=5; 
        foreach ($this->data as $row) { 
            $j=0; 
            foreach ($row as $field => $value) { 
                if(!in_array($field,$this->blacklist)) { 
                    $this->objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($j++,$i, $value); 
                } 
            } 
            $i++; 
        } 
    } 
             
    function _output($title, $type = 'CSV') { 
		if ($type == 'Excel5') {
			header("Content-type: application/vnd.ms-excel");  
	        header('Content-Disposition: attachment;filename="'.$title.'.xls"'); 
	        header('Cache-Control: max-age=0'); 
			$this->writer = PHPExcel_IOFactory::createWriter($this->objPHPExcel, 'Excel5');
			
			
		} else if ($type == 'CSV') {
			header("Content-type: text/csv");  
	        header('Content-Disposition: attachment;filename="'.$title.'.csv"'); 
	        header('Cache-Control: max-age=0'); 
	
			$this->objPHPExcel->getActiveSheet()->setCellValue('A1', 'First Name')
			                              ->setCellValue('B1', 'Last Name')
			                              ->setCellValue('C1', 'Age')
			                              ->setCellValue('D1', 'Date of birth')
			                              ->setCellValue('E1', 'Salary');
	
			$this->writer = PHPExcel_IOFactory::createWriter($this->objPHPExcel, 'CSV');
	        
		}
		
		$this->log($this->writer);
        //$this->writer->setTempDir(TMP); 
        $this->writer->save('php://output'); 
    } 
}

?>
