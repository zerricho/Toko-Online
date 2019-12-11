<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Kategori extends CI_Controller {

    public function index()
    {
        $data['konten'] = "v_kategori";
        $this->load->model('Kategori_model');
        $data['data_kategori'] = $this->Kategori_model->get_kategori();
        $this->load->view('template', $data, FALSE);
    }
    public function simpan_kategori()
    {
        $this->form_validation->set_rules('nama_kategori', 'Name Category', 'trim|required', 
        array('required' => 'NAMA KATEGORI HARUS DIISI!!!'));
        
        if ($this->form_validation->run() == TRUE) {
            $this->load->model('kategori_model','kat');
            $masuk = $this->kat->masuk_db();
            if ($masuk == true) {
                $this->session->set_flashdata('pesan', 'sukses masuk');
            }
            else {
                $this->session->set_flashdata('pesan', 'gagal masuk');
            }
            
            redirect(base_url('index.php/kategori'),'refresh');
            
        } else {
            $this->session->set_flashdata('pesan', validation_errors());
            redirect(base_url('index.php/kategori'),'refresh');
            
        }
        
    }

}

/* End of file Kategori.php */
