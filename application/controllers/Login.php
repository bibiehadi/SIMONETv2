<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    function __construct(){
        parent::__construct();
        $this->load->model('login_model','login');
        if($this->session->userdata('logged_in')=== true){
            redirect('dashboard');
        }
    }
    
	public function index()
	{
        $this->load->view('login_view');
    }
    
    public function auth(){
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        $cek = $this->login->login_val($username,$password);
        if($cek->num_rows() > 0){
            $data = $cek->row_array();
            $id = $data['id'];
            $username = $data['username'];
            $email = $data['email'];
            $role = $data['role'];
            $sessdata = array(
                'id' => $id,
                'username' => $username,
                'email' => $email,
                'role' => $role,
                'logged_in' => TRUE
            );
            $this->session->set_userdata($sessdata);

            if($role === 'adm'){
                redirect('dashboard');
            }
        }else{
            $this->session->set_flashdata('login', '<div class="alert alert-dismissable alert-danger">
            <i class="ti ti-close"></i>&nbsp; <strong>Oh snap!</strong> Username atau Password Salah!! Silahkan coba lagi.
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            </div>');
            redirect('login');
        }
    }
    function logout(){
        $this->session->sess_destroy();
        redirect('login');
    }
}
