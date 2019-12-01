<?php

defined('BASEPATH') OR exit('No direct script access allowed');

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

class Balance extends CI_Controller {

    function __construct() {
        parent::__construct();
        isAdmin();
        isKena();
        isLogin();
        $this->load->model('main');
    }

    public function index() {
        $data['balances'] = $this->main->getAllBalances();
        $this->load->view('header');
        $this->load->view('balance', $data);
        $this->load->view('footer');
    }

    public function edit() {
        $id = $this->uri->segment(3);
        $data['balances'] = $this->main->getAllBalances();
        $data['balances'] = $this->main->getBalanceByID($id);
        $this->load->view('header');
        $this->load->view('editbalance', $data);
        $this->load->view('footer');
    }

    public function insert() {

        $data = array();
        $data['title'] = $this->input->post('title');
        $data['date'] = $this->input->post('date');
        $data['amount'] = $this->input->post('amount');
        $data['type'] = $this->input->post('type');

        $true = $this->db->insert('balance', $data);
        if ($true) {
            $this->session->set_flashdata('success', 'Balance Successfully Inserted.');
            redirect('balance', 'refresh');
        } else {
            $this->session->set_flashdata('error', 'Opps! Something Wrong');
            redirect('balance', 'refresh');
        }

    }


    public function update() {

        $data = array();

        $id = $this->input->post('id');
        $data['title'] = $this->input->post('title');
        $data['date'] = $this->input->post('date');
        $data['amount'] = $this->input->post('amount');
        $data['type'] = $this->input->post('type');

        $this->db->where('id', $id);
        $true = $this->db->update('balance', $data);
        if ($true) {
            $this->session->set_flashdata('success', 'Balance Successfully Updated.');
            redirect('balance', 'refresh');
        } else {
            $this->session->set_flashdata('error', 'Opps! Something Wrong');
            redirect('balance', 'refresh');
        }

    }


    public function bymonth() {
        $month = $this->input->post('month');
        $year = $this->input->post('year');
        $data['balances'] = $this->main->getBalancesByMonth($month, $year);
        $this->load->view('header');
        $this->load->view('balance', $data);
        $this->load->view('footer');
    }

    public function byyear() {
        $year = $this->input->post('year');
        $data['balances'] = $this->main->getBalancesByYear($year);
        $this->load->view('header');
        $this->load->view('balance', $data);
        $this->load->view('footer');
    }



    public function delete() {
        $id = $this->uri->segment(3);
        $this->db->delete('balance', array('id' => $id));
        $this->session->set_flashdata('success', "Successfully Deleted");
        redirect(base_url() . 'balance', 'refresh');
    }



}

?>
