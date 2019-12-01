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

class Hotspot extends CI_Controller {

    function __construct() {
        parent::__construct();
        isLogin();
        isKena();
        $this->load->model('main');
    }

    public function index() {
        $data = array();
        $data['profiles'] = '';
        $data['servers'] = '';
        $data['online'] = '';
        $data['error'] = '';
        $data['users'] = $this->main->getAllUsers();
        try {
            $data['profiles'] = mkUtil()->setMenu('/ip hotspot user profile')->getAll();
            $data['servers'] = mkUtil()->setMenu('/ip hotspot')->getAll();
            $data['online'] = mkUtil()->setMenu('/ip hotspot active')->getAll();
            // echo "<pre>"; var_dump($data['profiles']); echo "</pre>";
        } catch (Exception $e) {
            $data['error'] =  $e->getMessage();
        }

        $this->load->view('header');
        $this->load->view('allhotspot', $data);
        $this->load->view('footer');

    }



    public function insert() {
        $data = array();
        $this->form_validation->set_rules('user', 'Connect User', 'required');
        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('error', validation_errors());
            redirect('hotspot', 'refresh');
        } else {
            $data['hotspot_name'] = $this->input->post('name');
            $data['hotspot_pass'] = $this->input->post('password');
            $data['hotspot_server'] = $this->input->post('server');
            $data['hotspot_profile'] = $this->input->post('profile');
            $this->db->where('id', $this->input->post('user'));
            $true = $this->db->update('users', $data);
            if ($true) {
                try {
                    $util = new RouterOS\Util(
                        $client = new RouterOS\Client(settings()[0]->mkipadd, settings()[0]->mkuser, settings()[0]->mkpassword)
                    );
                    $util->setMenu('/ip hotspot user');
                    $util->add(
                        array(
                            'name' => $this->input->post('name'),
                            'password' => $this->input->post('password'),
                            'server' => $this->input->post('server'),
                            'profile' => $this->input->post('profile')
                        )
                    );
                    $this->session->set_flashdata('success', 'Hotspot User Successfully Created');
                    redirect('hotspot', 'refresh');
                } catch (Exception $e) {
                    $data['error'] = $e->getMessage();
                    $this->session->set_flashdata('error', $data['error']);
                    redirect('hotspot', 'refresh');
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

            //if user connection type api hotshot then do this
            $printRequest = new RouterOS\Request('/ip/hotspot/user/print');
            $printRequest->setArgument('.proplist', '.id');
            $printRequest->setQuery(RouterOS\Query::where('name', $name));
            $apiID = $client->sendSync($printRequest)->getProperty('.id');
            //$id now contains the ID of the entry we're targeting

            if($apiID){
                $enableRequest = new RouterOS\Request('/ip/hotspot/user/enable');
                $enableRequest->setArgument('numbers', $apiID);
                $client->sendSync($enableRequest);

                $this->session->set_flashdata('success', 'Hotspot User Successfully Enabled');
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

            //if user connection type api hotshot then do this
            $printRequest = new RouterOS\Request('/ip/hotspot/user/print');
            $printRequest->setArgument('.proplist', '.id');
            $printRequest->setQuery(RouterOS\Query::where('name', $name));
            $apiID = $client->sendSync($printRequest)->getProperty('.id');
            //$id now contains the ID of the entry we're targeting

            if($apiID){
                $enableRequest = new RouterOS\Request('/ip/hotspot/user/disable');
                $enableRequest->setArgument('numbers', $apiID);
                $client->sendSync($enableRequest);

                $this->session->set_flashdata('success', 'Hotspot User Successfully Disabled');
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
