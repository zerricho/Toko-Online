<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Barang_model extends CI_Model {

    public function get_barang()
    {
        return $this->db->join('kategori','kategori.id_kategori=barang.id_kategori')->get('barang')->result();
    }

    public function masuk_db()
    {
       
        $config['upload_path'] = './assets/gambar/';
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $config['max_size']  = '10000';
        $config['max_width']  = '102400';
        $config['max_height']  = '76800';
        
        $this->load->library('upload', $config);
        
        if ( ! $this->upload->do_upload(gambar)){
            $this->session->set_flashdata('pesan', $this->upload->display_errors());
            return false;
        }
        else{
            $data_barang=array(
            'nama_barang'=>$this->input->post('nama_barang'),
            'harga'=>$this->input->post('harga'),
            'stok'=>$this->input->post('stok'),
            'id_kategori'=>$this->input->post('id_kategori'),
            'gambar'=>$this->upload->data('file_name'),
            );

            $ql_masuk=$this->db->insert('Barang', $data_barang);
            return $ql_masuk;
        }
    }

    public function detail_barang($id_barang)
    {
        return $this->db->where('id_barang',$id_barang)->get('barang')->row();
    }
    public function update_barang()
    {
        $nama_gambar=$_FILES['gambar']['name'];
        if($nama_gambar!=""){
            $config['upload_path'] = './assets/gambar/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $config['max_size']  = '1000000';
            $config['max_width']  = '1024000';
            $config['max_height']  = '768000';
            
            $this->load->library('upload', $config);
            
            if ( ! $this->upload->do_upload('gambar')){
                $this->session->set_flashdata('pesan', $this->upload->display_errors());
                return false;                
            }
            else{
                $dt_up_barang=array(
                    'nama_barang'=>$this->input->post('nama_barang'),
                    'harga'=>$this->input->post('harga'),
                    'stok'=>$this->input->post('stok'),
                    'id_kategori'=>$this->input->post('id_kategori'),
                    'gambar'=>$this->upload->data('file_name')
                );
                return $this->db->where('id_barang', $this->input->post('id_barang'))->update('barang', $dt_up_barang);
            }
        } else{
            $dt_up_barang=array(
            'nama_barang'=>$this->input->post('nama_barang'),
            'harga'=>$this->input->post('harga'),
            'stok'=>$this->input->post('stok'),
            'id_kategori'=>$this->input->post('id_kategori'),
            'gambar'=>$this->upload->data('file_name')
        );
        return $this->db->where('id_barang', $this->input->post('id_barang'))->update('barang', $dt_up_barang);        }
        
    }
    public function hapus_barang($id_barang)
    {
        $delete = $this->db->where('id_barang', $id_barang)->delete('barang');
        return $delete;
    }

}

/* End of file Barang_model.php */
