<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');  
 
require_once APPPATH."classes/PHPExcel.php";
require_once APPPATH."classes/PHPExcel/IOFactory.php";
class Excel extends PHPExcel {
    public function __construct() {
        parent::__construct();
    }
}
?>