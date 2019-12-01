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


use Mailgun\Mailgun;
use PEAR2\Net\RouterOS;

if (!function_exists('settings')) {
    function settings() {
        $ci = & get_instance(); //get main CodeIgniter object
        $ci->load->database(); //load databse library
        $query = $ci->db->get_where('settings', array('id' => 1));
        return $query->result();
    }
}

if (!function_exists('logo')) {
    function logo() {
        $ci = & get_instance(); //get main CodeIgniter object
        $ci->load->database(); //load databse library
        $query = $ci->db->get_where('settings', array('id' => 1));
        if($query->num_rows() > 0){
            return $query->result()[0]->logo;
        }else{
            return " ";
        }

    }
}

if (!function_exists('favicon')) {
    function favicon() {
        $ci = & get_instance(); //get main CodeIgniter object
        $ci->load->database(); //load databse library
        $query = $ci->db->get_where('settings', array('id' => 1));
        if($query->num_rows() > 0){
            return $query->result()[0]->favicon;
        }else{
            return " ";
        }
    }
}

if (!function_exists('currentUsername')) {
    function currentUsername() {
        $ci = & get_instance(); //get main CodeIgniter object
        $ci->load->database(); //load databse library
        $userID = $ci->session->userdata('user_id');
        $query = $ci->db->get_where('users', array('id' => $userID));
        if($query->num_rows() > 0){
            return $query->result()[0]->name;
        }else{
            return " ";
        }
    }
}

if (!function_exists('currentUserPhoto')) {
    function currentUserPhoto() {
        $ci = & get_instance(); //get main CodeIgniter object
        $ci->load->database(); //load databse library
        $userID = $ci->session->userdata('user_id');
        $query = $ci->db->get_where('users', array('id' => $userID));
        if($query->num_rows() > 0){
            return $query->result()[0]->photo;
        }else{
            return " ";
        }
    }
}

if (!function_exists('currentUserID')) {
    function currentUserID() {
        $ci = & get_instance(); //get main CodeIgniter object
        return $ci->session->userdata('user_id');
    }
}


if (!function_exists('getUser')) {
    function getUser($id) {
        $ci = & get_instance(); //get main CodeIgniter object
        $ci->load->database(); //load databse library
        $query = $ci->db->get_where('users', array('id' => $id));
        if($query->num_rows() > 0){
            return $query->result()[0];
        }else{
            return false;
        }
    }
}

// Get User Profile By PPPoE User
if (!function_exists('pppoeUser')) {
    function pppoeUser($user) {
        $ci = & get_instance(); //get main CodeIgniter object
        $ci->load->database(); //load databse library
        $query = $ci->db->get_where('users', array('pppoe_name' => $user));
        if($query->num_rows() > 0){
            return $query->result()[0];
        }else{
            return false;
        }
    }
}
// Get User Profile By PPPoE User
if (!function_exists('hotspotUser')) {
    function hotspotUser($user) {
        $ci = & get_instance(); //get main CodeIgniter object
        $ci->load->database(); //load databse library
        $query = $ci->db->get_where('users', array('hotspot_name' => $user));
        if($query->num_rows() > 0){
            return $query->result()[0];
        }else{
            return false;
        }
    }
}


if (!function_exists('countRow')) {
    function countRow($table, $where, $id) {
        $ci = & get_instance(); //get main CodeIgniter object
        $ci->db->from($table);
        $ci->db->like($where, $id);
        return $ci->db->count_all_results();
    }
}


if (!function_exists('countRow2')) {
    function countRow2($table, $where, $id, $where2, $this2) {
        $ci = & get_instance(); //get main CodeIgniter object
        $ci->db->from($table);
        $ci->db->like($where, $id);
        $ci->db->like($where2, $this2);
        return $ci->db->count_all_results();
    }
}


if (!function_exists('isAdmin')) {
    function isAdmin() {
        $ci = & get_instance(); //get main CodeIgniter object
        $loggedIn = $ci->session->userdata('logged_in');
        $userRole = $ci->session->userdata('user_role');
        $userID = $ci->session->userdata('user_id');
        if (!$loggedIn) {
            return redirect('login', 'refresh');
        } elseif ($userRole !== "Admin") {
            return redirect('user/view/' . $userID, 'refresh');
        }
    }
}

