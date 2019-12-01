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

class Verify extends CI_Controller {

    function __construct() {
        parent::__construct();
        //isAdmin();
        isLogin();
        $this->load->model('main');
    }

    public function index() {
        $this->load->view('verify');
    }

    public function kenadekha() {
        $data['kenadekha'] = $this->input->post('purchasecode');
        $this->db->where('id', 1);
        $this->db->update('settings', $data);
        $this->session->set_flashdata('success', 'Purchase Code Verifying...');
        redirect('home', 'refresh');
    }

}

?>
