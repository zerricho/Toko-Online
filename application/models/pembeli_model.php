<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Pembeli_model extends CI_Model {

    public function get_pembeli()
    {
        $data_pembeli = $this->db->get('pembeli')->result();
        return $data_pembeli;
    }
    public function masuk_db()
    {
        $data_pembeli=array(
            'nama_pembeli' => $this->input->post('nama_pembeli'),
            'alamat'=>$this->input->post('alamat'),
            'no_telp'=>$this->input->post('no_telp'),
            'username'=>$this->input->post('username'),
            'password'=>$this->input->post('password'),
        );
        $sql_masuk = $this->db->insert('pembeli', $data_pembeli);
        return $sql_masuk;
    }

    public function detail_pembeli($id_pembeli)
    {
        return $this->db->where('id_pembeli',$id_pembeli)->get('pembeli')->row();
    }
    public function update_pembeli()
    {
        $dt_up_pembeli=array(
            'nama_pembeli'=>$this->input->post('nama_pembeli'),
            'alamat'=>$this->input->post('alamat'),
            'no_telp'=>$this->input->post('no_telp'),
            'username'=>$this->input->post('username'),
            'password'=>$this->input->post('password'),
        );
        return $this->db->where('id_pembeli', $this->input->post('id_pembeli'))->update('pembeli', $dt_up_pembeli);
    }
    public function deletepembeli($id_pembeli)
    {
        $delete = $this->db->where('id_pembeli', $id_pembeli)->delete('pembeli');
        return $delete;
    }

}

/* End of file pembeli_model.php */
