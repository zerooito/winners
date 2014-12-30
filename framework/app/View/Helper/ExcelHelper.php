<?php

include_once(APP . 'Vendor' . DS . 'PHPExcel' . DS . 'IOFactory.php');
include_once(APP . 'Vendor' . DS . 'PHPExcel' . DS . 'PHPExcel.php');

class ExcelHelper extends AppHelper { 
     
	var $objPHPExcel;
    var $writer; 
    var $sheet; 
    var $data; 
    var $blacklist = array(); 
     
    public function excelHelper() {
	$this->log('run this'); 
		$this->objPHPExcel = new PHPExcel();
       
        //$this->objPHPExcel->getActiveSheet() = $this->objPHPExcel->getActiveSheet(); 
    } 
                  
    function generate($data, $title = 'Report') { 
         $this->data = $data; 



         $this->_title($title); 
//         $this->_headers(); 
//         $this->_rows(); 
         $this->_output($title); 
         return true; 
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
             
    function _output($title, $type = 'Excel5') { 
		if ($type == 'Excel5') {
			header("Content-type: application/vnd.ms-excel");  
	        header('Content-Disposition: attachment;filename="'.$title.'.xls"'); 
	        header('Cache-Control: max-age=0'); 
			$this->writer = PHPExcel_IOFactory::createWriter($this->objPHPExcel, 'Excel5');
			
			
		} else if ($type == 'CSV') {
			header("Content-type: text/csv");  
	        header('Content-Disposition: attachment;filename="'.$title.'.csv"'); 
	        header('Cache-Control: max-age=0'); 
			$this->writer = PHPExcel_IOFactory::createWriter($this->objPHPExcel, 'CSV');
	        
		}
		
		
        //$this->writer->setTempDir(TMP); 
        $this->writer->save('php://output'); 
    } 
}

?>