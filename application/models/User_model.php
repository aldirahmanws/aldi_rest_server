<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_Model extends CI_Model {
	public function __construct()
	{
		parent::__construct();
	}

	public function insert(){
		$config['upload_path']          = './uploads/';
        $config['allowed_types']        = 'gif|jpg|png';
        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('image')) {
            $data = $this->upload->display_errors();
        } else {
            $fileData = $this->upload->data();
            $data = $fileData['file_name'];
        }

		$data = array(
			'id'				=> NULL,
			'username'			=> $this->input->post('username'),
			'email'		=> $this->input->post('email'),
			'image'	=> $data
		);
		$this->db->insert('tb_user', $data);
		
		if($this->db->affected_rows() > 0){
			return true;
		} else {
			return false;
			
		}
	}

	public function cek_username(){
		return $this->db->where('username', $this->input->post('username'))->get('tb_user')->num_rows();
	}
}