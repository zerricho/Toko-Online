<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Trans extends CI_Controller {

    public function index()
    {
        $data['konten'] = "v_pesanan";
        $this->load->view('template_user', $data);
    }
    public function tambah_cart($id_barang, $jumlah)
    {
        $this->load->model('Get_barang_model','gt_brng');
        $dt_detail = $this->gt_brng->get_detail($id_barang);
        $data = array(
                    'id' => $dt_detail->id_barang,
                    'qty' => $jumlah,
                    'price' => $dt_detail->harga,
                    'name' => $dt_detail->nama_barang,
                    'options' => array('kategori' => $dt_detail->nama_kategori) 
                );
        $tambah_cart = $this->cart->insert($data);
        if ($tambah_cart) {
            $dt['total_cart'] = $this->cart->total_items();
            $dt['status'] = 1;
            echo json_encode($dt);
        }
        else {
            $dt['total_cart'] = $this->cart->total_items();
            $dt['status'] = 0;
            echo json_encode($dt);
        }
    }
    public function show_cart_items()
    {
        $dt['total_cart'] = $this->cart->total_items();
        echo json_encode($dt);
    }
    public function tm_pesanan()
    {
        $data['total_seluruh'] = $this->cart->total();
        $data['data_cart'] = $this->cart->contents();
        echo json_encode($data);
    }
    public function simpan_bayar()
    {
        $this->load->model('get_barang_model','gt_brng');
        $buat_nota = $this->gt_brng->buat_nota();
        if ($buat_nota) { 
            $dt_nota = $this->gt_brng->get_last_nota();
            foreach ($this->cart->contents() as $item) {
                $object[] = array('id_nota' => $dt_nota->id_nota,
                                'id_barang' => $item['id'],
                                'qty' => $item['qty']
            );
            }
            $masuk_data = $this->db->insert_batch('transaksi', $object);
            if ($masuk_data) {
                $this->gt_brng->update_total($dt_nota->id_nota);
                $data['status'] = 1;
                $data['id_nota'] = $dt_nota->id_nota;
                $data['total'] = $this->cart->total();
                $this->cart->destroy();
                echo json_encode($data);
            }
            else {
                $data['status'] = 0;
                echo json_encode($data);
            }
        }
    }
    public function upload_bukti()
    {
        
        $config['upload_path'] = './assets/bukti';
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $config['max_size']  = '100000';
        $config['max_width']  = '1024000';
        $config['max_height']  = '768000';
        
        $this->load->library('upload', $config);
        
        if ( ! $this->upload->do_upload('bukti')){
            $error = array('status' => 0,'error' => $this->upload->display_errors());
            echo json_encode($error);
        }
        else{
            $this->load->model('get_barang_model','gt_brng');
            $get_nota_semua = $this->gt_brng->update_bukti();
            $data = array('status' => 1,'upload_data' => $this->upload->data());
            echo json_encode($data);
        }
                
    }
    public function hapus_semua()
	{
		$this->cart->destroy();
		$data['status']=1;
		echo json_encode($data);
	}
    public function hapus_cart($id='')
	{
		$data= array(
			'rowid' => $id,
			'qty' => 0
		);
		$update_cart=$this->cart->update($data);
		if($update_cart){
			$data['status']=1;
			echo json_encode($data);
		}else{
			$data['status']=0;
			echo json_encode($data);
		}
	}
	

}

/* End of file Trans.php */
