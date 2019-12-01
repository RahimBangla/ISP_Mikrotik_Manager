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

class Update extends CI_Controller {

    function __construct() {
        parent::__construct();
        isAdmin();
        isKena();
        isLogin();
        $this->load->model('main');
        $this->load->dbforge();
    }

    Public function index() {
        $this->load->view('header');
        $this->load->view('update');
        $this->load->view('footer');
    }

    Public function updatedatabase() {

        //3.0 to 5.0

        $settingsFields = array(
            array('smsapi' => array('type' => 'varchar', 'constraint' => 255,   'default' => '', 'null' => TRUE,)),
            array('emailapi' => array('type' => 'varchar', 'constraint' => 255,   'default' => '', 'null' => TRUE,)),
            array('smsonbills' => array('type' => 'int', 'constraint' => 255,   'default' => '1', 'null' => TRUE,)),
            array('emailonbills' => array('type' => 'int', 'constraint' => 255,   'default' => '1', 'null' => TRUE,)),
            array('mkipadd' => array('type' => 'varchar', 'constraint' => 50,   'default' => '', 'null' => TRUE,)),
            array('mkuser' => array('type' => 'varchar', 'constraint' => 50,   'default' => '', 'null' => TRUE,)),
            array('mkpassword' => array('type' => 'varchar', 'constraint' => 50,   'default' => '', 'null' => TRUE,)),
        );

        $usersFields = array(
            array('pppoe_name' => array('type' => 'varchar', 'constraint' => 50,   'default' => '', 'null' => TRUE,)),
            array('pppoe_password' => array('type' => 'varchar', 'constraint' => 50,   'default' => '', 'null' => TRUE,)),
            array('pppoe_service' => array('type' => 'varchar', 'constraint' => 50,   'default' => '', 'null' => TRUE,)),
            array('pppoe_profile' => array('type' => 'varchar', 'constraint' => 50,   'default' => '', 'null' => TRUE,)),
            array('hotspot_name' => array('type' => 'varchar', 'constraint' => 50,   'default' => '', 'null' => TRUE,)),
            array('hotspot_pass' => array('type' => 'varchar', 'constraint' => 50,   'default' => '', 'null' => TRUE,)),
            array('hotspot_server' => array('type' => 'varchar', 'constraint' => 50,   'default' => '', 'null' => TRUE,)),
            array('hotspot_profile' => array('type' => 'varchar', 'constraint' => 50,   'default' => '', 'null' => TRUE,))
        );

        for($x=0; count($settingsFields) > $x; $x++){
            $fieldName = key($settingsFields[$x]); //field name
            if($this->db->field_exists($fieldName, 'settings') == false){
                $this->dbforge->add_column('settings', $settingsFields[$x]); //if not found then insert new column
            }
        }

        for($x=0; count($usersFields) > $x; $x++){
            $fieldName = key($usersFields[$x]); //field name
            if($this->db->field_exists($fieldName, 'users') == false){
                $this->dbforge->add_column('users', $usersFields[$x]); //if not found then insert new column
            }
        }

        if (!$this->db->table_exists('email')){
            $this->insertTables('email.sql');
        }

        if (!$this->db->table_exists('sms')){
            $this->insertTables('sms.sql');
        }

        if (!$this->db->table_exists('ticket')){
            $this->insertTables('ticket.sql');
        }

        if (!$this->db->table_exists('ticketcomment')){
            $this->insertTables('ticketcomment.sql');
        }

        $this->session->set_flashdata('success', 'Database Successfully Updated');
        redirect('settings', 'refresh');

    }

    public function insertTables($sqlfile){
        //inserting email table into database
        $sqlPath = realpath(APPPATH . '../assets/files/' . $sqlfile);
        // Set line to collect lines that wrap
        $templine = '';
        // Read in entire file
        $lines = file($sqlPath);
        // Loop through each line
        foreach ($lines as $line) {
            // Skip it if it's a comment
            if (substr($line, 0, 2) == '--' || $line == '')
            continue;
            // Add this line to the current templine we are creating
            $templine .= $line;
            // If it has a semicolon at the end, it's the end of the query so can process this templine
            if (substr(trim($line), -1, 1) == ';') {
            // Perform the query
            $dbquery = $this->db->query($templine);
            // Reset temp variable to empty
                $templine = '';
            }
        }

        return $dbquery;
    }

}
