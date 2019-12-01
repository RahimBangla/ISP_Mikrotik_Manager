<?php defined('BASEPATH') OR exit('No direct script access allowed');

use ParseCsv\Csv;

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

class Import extends CI_Controller {

    function __construct() {
        parent::__construct();
        isAdmin();
        isKena();
        isLogin();
        $this->load->model('main');
    }

    public function index() {
        $this->load->view('header');
        $this->load->view('import');
        $this->load->view('footer');
    }

    public function userImport() {

        /* Uploading Files */
        $filePath = realpath(APPPATH . '../assets/files/');
        $file = $_FILES['user']['tmp_name'];
        if ($file !== "") {
            $config['upload_path'] = $filePath;
            $config['allowed_types'] = 'text/plain|text/csv|csv';
            $config['file_name'] = "CSV" . date('Ymd_his');
            $this->load->library('upload', $config);
            if ($this->upload->do_upload('user')) {
                $file_data = $this->upload->data();
                $file_path = $file_data['full_path'];
                $csv = new Csv($file_path);
                    foreach ($csv->data as $row) {

                        $name = $row['name'];
                        $array = array();
                        $array['photo'] = $row['photo'];
                        $array['name'] = $row['name'];
                        $array['mobile'] = $row['mobile'];
                        $array['package'] = packageByName($row['package'])->packid;
                        $array['area'] = $row['area'];
                        $array['staff'] = staffByName($row['staff'])->id;
                        $array['user_id'] = $row['connectionid'];
                        $array['password'] = $row['connectionpass'];
                        $array['join_date'] = $row['joindate'];
                        $array['role'] = $row['role'];
                        $array['email'] = $row['accountemail'];
                        $array['pass'] = $row['accountpass'];
                        $array['location'] = $row['location'];
                        $array['status'] = "Pending";

                        if(!empty($name)){
                            $this->db->insert('users', $array);
                        }
                    }

                    $this->session->set_flashdata('success', "Successfully Imported");
                    redirect(base_url("import/index"));

            }else {
                $this->session->set_flashdata('error', "File has some issue");
                redirect(base_url("import/index"));
            }
        } else {
            $this->session->set_flashdata('error', "Blank Import Field");
            redirect(base_url("import/index"));
        }
    }

}

?>
