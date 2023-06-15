<?php 
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Mapelmodel extends CI_Model
{

	public function __construct()
	{
		parent::__construct();
	}

	public function get($id = null) {
		//return $this->db->get($table);

		if ($id === null) {
            return $this->db->get('tb_matapelajaran')->result();
        } else {
            return $this->db->get_where('tb_matapelajaran', ['id_mapel' => $id])->result_array();
        }
        }
    
        public function count()
        {
        return $this->db->get('tb_matapelajaran')->num_rows();
		}

	function insert_data($data,$table){
        $this->db->insert($table,$data);
}


function edit_data($where,$table){		
return $this->db->get_where($table,$where);
}

function update_data($where,$data,$table){
    $this->db->where($where);
    $this->db->update($table,$data);
}

public function delete($id = null)
{
  try {
    $this->db->delete('tb_matapelajaran', ['id_mapel' => $id]);
    $error = $this->db->error();
    if (!empty($error['code'])) {
      throw new Exception('Terjadi kesalahan: ' . $error['message']);
      return false;
    }
    return ['status' => true, 'data' => $this->db->affected_rows()];
  } catch (Exception $ex) {
    return ['status' => false, 'msg' => $ex->getMessage()];
  }
}
}
