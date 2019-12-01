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


class Ticket extends CI_Controller {

    function __construct() {
        parent::__construct();
        // isAdmin();
        isKena();
        isLogin();
        $this->load->model('main');
    }

    public function index() {
        $this->load->view('header');
        $this->load->view('insertticket');
        $this->load->view('footer');
    }

    public function view($id) {
        $data['ticket'] = $this->main->getTicketByID($id);
        $data['comments'] = $this->main->getTicketCommentByID($id);
        $this->load->view('header');
        $this->load->view('viewticket', $data);
        $this->load->view('footer');
    }

    public function insert() {
        $data = array();
        $data['title'] = $this->input->post('title');
        $data['description'] = $this->input->post('description');
        $data['ticketdate'] = date('Y-m-d h:i:s');
        $data['userID'] = $this->session->userdata('user_id');
        $data['status'] = 'Pending';

        $true = $this->db->insert('ticket', $data);
        if ($true) {
            $this->session->set_flashdata('success', 'Ticket Successfully Created');
            redirect('ticket/all/', 'refresh');
        } else {
            $this->session->set_flashdata('error', 'Opps! Something Wrong');
            redirect('ticket/all/', 'refresh');
        }
    }

    public function all() {

        if(notAdmin() == true){ // if admin
            $data['tickets'] = $this->main->getAllTickets();
        }else{ // else current user tickets
            $data['tickets'] = $this->main->getAllTicketsByUser();
        }

        $this->load->view('header');
        $this->load->view('alltickets', $data);
        $this->load->view('footer');
    }

    public function edit($id) {
        $data['ticket'] = $this->main->getTicketByID($id);
        $this->load->view('header');
        $this->load->view('editticket', $data);
        $this->load->view('footer');
    }

    public function update() {
        $data = array();
        $ticketID = $this->input->post('ticketID');

        $data['title'] = $this->input->post('title');
        $data['description'] = $this->input->post('description');

        $this->db->where('ticketID', $ticketID);
        $true = $this->db->update('ticket', $data);
        if ($true) {
            $this->session->set_flashdata('success', 'Ticket Successfully Updated');
            redirect('ticket/all/', 'refresh');
        } else {
            $this->session->set_flashdata('error', 'Opps! Something Wrong');
            redirect('ticket/all/', 'refresh');
        }

    }

    public function delete($id) {
        $this->db->delete('ticket', array('ticketID' => $id));
        redirect('ticket/all/', 'refresh');
    }

    public function comment() {
        $data = array();
        $data['comment'] = $this->input->post('comment');
        $data['commentdate'] = date('Y-m-d h:i:s');
        $data['ticketID'] = $this->input->post('ticketID');
        if(notAdmin()){
            $data['usertype'] = 1; // Admin 1
        }else{
            $data['usertype'] = 2; // User 2
        }


        $true = $this->db->insert('ticketcomment', $data);
        if ($true) {
            $this->session->set_flashdata('success', 'Successfully Commented');
            redirect('ticket/view/' . $data['ticketID'], 'refresh');
        } else {
            $this->session->set_flashdata('error', 'Opps! Something Wrong');
            redirect('ticket/view/' . $data['ticketID'], 'refresh');
        }
    }

    public function solve($id) {
        $data = array();
        $data['status'] = 'Closed';

        $this->db->where('ticketID', $id);
        $true = $this->db->update('ticket', $data);
        if ($true) {
            $this->session->set_flashdata('success', 'Ticket Successfully Close');
            redirect('ticket/all/', 'refresh');
        } else {
            $this->session->set_flashdata('error', 'Opps! Something Wrong');
            redirect('ticket/all/', 'refresh');
        }

    }


}

?>
