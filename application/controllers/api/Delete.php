<?php
defined('BASEPATH') or exit('No direct script access allowed');

require './application/libraries/RestController.php';

use chriskacerguis\RestServer\RestController;

class Delete extends RestController
{


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
        if ($id == null){
          $this->response(['status' => False, 'message' => "masukkan id_mapel"], RestController::HTTP_NOT_FOUND);
        }
        else{
          $status = $this->mapel->delete($id);
          if ($status['data'] == 0){
            $this->response(['status' => False, 'message' => "id_mapel yang anda masukkan tidak ada didalam database"], RestController::HTTP_NOT_FOUND);
          }else{
            $this->response(['status' => true, 'message' => "data berhasil dihapus" ], RestController::HTTP_OK);
          }

        }

    }
    
}