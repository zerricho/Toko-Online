<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Get_barang extends CI_Controller {
    
    public function __construct()
    {
        parent::__construct();
        $this->load->model('get_barang_model','gt_brng');
        
    }
    
    public function index()
    {
        $dt_barang = $this->gt_brng->get_barang();
        echo json_encode($dt_barang);
    }
    public function cari($nama_barang ='')
    {
        $dt_barang = $this->gt_brng->cari_get_barang($nama_barang);
        echo json_encode($dt_barang);
    }
    public function detail($id_barang)
    {
        $dt_barang = $this->gt_brng->get_detail($id_barang);
        echo json_encode($dt_barang);
    }

}

/* End of file Get_barang.php */
