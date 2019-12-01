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

use PEAR2\Net\RouterOS;

class Pppoe extends CI_Controller {

    function __construct() {
        parent::__construct();
        isLogin();
        isKena();
        $this->load->model('main');
    }

    public function index() {
        $data = array();
        $data['logs'] = '';
        $data['online'] = '';
        $data['profiles'] = '';
        $data['error'] = '';
        $data['users'] = $this->main->getAllUsers();
        try {
            $data['profiles'] = mkUtil()->setMenu('/ppp profile')->getAll();
            $data['online'] = mkUtil()->setMenu('/ppp active')->getAll();
        } catch (Exception $e) {
            $data['error'] =  $e->getMessage();
        }

        $this->load->view('header');
        $this->load->view('allpppoe', $data);
        $this->load->view('footer');

    }



    public function insert() {
        $data = array();
        $this->form_validation->set_rules('user', 'Connect User', 'required');
        $this->form_validation->set_rules('name', 'PPPoE Name', 'required|is_unique[users.pppoe_name]');
        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('error', validation_errors());
            redirect('pppoe', 'refresh');
        } else {
            $data['pppoe_name'] = $this->input->post('name');
            $data['pppoe_password'] = $this->input->post('password');
            $data['pppoe_service'] = $this->input->post('service');
            $data['pppoe_profile'] = $this->input->post('profile');
            $this->db->where('id', $this->input->post('user'));
            $true = $this->db->update('users', $data);
            if ($true) {
                try {

                    $util = new RouterOS\Util(
                        $client = new RouterOS\Client(settings()[0]->mkipadd, settings()[0]->mkuser, settings()[0]->mkpassword)
                    );
                    $util->setMenu('/ppp secret');
                    $util->add(
                        array(
                            'name' => $this->input->post('name'),
                            'password' => $this->input->post('password'),
                            'service' => $this->input->post('service'),
                            'profile' => $this->input->post('profile')
                        )
                    );

                    $this->session->set_flashdata('success', 'PPPoE User Successfully Created');
                    redirect('pppoe', 'refresh');

                } catch (Exception $e) {
                    $data['error'] = $e->getMessage();

                    $this->session->set_flashdata('error', $data['error']);
                    redirect('pppoe', 'refresh');
                }
            } else {
                $this->session->set_flashdata('error', 'Opps! Something Wrong');
                redirect('user', 'refresh');
            }
        }
    }


    public function enable($name){
        try {
            $util = new RouterOS\Util(
                $client = new RouterOS\Client(settings()[0]->mkipadd, settings()[0]->mkuser, settings()[0]->mkpassword)
            );

            //if user connection type api pppoe then do this
            $printRequest = new RouterOS\Request('/ppp/secret/print');
            $printRequest->setArgument('.proplist', '.id');
            $printRequest->setQuery(RouterOS\Query::where('name', $name));
            $apiID = $client->sendSync($printRequest)->getProperty('.id');
            //$id now contains the ID of the entry we're targeting

            if($apiID){
                $enableRequest = new RouterOS\Request('/ppp/secret/enable');
                $enableRequest->setArgument('numbers', $apiID);
                $client->sendSync($enableRequest);

                $this->session->set_flashdata('success', 'PPPoE User Successfully Enabled');
                redirect('user/all', 'refresh');
            }

            $this->session->set_flashdata('error', 'Opps! User Not Found on NAS.');
            redirect('user/all', 'refresh');


        } catch (Exception $e) {
            $data['error'] = $e->getMessage();
            $this->session->set_flashdata('error', $data['error']);
            redirect('user/all', 'refresh');
        }
    }

    public function disable($name){
        try {
            $util = new RouterOS\Util(
                $client = new RouterOS\Client(settings()[0]->mkipadd, settings()[0]->mkuser, settings()[0]->mkpassword)
            );

            //if user connection type api pppoe then do this
            $printRequest = new RouterOS\Request('/ppp/secret/print');
            $printRequest->setArgument('.proplist', '.id');
            $printRequest->setQuery(RouterOS\Query::where('name', $name));
            $apiID = $client->sendSync($printRequest)->getProperty('.id');
            //$id now contains the ID of the entry we're targeting

            if($apiID){
                $enableRequest = new RouterOS\Request('/ppp/secret/disable');
                $enableRequest->setArgument('numbers', $apiID);
                $client->sendSync($enableRequest);

                $this->session->set_flashdata('success', 'PPPoE User Successfully Disabled');
                redirect('user/all', 'refresh');
            }

            $this->session->set_flashdata('error', 'Opps! User Not Found on NAS.');
            redirect('user/all', 'refresh');


        } catch (Exception $e) {
            $data['error'] = $e->getMessage();
            $this->session->set_flashdata('error', $data['error']);
            redirect('user/all', 'refresh');
        }
    }


}

?>