if (!function_exists('notAdmin')) {
    function notAdmin() {
        $ci = & get_instance(); //get main CodeIgniter object
        $userRole = $ci->session->userdata('user_role');
        if ($userRole !== "Admin") {
            return false;
        }else{
            return true;
        }
    }
}

if (!function_exists('isLogin')) {
    function isLogin() {
        $ci = & get_instance(); //get main CodeIgniter object
        $loggedIn = $ci->session->userdata('logged_in');
        if (!$loggedIn) {
            return redirect('login', 'refresh');
        }
    }
}

if (!function_exists('package')) {
    function package($packid) {
        $ci = & get_instance(); //get main CodeIgniter object
        $ci->load->database(); //load databse library
        $query = $ci->db->get_where('package', array('packid' => $packid));
        if($query->num_rows() > 0){
            return $query->result()[0];
        }else{
            return false;
        }

    }
}


if (!function_exists('packageByName')) {
    function packageByName($packname) {
        $ci = & get_instance(); //get main CodeIgniter object
        $ci->load->database(); //load databse library
        $query = $ci->db->get_where('package', array('packname' => $packname));
        if($query->num_rows() > 0){
            return $query->result()[0];
        }else{
            return 0; //If Package Not Found Then Select Basic
        }

    }
}


if (!function_exists('invoiceByUser')) {
    function invoiceByUser($id) {
        $ci = & get_instance(); //get main CodeIgniter object
        $ci->load->database(); //load databse library
        $query = $ci->db->get_where('invoice', array('userid' => $id));
        if($query->num_rows() > 0){
            return $query->result()[0];
        }else{
            return 0; //If Package Not Found Then Select Basic
        }

    }
}


if (!function_exists('invoiceByID')) {
    function invoiceByID($id) {
        $ci = & get_instance(); //get main CodeIgniter object
        $ci->load->database(); //load databse library
        $query = $ci->db->get_where('invoice', array('invoiceID' => $id));
        if($query->num_rows() > 0){
            return $query->result()[0];
        }else{
            return 0; //If Package Not Found Then Select Basic
        }

    }
}


if (!function_exists('staffByName')) {
    function staffByName($staffname) {
        $ci = & get_instance(); //get main CodeIgniter object
        $ci->load->database(); //load databse library
        $query = $ci->db->get_where('staff', array('name' => $staffname));
        if($query->num_rows() > 0){
            return $query->result()[0];
        }else{
            return 0; // If Staff Not Found Then Select First One
        }

    }
}


if (!function_exists('staffByID')) {
    function staffByID($staffID) {
        $ci = & get_instance(); //get main CodeIgniter object
        $ci->load->database(); //load databse library
        $query = $ci->db->get_where('staff', array('id' => $staffID));
        if($query->num_rows() > 0){
            return $query->result()[0];
        }else{
            return 0; // If Staff Not Found Then Select First One
        }

    }
}

if (!function_exists('countUserByStaff')) {
    function countUserByStaff($staff) {
        $ci = & get_instance(); //get main CodeIgniter object
        $ci->load->database(); //load databse library
        $query = $ci->db->get_where('users', array('staff' => $staff));
        if($query->num_rows() > 0){
            return $query->num_rows();
        }else{
            return 0; // If Staff Not Found Then Select First One
        }

    }
}


// if (!function_exists('areaByName')) {
//     function staffByName($staffname) {
//         $ci = & get_instance(); //get main CodeIgniter object
//         $ci->load->database(); //load databse library
//         $query = $ci->db->get_where('staff', array('name' => $staffname));
//         if($query->num_rows() > 0){
//             return $query->result()[0];
//         }else{
//             return 0; // If Staff Not Found Then Select First One
//         }
//
//     }
// }

if (!function_exists('countUserByArea')) {
    function countUserByArea($area) {
        $ci = & get_instance(); //get main CodeIgniter object
        $ci->load->database(); //load databse library
        $query = $ci->db->get_where('users', array('area' => $area));
        if($query->num_rows() > 0){
            return $query->num_rows();
        }else{
            return 0; // If Staff Not Found Then Select First One
        }

    }
}

if (!function_exists('kenadekha')) {
    function kenadekha() {
		return true;
    }
}

