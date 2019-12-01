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

class Area extends CI_Controller {

    function __construct() {
        parent::__construct();
        isAdmin();
        isKena();
        isLogin();
        $this->load->model('main');
    }

    public function index() {
        $data['area'] = $this->main->getAllAreas();
        $this->load->view('header');
        $this->load->view('area', $data);
        $this->load->view('footer');
    }

    public function edit() {
        $id = $this->uri->segment(3);
        $data['area'] = $this->main->getAllAreas();
        $data['singleArea'] = $this->main->getAreaByID($id);
        $this->load->view('header');
        $this->load->view('editarea', $data);
        $this->load->view('footer');
    }

    public function insert() {
        $data = array();
        $data['name'] = $this->input->post('name');
        $true = $this->db->insert('area', $data);
        if ($true) {
            $this->session->set_flashdata('success', 'Successfully Added');
            redirect(base_url() . 'area/');
        } else {
            $this->session->set_flashdata('error', 'Opps! Something Wrong');
            redirect(base_url() . 'area');
        }
    }

    public function update() {
        $data = array();
        $id = $this->input->post('id');
        $data['name'] = $this->input->post('name');

        $this->db->where('id', $id);
        $true = $this->db->update('area', $data);

        if ($true) {
            $this->session->set_flashdata('success', 'Successfully Upated');
            redirect(base_url() . 'area/');
        } else {
            $this->session->set_flashdata('error', 'Opps! Something Wrong');
            redirect(base_url() . 'area');
        }
    }


    public function delete() {
        $areaid = $this->uri->segment(3);
        $true = $this->db->delete('area', array('id' => $areaid));
        if ($true) {
            $this->session->set_flashdata('success', 'Successfully Deleted');
            redirect(base_url() . 'area/');
        } else {
            $this->session->set_flashdata('error', 'Opps! Something Wrong');
            redirect(base_url() . 'area');
        }
    }
}

?>
