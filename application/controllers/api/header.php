<?php 
use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Header extends REST_Controller {
    public function __construct(){
        parent::__construct();
        $this->load->model('Header_model','header');
    }

    public function index_get() {
        $nomor_peb = $this->get('NOMOR_DAFTAR');
        $tahun = $this->get('YEAR(TANGGAL_DAFTAR)');
        $bulan = $this->get('MONTH(TANGGAL_DAFTAR)');

    if ($nomor_peb === null && $tahun === null && $bulan === null){
        $header = $this->header->getHeader($nomor_peb = null,$tahun, $bulan = null);

    } else if ($nomor_peb === null && $tahun != null && $bulan === null){
        $header = $this->header->getHeader($nomor_peb = null,$tahun, $bulan = null);

    } else if ($nomor_peb != null && $tahun === null && $bulan === null ){
        $header = $this->header->getHeader($nomor_peb, $tahun = null, $bulan = null) ;

    } else if ($nomor_peb != null && $tahun != null && $bulan === null){
        $header = $this->header->getHeader($nomor_peb, $tahun, $bulan = null);
    
    } else if ($nomor_peb === null && $tahun != null && $bulan != null){
        $header = $this->header->getHeader($nomor_peb = null, $tahun, $bulan);

    }   else if ($nomor_peb != null && $tahun != null && $bulan != null){
        $header = $this->header->getHeader($nomor_peb, $tahun, $bulan);
    }  

        // jika ketemu $header maka confer to json
        if ($header){
            $this->response([
                'status' => true,'data' => $header
            ], REST_Controller::HTTP_OK); 
        } else{
            $this->response([
                'status' => false,'message' => 'data not found'
            ], REST_Controller::HTTP_NOT_FOUND); 

        }    
    }
}

?>