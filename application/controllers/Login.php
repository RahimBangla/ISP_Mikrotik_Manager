<?php defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -----------------------------------------------------
| PRODUCT NAME: ZAL - ISP MANAGEMENT SYSTEM
| -----------------------------------------------------
| AUTHOR: ONEZEROART TEAM
| -----------------------------------------------------
| EMAIL: support@onezeroart.com
| -----------------------------------------------------
| COPYRIGHT: RESERVED BY ONEZEROART.COM
| -----------------------------------------------------
| AUTHOR PORTFOLIO: https://codecanyon.net/user/onezeroart/portfolio
| -----------------------------------------------------
| WEBSITE: http://onezeroart.com
| -----------------------------------------------------
*/


class Login extends CI_Controller {

    Public function index() {
        if ($this->session->userdata('logged_in')) {
            redirect('home', 'refresh');
        } else {
            $this->load->model('main');
            $data['packages'] = $this->main->getAllPackages();
            $this->load->view('login', $data);
        }
    }

    Public function register() {
        if ($this->session->userdata('logged_in')) {
            redirect('home', 'refresh');
        } else {
            $this->load->model('main');
            $data['packages'] = $this->main->getAllPackages();
            $this->load->view('register', $data);
        }
    }

    public function insert() {
        $data = array();

        $data['name'] = $this->input->post('name');
        $data['mobile'] = $this->input->post('mobile');
        $data['package'] = $this->input->post('package');
        $data['user_id'] = "ID" . date('Ymd');
        $data['password'] = "PASS" . date('Ymd');
        $data['join_date'] = date('Y-m-d');
        $data['email'] = $this->input->post('email');
        $data['pass'] = md5($this->input->post('accpass'));
        $data['role'] = "User";
        $data['status'] = "Pending";
        $data['location'] = $this->input->post('location');
        $true = $this->db->insert('users', $data);
        if ($true) {

            redirect('login', 'refresh');
        } else {
            redirect('login', 'refresh');
        }
    }

    function checkinguser() {
        $email = $this->input->post('email');
        $password = md5($this->input->post('password'));
        $query = $this->db->get_where('users', array('email' => $email, 'pass' => $password));
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $newdata = array(
                    'user_id' => $row->id,
                    'user_email' => $row->email,
                    'user_role' => $row->role,
                    'logged_in' => TRUE,
                );
            }
            $this->session->set_userdata($newdata);
            redirect('home', 'refresh');
        } else {
            redirect('home', 'refresh');
        }
    }

    function logout() {
        $this->session->unset_userdata('user_email');
        $this->session->unset_userdata('logged_in', FALSE);
        redirect('home');
    }
}
