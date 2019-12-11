<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Barang extends CI_Controller {

    public function index()
    {
        $data['konten'] = "v_barang";
        $this->load->model('barang_model');
        $data['data_barang'] = $this->barang_model->get_barang();
        $this->load->model("Kategori_model");
        $data['data_kategori'] = $this->Kategori_model->get_kategori();
        $this->load->view('template', $data, FALSE);
    }
    public function simpan_barang()
    {
        $this->form_validation->set_rules('nama_barang', 'Nama Barang', 'trim|required', 
        array('required' => 'NAMA BARANG HARUS DIISI!!!'));
        $this->form_validation->set_rules('harga', 'Harga', 'trim|required', 
        array('required' => 'HARGA HARUS DIISI!!!'));
        $this->form_validation->set_rules('stok', 'Stok', 'trim|required', 
        array('required' => 'STOK HARUS DIISI!!!'));
        $this->form_validation->set_rules('id_kategori', 'ID Kategori', 'trim|required', 
        array('required' => 'ID KATEGORI HARUS DIISI!!!'));
        
        if ($this->form_validation->run() == TRUE) {
            $this->load->model('barang_model','brg');
            $masuk = $this->brg->masuk_db();
            if ($masuk == true) {
                $this->session->set_flashdata('pesan', 'Data Sukses Masuk');
            }
            else {
                $this->session->set_flashdata('pesan', 'Data Gagal Masuk');
            }
            
            redirect(base_url('index.php/barang'),'refresh');
            
        } else {
            $this->session->set_flashdata('pesan', validation_errors());
            redirect(base_url('index.php/barang'),'refresh');
        }
        
    }
    public function get_detail_barang($id_barang = '')
    {
        $this->load->model('barang_model');
        $data_detail = $this->barang_model->detail_barang($id_barang);
        echo json_encode($data_detail);
    }
    public function update_barang()
    {
        $this->form_validation->set_rules('nama_barang', 'Nama Barang', 'trim|required');
        $this->form_validation->set_rules('harga', 'Harga', 'trim|required');
        $this->form_validation->set_rules('stok', 'Stok', 'trim|required');
        $this->form_validation->set_rules('id_kategori', 'ID Kategori', 'trim|required');
        
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('pesan', validation_errors());
            redirect(base_url('index.php/barang'),'refresh');
            
        } else {
            $this->load->model('barang_model');
            $proses_update = $this->barang_model->update_barang();
            if ($proses_update) {
                $this->session->set_flashdata('pesan', 'Sukses Update');
            }
            else {
                $this->session->set_flashdata('pesan', 'Gagal Update');
            }
            redirect(base_url('index.php/barang'),'refresh');
            
        }
        
    }
    public function hapus_barang($id_barang)
    {
        $this->load->model('barang_model');
        $proses_hapus = $this->barang_model->hapus_barang($id_barang);
        if ($proses_hapus == TRUE) {
            $this->session->set_flashdata('pesan', 'Sukses Hapus Data');
        }
        else {
            $this->session->set_flashdata('pesan', 'Gagal Hapus Data');
        }
        redirect(base_url('index.php/barang'),'refresh');
    }

}

/* End of file Barang.php */
