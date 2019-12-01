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

class Bill extends CI_Controller {

    function __construct() {
        parent::__construct();
        isAdmin();
        isKena();
        isLogin();
        $this->load->model('main');
    }

    public function index() {
        $data['users'] = $this->main->getAllUsers();
        $this->load->view('header');
        $this->load->view('insertbill', $data);
        $this->load->view('footer');
    }

    public function insert() {

        $userid = $this->input->post('userid');
        $createdate = $this->input->post('createdate');
        $month = date('F', strtotime($createdate));
        $year = date('Y', strtotime($createdate));
        $user = $this->main->getUser($userid);
        if ($user) {
            $userPackage = $user[0]->package;
        }

        $queryBillEntry = $this->db->get_where('bills', array('month' => $month, 'year' => $year, 'userid' => $userid));
        if ($queryBillEntry->num_rows() == 0) {

            $data = array();
            $data['userid'] = $userid;
            $data['package'] = $userPackage;
            $data['billstatus'] = $this->input->post('status');
            $data['month'] = $month;
            $data['year'] = $year;
            $billTrue = $this->db->insert('bills', $data);

            $invoice = array();
            $invoice['userid'] = $userid;
            $invoice['createdate'] = date('Y-m-d', strtotime($createdate));
            $invoice['duedate'] = date('Y-m-d', strtotime(date('Y-m-d', strtotime($createdate)) . '+15 days'));
            $invoice['status'] = "Unpaid";
            $invoiceTure = $this->db->insert('invoice', $invoice);

            $textMessage = "Dear " . $user[0]->name . ", a new invoice has been generated on" . date('Y-m-d', strtotime($createdate)) . " & Due Date is " . date('Y-m-d', strtotime(date('Y-m-d', strtotime($createdate)) . '+15 days')) . ". Your ISP - " . settings()[0]->name;

            if(settings()[0]->smsonbills == 1){
                $messageSMS = sendSms($user[0]->mobile, $textMessage);
            }
            if(settings()[0]->emailonbills == 1){
                $messageEmail = sendEmail($user[0]->email, 'New Invoice | Your ISP', $textMessage);
            }

            if ($invoiceTure && $billTrue) {
                $this->session->set_flashdata('success', 'Bill & Invice Successfully Created, Email: ' . $messageEmail . ', SMS: ' . $messageSMS);
                redirect('bill', 'refresh');
            } else {
                $this->session->set_flashdata('error', 'Opps! Something Wrong');
                redirect('bill', 'refresh');
            }

        } else {
            $this->session->set_flashdata('error', 'User Already Exist in Bill');
            redirect('bill', 'refresh');
        }
    }

    public function browse() {

        $month = $this->input->post('month');
        $year = $this->input->post('year');

        $this->db->order_by('billid', 'desc');
        $this->db->join('users', 'users.id = bills.userid', 'left');
        $query_paid = $this->db->get_where('bills', array('month' => $month, 'year' => $year, 'billstatus' => 'Paid'));

        $this->db->order_by('billid', 'desc');
        $this->db->join('users', 'users.id = bills.userid', 'left');
        $query_unpaid = $this->db->get_where('bills', array('month' => $month, 'year' => $year, 'billstatus' => 'Unpaid'));

        $query_paid = $query_paid->result();
        $query_unpaid = $query_unpaid->result();

        $data['bills_paid'] = $query_paid;
        $data['bills_unpaid'] = $query_unpaid;
        $this->load->view('header');
        $this->load->view('bills', $data);
        $this->load->view('footer');
    }

    public function delete() {
        $billid = $this->uri->segment(3);
        $this->db->delete('bills', array('billid' => $billid));
        $this->session->set_flashdata('success', "Successfully Deleted");
        redirect(base_url() . 'bill/browse', 'refresh');
    }

    public function makepaid($id) {

        $data = array();
        $data['billstatus'] = "Paid";
        $this->db->where('billid', $id);
        $update_true = $this->db->update('bills', $data);
        if($update_true == true){
            $this->session->set_flashdata('success', "Successfully Upated");
            redirect('bill/browse', 'refresh');
        }else{
            $this->session->set_flashdata('error', "Opps! Something Wrong");
            redirect('bill/browse', 'refresh');
        }

    }


    public function makeunpaid($id) {

        $data = array();
        $data['billstatus'] = "Unpaid";
        $this->db->where('billid', $id);
        $update_true = $this->db->update('bills', $data);
        if($update_true == true){
            $this->session->set_flashdata('success', "Successfully Upated");
            redirect('bill/browse', 'refresh');
        }else{
            $this->session->set_flashdata('error', "Opps! Something Wrong");
            redirect('bill/browse', 'refresh');
        }

    }

    public function autogenerate() {

        $users = $this->main->getAllUsers();
        $createdate = $this->input->post('createdate');
        $duedate = $this->input->post('duedate');
        $month = date('F', strtotime($createdate));
        $year = date('Y', strtotime($createdate));
        $invoicesCounter = 0;
        $billsCounter = 0;
        $i = 0;
        foreach ($users as $user) {
            $i++;
            $queryBillEntry = $this->db->get_where('bills', array('month' => $month, 'year' => $year, 'userid' => $user->id));
            if ($queryBillEntry->num_rows() == 0) {

                $data = array();
                $data['userid'] = $user->id;
                $data['createdate'] = $createdate;
                $data['duedate'] = $duedate;
                $data['status'] = "Unpaid";
                $data['matchid'] = date('d-m-Y-h-') . $user->id . "-" . $i;
                $invoiceTure = $this->db->insert('invoice', $data);
                if($invoiceTure = true){
                    $invoicesCounter = $invoicesCounter + 1;
                }
                $bill = array();
                $bill['userid'] = $user->id;
                $bill['package'] = $user->package;
                $bill['billstatus'] = "Unpaid";
                $bill['matchid'] = date('d-m-Y-h-') . $user->id . "-" . $i;
                $bill['month'] = date('F', strtotime($createdate));
                $bill['year'] = date('Y', strtotime($createdate));
                $billTrue = $this->db->insert('bills', $bill);
                if($billTrue  = true){
                    $billsCounter = $billsCounter + 1;
                }

                $textMessage = "Dear " . $user->name . ", a new invoice has been generated on" . date('Y-m-d', strtotime($createdate)) . " & Due Date is " . date('Y-m-d', strtotime(date('Y-m-d', strtotime($createdate)) . '+15 days')) . ". Your ISP - " . settings()[0]->name;

                if(settings()[0]->smsonbills == 1){
                    $message = sendSms($user->mobile, $textMessage);
                }
                if(settings()[0]->emailonbills == 1){
                    $message = sendEmail($user->email, 'New Invoice | Your ISP', $textMessage);
                }

            }
        }

        $this->session->set_flashdata('success', $invoicesCounter  . " Invoices & " . $billsCounter . " Bills Created Successfully");
        redirect('bill', 'refresh');
    }

}

?>
