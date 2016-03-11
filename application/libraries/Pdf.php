<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
 
class Pdf {

    var $pageSize = 'A4';
    function pdf()
    {
        $CI = & get_instance();
        log_message('Debug', 'mPDF class is loaded.');
    }
 
    function load($param=NULL)
    {
        include_once APPPATH.'/third_party/mpdf/mpdf.php';
         
        if ($param == NULL)
        {
            return new mPDF("en-GB-x",$this->pageSize,0,"",15,15,33,25,10,9);

        } else {
            return new mPDF($param);
        }
    }

    function setPageSize($pageSize = 'A4') {
        $this->pageSize = $pageSize;
    }
}