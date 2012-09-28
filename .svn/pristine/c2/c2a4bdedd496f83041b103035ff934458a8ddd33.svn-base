<?php

/**
 * Description of Excel
 *
 * @author Alexander
 */
class Excel
{
    private $CI;
    public static $excel_object;


    public function __construct()
    {
        $this->CI =& get_instance();
        
        $this->CI->load->library('phpExcel/phpexcel');
        self::$excel_object = $this->CI->phpexcel;
    }
    
    public function export($titles = array(), $rows = array())
    {
        $excel_datas = array();
        
        foreach($titles as $e)
        {                
            $excel_datas[0][] = $e;
        }
        
        foreach($rows as $e)
        {
            $row = array();
            foreach($titles as $key => $title)
            {                
                $row[] = $e->$key;
            }
            $excel_datas[] = $row;
        }
        
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="01simple.xls"');
        header('Cache-Control: max-age=0');

        
        self::$excel_object->getActiveSheet()->fromArray($excel_datas);
        $objWriter = PHPExcel_IOFactory::createWriter(self::$excel_object, 'Excel5');
        $objWriter->save('php://output');
    }
}
