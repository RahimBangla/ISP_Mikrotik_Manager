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


class Main extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    //Start User Functions
    public function getTopUser() {
        $this->db->limit(10);
        $this->db->order_by('id', 'desc');
        $query = $this->db->get_where('users');
        return $query->result();
    }

    public function getAllUsers() {
        $this->db->order_by('id', 'desc');
        $query = $this->db->get_where('users');
        return $query->result();
    }

    public function getUser($id) {
        $query = $this->db->get_where('users', array('id' => $id));
        if($query->num_rows() > 0){
            return $query->result();
        }else{
            redirect('home', 'refresh');
        }
    }

    public function getUserByID($id) {
        $query = $this->db->get_where('users', array('id' => $id));
        if($query->num_rows() > 0){
            return $query->result();
        }else{
            redirect('home', 'refresh');
        }
    }

    public function getUserByPackageID($id) {
        $query = $this->db->get_where('users', array('package' => $id));
        if($query->num_rows() > 0){
            return $query->result();
        }else{
            return false;
        }
    }

    public function getUserByAreaName($name) {
        $query = $this->db->get_where('users', array('area' => $name));
        if($query->num_rows() > 0){
            return $query->result();
        }else{
            return false;
        }
    }


    public function getUserByStaff($id) {
        $query = $this->db->get_where('users', array('staff' => $id));
        if($query->num_rows() > 0){
            return $query->result();
        }else{
            return false;
        }
    }

    public function getUserDataByID($id) {
        $query = $this->db->get_where('users', array('id' => $id));
        if($query->num_rows() > 0){
            return $query->result()[0];
        }else{
            return false;
        }
    }

    //Start Staff
    //Get Staff BY User ID
    public function getStaff($id) {
        $query = $this->db->get_where('users', array('id' => $id));
        if($query->num_rows() > 0){
            $staff = $query->result()[0]->staff;
            $queryStaff = $this->db->get_where('staff', array('id' => $staff));
            if($queryStaff->num_rows() > 0){
                return $queryStaff->result()[0];
            }
        }else{
            return false;
        }

    }

    public function getAllPackages() {
        $query = $this->db->get_where('package');
        return $query->result();
    }

    public function getPackageByID($id) {
        $query = $this->db->get_where('package', array('packid' => $id));
        if($query->num_rows() > 0){
            return $query->result();
        }else{
            redirect('home', 'refresh');
        }
    }

    public function getAllAreas() {
        $query = $this->db->get_where('area');
        return $query->result();
    }

    public function getAreaByID($id) {
        $query = $this->db->get_where('area', array('id' => $id));
        return $query->result();
    }

    public function getAllStaffs() {
        $query = $this->db->get_where('staff');
        return $query->result();
    }

    public function getStaffByID($id) {
        $query = $this->db->get_where('staff', array('id' => $id));
        return $query->result();
    }

    public function getAllInvoics() {
        $this->db->order_by('invoiceID', 'desc');
        $query = $this->db->get_where('invoice');
        return $query->result();
    }

    public function getAllInvoicsByUser($id) {
        $this->db->order_by('invoiceID', 'desc');
        $query = $this->db->get_where('invoice', array('userid' => $id));
        return $query->result();
    }

    public function getAllPayments() {
        $this->db->order_by('paymentid', 'desc');
        $query = $this->db->get_where('payments');
        return $query->result();
    }

    public function getAllPaymentsByInvoiceID() {
        $this->db->order_by('paymentid', 'desc');
        $query = $this->db->get_where('payments');
        return $query->result();
    }

    public function getPaymentsByMonth($month, $year) {
        $this->db->order_by('paymentid', 'desc');
        $this->db->where('month(saletime)', $month);
        $this->db->where('year(saletime)', $year);
        $query = $this->db->get_where('payments');
        return $query->result();
    }

    public function getPaymentsByYear($year) {
        $this->db->order_by('paymentid', 'desc');
        $this->db->where('year(saletime)', $year);
        $query = $this->db->get_where('payments');
        return $query->result();
    }


    public function getPaymentsSumByMonth($month, $year) {
        $this->db->select_sum('amount');
        $this->db->from('payments');
        $this->db->where('month(saletime)', $month);
        $this->db->where('year(saletime)', $year);
        $sum = $this->db->get();
        if($sum->num_rows() > 0){
            $sum = $sum->result()[0];
            return round($sum->amount);
        }else{
            return 0;
        }
    }

    public function getAllBalances() {
        $this->db->order_by('id', 'desc');
        $query = $this->db->get_where('balance');
        return $query->result();
    }

    public function getBalancesByMonth($month, $year) {
        $this->db->order_by('id', 'desc');
        $this->db->where('month(date)', $month);
        $this->db->where('year(date)', $year);
        $query = $this->db->get_where('balance');
        return $query->result();
    }

    public function getBalancesByYear($year) {
        $this->db->order_by('id', 'desc');
        $this->db->where('year(date)', $year);
        $query = $this->db->get_where('balance');
        return $query->result();
    }

    public function getBalInSumByMonth($month, $year) {
        $this->db->select_sum('amount');
        $this->db->from('balance');
        $this->db->where('type', 'Income');
        $this->db->where('month(date)', $month);
        $this->db->where('year(date)', $year);
        $sum = $this->db->get();
        if($sum->num_rows() > 0){
            $sum = $sum->result()[0];
            return round($sum->amount);
        }else{
            return 0;
        }
    }

    public function getBalExSumByMonth($month, $year) {
        $this->db->select_sum('amount');
        $this->db->from('balance');
        $this->db->where('type', 'Expense');
        $this->db->where('month(date)', $month);
        $this->db->where('year(date)', $year);
        $sum = $this->db->get();
        if($sum->num_rows() > 0){
            $sum = $sum->result()[0];
            return round($sum->amount);
        }else{
            return 0;
        }
    }


    public function getBalanceByID($id) {
        $query = $this->db->get_where('balance', array('id' => $id));
        if($query->num_rows() > 0){
            return $query->result();
        }else{
            redirect('home', 'refresh');
        }
    }


    public function getSettings() {
        $query = $this->db->get_where('settings', array('id' => 1));
        return $query->result();
    }

    public function getBillIDYear($userID, $selectedYear) {
        $this->db->order_by('month', 'asc');
        $query = $this->db->get_where('bills', array('userid' => $userID, 'year' => $selectedYear));
        return $query->result();
    }

    public function getInvoice($id) {
        $query = $this->db->get_where('invoice', array('invoiceID' => $id));
        if($query->num_rows() > 0){
            return $query->result();
        }else{
            redirect('home', 'refresh');
        }
    }

    public function getUserInvoice($id, $userID) {
        $query = $this->db->get_where('invoice', array('invoiceID' => $id, 'userid' => $userID));
        if($query->num_rows() > 0){
            return $query->result();
        }else{
            redirect('home', 'refresh');
        }
    }

    public function getInvoicesByUserID($id) {
        $query = $this->db->get_where('invoice', array('userid' => $id));
        if($query->num_rows() > 0){
            return $query->result();
        }else{
            return false;
        }
    }

    public function getPaymenstsByInvoiceIDs($ids) {
        $this->db->where_in('invoiceid', $ids);
        $query = $this->db->get('payments');
        if($query->num_rows() > 0){
            return $query->result();
        }else{
            return 0;
        }
    }

    public function getAllTickets() {
        $this->db->order_by('ticketID', 'desc');
        $query = $this->db->get_where('ticket');
        return $query->result();
    }

    public function getAllTicketsByUser() {
        $this->db->order_by('ticketID', 'desc');
        $userID = $this->session->userdata('user_id');
        $query = $this->db->get_where('ticket', array('userID' => $userID));
        return $query->result();
    }

    public function getTicketByID($id) {
        $query = $this->db->get_where('ticket', array('ticketID' => $id));
        if($query->num_rows() > 0){
            return $query->result();
        }else{
            redirect('ticket/all', 'refresh');
        }

    }

    public function getTicketCommentByID($id) {
        $query = $this->db->get_where('ticketcomment', array('ticketID' => $id));
        return $query->result();
    }




}
