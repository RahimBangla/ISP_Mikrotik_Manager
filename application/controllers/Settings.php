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

class Settings extends CI_Controller {

    function __construct() {
        parent::__construct();
        isAdmin();
        isKena();
        isLogin();
        $this->load->model('main');
    }

    Public function index() {
        $data['settings'] = $this->getSettings();
        $this->load->view('header');
        $this->load->view('settings', $data);
        $this->load->view('footer');
    }

    Public function getSettings() {
        $query = $this->db->get_where('settings', array('id' => 1));
        return $query->result();
    }

    function insert() {

        $data = array();

        /* Uploading Profile Images */
        $imagePath = realpath(APPPATH . '../assets/images/');
        $logo = $_FILES['logo']['tmp_name'];
        $favicon = $_FILES['favicon']['tmp_name'];
        if ($logo !== "") {
            $config['upload_path'] = $imagePath;
            $config['allowed_types'] = 'jpg|png|jpeg|gif';
            $config['file_name'] = date('Ymd_his_') . rand(10, 99) . rand(10, 99) . rand(10, 99);
            $this->load->library('upload', $config);
            if ($this->upload->do_upload('logo')) {
                $uploadData = $this->upload->data();
                $data['logo'] = $uploadData['file_name'];
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


        if ($favicon !== "") {
            $config['upload_path'] = $imagePath;
            $config['allowed_types'] = 'jpg|png|jpeg|gif';
            $config['file_name'] = date('Ymd_his_') . rand(10, 99) . rand(10, 99) . rand(10, 99);
            $this->load->library('upload', $config);
            if ($this->upload->do_upload('favicon')) {
                $uploadData = $this->upload->data();
                $data['favicon'] = $uploadData['file_name'];
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
        $data['slogan'] = $this->input->post('slogan');
        $data['mobile'] = $this->input->post('mobile');
        $data['email'] = $this->input->post('email');
        $data['currency'] = $this->input->post('currency');
        $data['paymentmethod'] = $this->input->post('paymentmethod');
        $data['paymentacc'] = $this->input->post('paymentacc');
        $data['vat'] = $this->input->post('vat');
        $data['smsapi'] = $this->input->post('smsapi');
        $data['emailapi'] = $this->input->post('emailapi');
        $data['smsonbills'] = $this->input->post('smsonbills');
        $data['emailonbills'] = $this->input->post('emailonbills');
        $data['mkipadd'] = $this->input->post('mkipadd');
        $data['mkuser'] = $this->input->post('mkuser');
        $data['mkpassword'] = $this->input->post('mkpassword');
        $data['address'] = $this->input->post('address');
        $data['city'] = $this->input->post('city');
        $data['country'] = $this->input->post('country');
        $data['zip'] = $this->input->post('zip');
        $data['location'] = $this->input->post('location');
        $data['copyright'] = $this->input->post('copyright');
        $this->db->where('id', 1);
        $true = $this->db->update('settings', $data);
        if ($true) {
            $this->session->set_flashdata('success', 'Successfully Updated');
            redirect('settings', 'refresh');
        } else {
            $this->session->set_flashdata('error', 'Opps! Something Wrong');
            redirect('settings', 'refresh');
        }
    }

}
