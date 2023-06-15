<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require './application/libraries/RestController.php';

use chriskacerguis\RestServer\RestController;

class Mapel extends RestController {


    public function __construct()
    {
        // Construct the parent class
        parent::__construct();
        $this->load->model('Mapelmodel', 'mapel');
        $this->methods['index_get']['limit'] = 5;
    }

    public function index_get()
{

        $id = $this->get('id_mapel', true);
    if ($id === null) {
    $p = $this->get('page', true);
    $p = (empty($p) ? 1 : $p);
    $total_data = $this->mapel->count();
    $total_page = ceil($total_data / 5);
      $start = ($p - 1) * 5;
    $list = $this->mapel->get(null, 5, $start);
    if ($list) {
        $data = [
        'status' => true,
        'page' => $p,
        'total_data' => $total_data,
        'total_page' => $total_page,
        'data' => $list
        ];
    } else {
        $data = [
        'status' => false,
        'msg' => 'Data tidak ditemukan'
        ];
    }
    $this->response($data, RestController::HTTP_OK);
    } else {
    $data = $this->mapel->get($id);
    if ($data) {
        $this->response(['status' => true, 'data' => $data], RestController::HTTP_OK);
    } else {
        $this->response(['status' => false, 'msg' => $id . ' tidak ditemukan'], RestController::HTTP_NOT_FOUND);
    }
    }
}

    public function index_post()
    {
        $data = array(
            'id_mapel' => $this->post('nip'),
            'nama_mapel' => $this->post('nama_mapel'),
            'level' => $this->post('level'),
            
            
        );
        $insert = $this->db->insert('tb_matapelajaran', $data);

        if ($insert) {
            $this->response($data, RestController::HTTP_OK);
        } else {
            $this->response(array('status' => 'failed', 502));
        }
    }

    public function index_put()
    {

        $id = $this->put('id_mapel');

        $data = array(
            //'id_mapel' => $this->put('nip'),
            'nama_mapel' => $this->put('nama_mapel'),
            'level' => $this->put('level'),
            
            
        );
        $this->db->where('id_mapel', $id);
        $update = $this->db->update('tb_matapelajaran', $data);

        if ($update) {
            $this->response($data, RestController::HTTP_OK);
        } else {
            $this->response(array('status' => 'failed', 502));
        }
    }
    function index_delete() {
        $id = $this->delete('id_mapel');
		
				
        $this->db->where('id_mapel', $id);
        $delete = $this->db->delete('tb_matapelajaran');
        if ($delete) {
            $this->response(array('status' => 'success'), 201);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }
}