if (!function_exists('isKena')) {
    function isKena() {
        if(kenadekha()  == false){
            redirect('verify', 'refresh');
        }
    }
}


if (!function_exists('convertCurrency')) {
    function convertCurrency($amount, $from, $to) {
        $data = file_get_contents("https://finance.google.com/finance/converter?a=$amount&from=$from&to=$to");
        preg_match("/<span class=bld>(.*)<\/span>/",$data, $converted);
        $converted = preg_replace("/[^0-9.]/", "", $converted[1]);
        return number_format(round($converted, 3),2);
    }
}

//Sending Email
if (!function_exists('sendEmail')) {
    function sendEmail($email, $emailsubject, $textMessage) {

        $ci = & get_instance(); //get main CodeIgniter object
        $ci->load->database(); //load databse library

        if(settings()[0]->emailapi == "Mailgun"){

            $mg = Mailgun::create($ci->config->item('mailgun_api'));
            try{
                $mg->messages()->send($ci->config->item('mailgun_domain'), [
                  'from'    => $ci->config->item('mailgun_from'),
                  'to'      => $email,
                  'subject' => character_limiter(strip_tags($emailsubject), 50),
                  'text'    => strip_tags($textMessage),
                  'html'    => $textMessage
                ]);

                $data = array();
                $data['time'] = date('d-m-Y H:i:s');
                $data['emailTo'] = $email;
                $data['emailSubject'] = character_limiter(strip_tags($emailsubject), 50);
                $data['message'] = character_limiter(strip_tags($textMessage), 300);
                $data['network'] = 'Mailgun';
                $ci->global_m->globalInsert('email', $data);

                return '';
            }catch(\Exception $e){
                return $e->getMessage();
            }

        }

    }
}


//Sending SMS
if (!function_exists('sendSms')) {
    function sendSms($number, $textMessage) {

        $ci = & get_instance(); //get main CodeIgniter object
        $ci->load->database(); //load databse library

        if(settings()[0]->smsapi == "Nexmo"){

            //Nexmo API
            $client = new Nexmo\Client(new Nexmo\Client\Credentials\Basic($ci->config->item('nexmo_api'), $ci->config->item('nexmo_secret')));
            try{
                $message = $client->message()->send([
                    'to' => $number,
                    'from' => $ci->config->item('nexmo_from'),
                    'text' => character_limiter(strip_tags($textMessage), 160)
                ]);

                $data = array();
                $data['time'] = date('d-m-Y H:i:s');
                $data['to'] = $message['to'];
                $data['message'] = character_limiter(strip_tags($textMessage), 160);
                $data['messageid'] = $message['message-id'];
                $data['remainingbalance'] = $message['remaining-balance'];
                $data['messageprice'] = $message['message-price'];
                $data['network'] = $message['network'];
                $insert = $ci->global_m->globalInsert('sms', $data);
                return '';
            }catch(\Exception $e){
                return $e->getMessage();
            }

        }else if(settings()[0]->smsapi == "Twilio"){

            $account_sid = $ci->config->item('twilio_sid');
            $auth_token = $ci->config->item('twilio_token');
            $twilio_number = $ci->config->item('twilio_sender');
            $client = new Twilio\Rest\Client($account_sid, $auth_token);
            try{
                $message = $client->messages->create(
                    $number, //To Number
                    array(
                        'from' => $twilio_number,
                        'body' => character_limiter(strip_tags($textMessage), 160)
                    )
                );

                $data = array();
                $data['time'] = date('d-m-Y H:i:s');
                $data['to'] = $number;
                $data['message'] = character_limiter(strip_tags($textMessage), 160);
                $data['messageid'] = 'N/A';
                $data['remainingbalance'] = 'N/A';
                $data['messageprice'] = 'N/A';
                $data['network'] = 'N/A';
                $insert = $ci->global_m->globalInsert('sms', $data);
                return '';
            }catch(\Exception $e){
                return $e->getMessage();
            }

        }

    }
}


// Mikrotik API
if (!function_exists('mkClient')) {
    function mkClient() {
        return new RouterOS\Client(settings()[0]->mkipadd, settings()[0]->mkuser, settings()[0]->mkpassword);
    }
}
// Mikrotik API Util
if (!function_exists('mkUtil')) {
    function mkUtil() {
        return new RouterOS\Util(mkClient());
    }
}
