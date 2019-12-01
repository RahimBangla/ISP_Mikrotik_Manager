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

class Staff extends CI_Controller {

    function __construct() {
        parent::__construct();
        isAdmin();
        isKena();
        isLogin();
        $this->load->model('main');
    }

    public function index() {
        $data['area'] = $this->main->getAllAreas();
        $data['staff'] = $this->main->getAllStaffs();
        $this->load->view('header');
        $this->load->view('staff', $data);
        $this->load->view('footer');
    }

    public function edit() {
        $id = $this->uri->segment(3);
        $data['area'] = $this->main->getAllAreas();
        $data['staff'] = $this->main->getAllStaffs();
        $data['singleStaff'] = $this->main->getStaffByID($id);
        $this->load->view('header');
        $this->load->view('editstaff', $data);
        $this->load->view('footer');
    }

    public function insert() {
        $data = array();
         /* Uploading Profile Images */
        $imagePath = realpath(APPPATH . '../assets/images/');
        $photo = $_FILES['photo']['tmp_name'];
        if ($photo !== "") {
            $config['upload_path'] = $imagePath;
            $config['allowed_types'] = 'jpg|png|jpeg|gif';
            $config['file_name'] = date('Ymd_his_') . rand(10, 99) . rand(10, 99) . rand(10, 99);
            $this->load->library('upload', $config);
            if ($this->upload->do_upload('photo')) {
                $uploadData = $this->upload->data();
                $data['photo'] = $uploadData['file_name'];
            }

            $config['image_library'] = 'gd2';
            $config['source_image'] = $uploadData['full_path'];
            $config['new_image'] = $imagePath . '/crop';
            $config['quality'] = '100%';
            $config['maintain_ratio'] = FALSE;
            //Set cropping for y or x axis, depending on image orientation
            if ($uploadData['image_width'] > $uploadData['image_height']) {
                $config['width'] = $uploadData['image_height'];
                $config['height'] = $uploadData['image_height'];
                $config['x_axis'] = (($uploadData['image_width'] / 2) - ($config['width'] / 2));
            } else {
                $config['height'] = $uploadData['image_width'];
                $config['width'] = $uploadData['image_width'];
                $config['y_axis'] = (($uploadData['image_height'] / 2) - ($config['height'] / 2));
            }

            $this->image_lib->clear();
            $this->image_lib->initialize($config);
            $this->image_lib->crop();

            $config['source_image'] = $imagePath . '/crop/' . $uploadData['file_name'];
            $config['new_image'] = $imagePath . '/final';
            $config['maintain_ratio'] = FALSE;
            $config['width'] = 250;
            $config['height'] = 250;

            $this->image_lib->clear();
            $this->image_lib->initialize($config);
            $this->image_lib->resize();

            /* Deleting Uploaded Image After Croping and Resizing */
            /* Why Deleting because it's saving space */
            unlink($uploadData['full_path']);
        }


        $data['name'] = $this->input->post('name');
        $data['mobile'] = $this->input->post('mobile');
        $data['area'] = $this->input->post('area');
        $true = $this->db->insert('staff', $data);
        if ($true) {
            $this->session->set_flashdata('success', 'Successfully Added');
            redirect(base_url() . 'staff/');
        } else {
            $this->session->set_flashdata('error', 'Opps! Something Wrong');
            redirect(base_url() . 'staff');
        }
    }


    public function update() {
        $data = array();
         /* Uploading Profile Images */
        $imagePath = realpath(APPPATH . '../assets/images/');
        $photo = $_FILES['photo']['tmp_name'];
        if ($photo !== "") {
            $config['upload_path'] = $imagePath;
            $config['allowed_types'] = 'jpg|png|jpeg|gif';
            $config['file_name'] = date('Ymd_his_') . rand(10, 99) . rand(10, 99) . rand(10, 99);
            $this->load->library('upload', $config);
            if ($this->upload->do_upload('photo')) {
                $uploadData = $this->upload->data();
                $data['photo'] = $uploadData['file_name'];
            }

            $config['image_library'] = 'gd2';
            $config['source_image'] = $uploadData['full_path'];
            $config['new_image'] = $imagePath . '/crop';
            $config['quality'] = '100%';
            $config['maintain_ratio'] = FALSE;
            //Set cropping for y or x axis, depending on image orientation
            if ($uploadData['image_width'] > $uploadData['image_height']) {
                $config['width'] = $uploadData['image_height'];
                $config['height'] = $uploadData['image_height'];
                $config['x_axis'] = (($uploadData['image_width'] / 2) - ($config['width'] / 2));
            } else {
                $config['height'] = $uploadData['image_width'];
                $config['width'] = $uploadData['image_width'];
                $config['y_axis'] = (($uploadData['image_height'] / 2) - ($config['height'] / 2));
            }

            $this->image_lib->clear();
            $this->image_lib->initialize($config);
            $this->image_lib->crop();

            $config['source_image'] = $imagePath . '/crop/' . $uploadData['file_name'];
            $config['new_image'] = $imagePath . '/final';
            $config['maintain_ratio'] = FALSE;
            $config['width'] = 250;
            $config['height'] = 250;

            $this->image_lib->clear();
            $this->image_lib->initialize($config);
            $this->image_lib->resize();

            /* Deleting Uploaded Image After Croping and Resizing */
            /* Why Deleting because it's saving space */
            unlink($uploadData['full_path']);
        }


        $id = $this->input->post('id');
        $data['name'] = $this->input->post('name');
        $data['mobile'] = $this->input->post('mobile');
        $data['area'] = $this->input->post('area');
        $this->db->where('id', $id);
        $true = $this->db->update('staff', $data);
        if ($true) {
            $this->session->set_flashdata('success', 'Successfully Updated');
            redirect(base_url() . 'staff/');
        } else {
            $this->session->set_flashdata('error', 'Opps! Something Wrong');
            redirect(base_url() . 'staff');
        }
    }


    public function delete() {
        $staffid = $this->uri->segment(3);
        $true = $this->db->delete('staff', array('id' => $staffid));
        if ($true) {
            $this->session->set_flashdata('success', 'Successfully Deleted');
            redirect(base_url() . 'staff/');
        } else {
            $this->session->set_flashdata('error', 'Opps! Something Wrong');
            redirect(base_url() . 'staff');
        }
    }
}

?>
