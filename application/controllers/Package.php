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


class Package extends CI_Controller {

    function __construct() {
        parent::__construct();
        isAdmin();
        isKena();
        isLogin();
        $this->load->model('main');
    }

    public function index() {
        $this->load->view('header');
        $this->load->view('insertpack');
        $this->load->view('footer');
    }

    public function insert() {
        $data = array();
        $data['packname'] = $this->input->post('name');
        $data['packvolume'] = $this->input->post('volume');
        $data['packprice'] = $this->input->post('price');
        $data['code'] = $this->input->post('code');
        $data['cost1'] = $this->input->post('cost1');
        $data['cost2'] = $this->input->post('cost2');
        $data['cost3'] = $this->input->post('cost3');
        $data['cost4'] = $this->input->post('cost4');
        $data['cost5'] = $this->input->post('cost5');

        $data['value1'] = $this->input->post('value1');
        $data['value2'] = $this->input->post('value2');
        $data['value3'] = $this->input->post('value3');
        $data['value4'] = $this->input->post('value4');
        $data['value5'] = $this->input->post('value5');

        if(!empty( $this->input->post('value1') )){
            $val1 = $this->input->post('value1');
        }else{
            $val1 = 0;
        }

        if(!empty( $this->input->post('value2') )){
            $val2 = $this->input->post('value2');
        }else{
            $val2 = 0;
        }

        if(!empty( $this->input->post('value3') )){
            $val3 = $this->input->post('value3');
        }else{
            $val3 = 0;
        }

        if(!empty( $this->input->post('value4') )){
            $val4 = $this->input->post('value4');
        }else{
            $val4 = 0;
        }

        if(!empty( $this->input->post('value5') )){
            $val5 = $this->input->post('value5');
        }else{
            $val5 = 0;
        }

        $data['total'] = $val1 + $val2 + $val3 + $val4 + $val5 ;

        $true = $this->db->insert('package', $data);
        if ($true) {
            $this->session->set_flashdata('success', 'Package Successfully Created');
            redirect('package', 'refresh');
        } else {
            $this->session->set_flashdata('error', 'Opps! Something Wrong');
            redirect('package', 'refresh');
        }
    }

    public function all() {
        $data['packages'] = $this->main->getAllPackages();
        $this->load->view('header');
        $this->load->view('allpackage', $data);
        $this->load->view('footer');
    }

    public function edit() {
        $packid = $this->uri->segment(3);
        $data['package'] = $this->main->getPackageByID($packid);
        $this->load->view('header');
        $this->load->view('editpack', $data);
        $this->load->view('footer');
    }

    public function update() {
        $data = array();
        $packid = $this->input->post('packid');
        $data['packname'] = $this->input->post('name');
        $data['packvolume'] = $this->input->post('volume');
        $data['packprice'] = $this->input->post('price');
        $data['code'] = $this->input->post('code');
        $data['cost1'] = $this->input->post('cost1');
        $data['cost2'] = $this->input->post('cost2');
        $data['cost3'] = $this->input->post('cost3');
        $data['cost4'] = $this->input->post('cost4');
        $data['cost5'] = $this->input->post('cost5');

        $data['value1'] = $this->input->post('value1');
        $data['value2'] = $this->input->post('value2');
        $data['value3'] = $this->input->post('value3');
        $data['value4'] = $this->input->post('value4');
        $data['value5'] = $this->input->post('value5');

        if(!empty( $this->input->post('value1') )){
            $val1 = $this->input->post('value1');
        }else{
            $val1 = 0;
        }

        if(!empty( $this->input->post('value2') )){
            $val2 = $this->input->post('value2');
        }else{
            $val2 = 0;
        }

        if(!empty( $this->input->post('value3') )){
            $val3 = $this->input->post('value3');
        }else{
            $val3 = 0;
        }

        if(!empty( $this->input->post('value4') )){
            $val4 = $this->input->post('value4');
        }else{
            $val4 = 0;
        }

        if(!empty( $this->input->post('value5') )){
            $val5 = $this->input->post('value5');
        }else{
            $val5 = 0;
        }

        $data['total'] = $val1 + $val2 + $val3 + $val4 + $val5 ;

        $this->db->where('packid', $packid);
        $true = $this->db->update('package', $data);
        if ($true) {
            $this->session->set_flashdata('success', 'Package Successfully Updated');
            redirect('package', 'refresh');
        } else {
            $this->session->set_flashdata('error', 'Opps! Something Wrong');
            redirect('package', 'refresh');
        }
    }

    public function delete() {
        $packid = $this->uri->segment(3);
        $this->db->delete('package', array('packid' => $packid));
        redirect(base_url() . 'package/all', 'refresh');
    }
}

?>
