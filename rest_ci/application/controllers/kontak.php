<?php

defined('BASEPATH') OR exit('No direct script access allowed'); //membuka file secara langsung tidak diizinkan

require APPPATH . '/libraries/REST_Controller.php'; // membutuhkan library rest controller
use Restserver\Libraries\REST_Controller; //menggunakan library ada direktori Restserver/Library/REST_Controller

class Kontak extends REST_Controller { //kelas kontak turunan dari rest_controller

    function __construct($config = 'rest') { //fungsi construct
        parent::__construct($config); //parent dari fungsi construct
        $this->load->database(); //memanggil database
    }

    function index_get() { //fungsi bernama index_get
        $id = $this->get('id'); //memanggil id dengan method get
        if ($id == '') { //if id sama dengan yang dipanggil oleh user, maka...
            $kontak = $this->db->get('telepon')->result(); //memanggil telepon dari database kontak
        } else {
            $this->db->where('id', $id); //memanggil id dari database kontak
            $kontak = $this->db->get('telepon')->result(); //memanggil id dari databas kontak
        }
        $this->response($kontak, 200); //munculkan respon berhasil
    }

    function index_post() { //fungsi index_post
        $data = array( //membuat array
                    'id'           => $this->post('id'),  //membuat form input id untuk diinput oleh user
                    'nama'         => $this->post('nama'), //membuat form input nama untuk diinput oleh user
                    'nomor'        => $this->post('nomor')); //membuat form input nomor untuk diinput oleh user
        $insert = $this->db->insert('telepon', $data); //script insert data ke database
        if ($insert) { //fungsi if untuk mengarahkan jika post gagal atau berhasil
            $this->response($data, 200); //munculkan respon berhasil
        } else {
            $this->response(array('status' => 'fail', 502)); //munculkan respon gagal
        }
    }

    function index_put() { //fungsi bernama index_put
        $id = $this->put('id'); //deklarasi update dengan memanggil id
        $data = array( //membuat array
                    'id'       => $this->put('id'), //membuat form input id untuk diinput oleh user
                    'nama'     => $this->put('nama'), //membuat form input nama untuk diinput oleh user
                    'nomor'    => $this->put('nomor')); //membuat form input nomor untuk diinput oleh user
        $this->db->where('id', $id); //deklaras letak id yang ingin diupdate
        $update = $this->db->update('telepon', $data); //script update data ke database
        if ($update) { //fungsi if untuk mengarahkan jika put gagal atau berhasil
            $this->response($data, 200); //munculkan respon berhasil
        } else {
            $this->response(array('status' => 'fail', 502)); //munculkan respon gagal
        }
    }

    function index_delete() { //fungsi bernama index_delete
        $id = $this->delete('id'); //deklarasi delete dengan memanggil id
        $this->db->where('id', $id); //deklaras letak id yang ingin di delete
        $delete = $this->db->delete('telepon'); //script delete data ke database
        if ($delete) { //fungsi if untuk mengarahkan jika delete gagal atau berhasil
            $this->response(array('status' => 'success'), 201); //munculkan respon berhasil
        } else {
            $this->response(array('status' => 'fail', 502)); //munculkan respon gagal
        }
    }

}
?>