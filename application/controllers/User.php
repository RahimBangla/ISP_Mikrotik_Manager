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
class User extends CI_Controller {

    function __construct() {
        parent::__construct();
        isLogin();
        isKena();
        $this->load->model('main');
    }

    public function index() {
        isAdmin();
        $data['packages'] = $this->main->getAllPackages();
        $data['area'] = $this->main->getAllAreas();
        $data['staff'] = $this->main->getAllStaffs();
        $this->load->view('header');
        $this->load->view('insertuser', $data);
        $this->load->view('footer');
    }

    public function all() {
        isAdmin();
        $data['users'] = $this->main->getAllUsers();
        $data['packages'] = $this->main->getAllPackages();
        $data['area'] = $this->main->getAllAreas();
        $data['staff'] = $this->main->getAllStaffs();
        $this->load->view('header');
        $this->load->view('allusers', $data);
        $this->load->view('footer');
    }

    public function view() {
        $id = $this->uri->segment(3);
        $data['user'] = $this->main->getUser($id);
        $data['staff'] = $this->main->getStaff($id);
        $this->load->view('header');
        $this->load->view('view', $data);
        $this->load->view('footer');
    }

    public function insert() {
        $data = array();

        $this->form_validation->set_rules('email', 'Email', 'trim|valid_email|is_unique[users.email]');
        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('error', validation_errors());
            redirect('user', 'refresh');
        } else {
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
            $data['package'] = $this->input->post('package');
            $data['area'] = $this->input->post('area');
            $data['staff'] = $this->input->post('staff');
            $data['amount'] = " ";
            $data['user_id'] = $this->input->post('user_id');
            $data['password'] = $this->input->post('password');
            $data['join_date'] = $this->input->post('join_date');
            $data['advance'] = " ";
            $data['role'] = $this->input->post('role');
            $data['email'] = $this->input->post('email');
            $data['pass'] = md5($this->input->post('accpass'));
            $data['role'] = "User";
            $data['status'] = "Pending";
            $data['location'] = $this->input->post('location');
            $true = $this->db->insert('users', $data);
            if ($true) {
                $this->session->set_flashdata('success', 'User Successfully Created');
                redirect('user', 'refresh');
            } else {
                $this->session->set_flashdata('error', 'Opps! Something Wrong');
                redirect('user', 'refresh');
            }
        }
    }

    public function edit() {
        $id = $this->uri->segment(3);
        $data['edit_user'] = $this->main->getUserByID($id);
        $data['packages'] = $this->main->getAllPackages();
        $data['area'] = $this->main->getAllAreas();
        $data['staff'] = $this->main->getAllStaffs();
        $this->load->view('header');
        $this->load->view('edit', $data);
        $this->load->view('footer');
    }

    public function update() {
        $id = $this->input->post('id');
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

        if(!empty($this->input->post('name'))){
            $data['name'] = $this->input->post('name');
        }

        if(!empty($this->input->post('mobile'))){
            $data['mobile'] = $this->input->post('mobile');
        }

        if(!empty($this->input->post('package'))){
            $data['package'] = $this->input->post('package');
        }

        if(!empty($this->input->post('area'))){
            $data['area'] = $this->input->post('area');
        }

        if(!empty($this->input->post('area'))){
            $data['area'] = $this->input->post('area');
        }

        if(!empty($this->input->post('staff'))){
            $data['staff'] = $this->input->post('staff');
        }

        if(!empty($this->input->post('amount'))){
            $data['amount'] =  " ";
        }

        if(!empty($this->input->post('user_id'))){
            $data['user_id'] = $this->input->post('user_id');
        }

        if(!empty($this->input->post('password'))){
            $data['password'] = $this->input->post('password');
        }

        if(!empty($this->input->post('join_date'))){
            $data['join_date'] = $this->input->post('join_date');
        }

        if(!empty($this->input->post('advance'))){
            $data['advance'] = " ";
        }

        if(!empty($this->input->post('accpass'))){
            $data['pass'] = md5($this->input->post('accpass'));
        }

        if(!empty($this->input->post('role'))){
            $data['role'] = $this->input->post('role');
        }

        if(!empty($this->input->post('status'))){
            $data['status'] = $this->input->post('status');
        }

        if(!empty($this->input->post('location'))){
            $data['location'] = $this->input->post('location');
        }

        $this->db->where('id', $id);
        $update_true = $this->db->update('users', $data);
        if ($update_true) {
            $this->session->set_flashdata('success', 'User Successfully Updated');
            redirect('user', 'refresh');
        } else {
            $this->session->set_flashdata('error', 'Opps! Something Wrong');
            redirect('user', 'refresh');
        }
    }


    public function delete() {
        isAdmin();
        $id = $this->uri->segment(3);

        // Delete Users From Mikrotik
        try {
            $util = new RouterOS\Util(
                $client = new RouterOS\Client(settings()[0]->mkipadd, settings()[0]->mkuser, settings()[0]->mkpassword)
            );
            $util->setMenu('/ppp secret');
            $util->disable(RouterOS\Query::where('name', getUser($id)->pppoe_name));

            $util->setMenu('/ip hotspot user');
            $util->disable(RouterOS\Query::where('name', getUser($id)->hotspot_name));
            $this->session->set_flashdata('success', 'PPPoE & Hotspot User Successfully Disable');

        } catch (Exception $e) {
            $data['error'] = $e->getMessage();
            $this->session->set_flashdata('error', $data['error']);
        }

        //Delete User
        $this->db->delete('users', array('id' => $id));

        //Delete Bills Related With Users
        $this->db->delete('bills', array('userid' => $id));

        //Delete Invoices Related With Users
        $this->db->delete('invoice', array('userid' => $id));

        redirect('user/all', 'refresh');
    }


    public function changeemail(){
        $userID = $this->input->post('id');
        $userEmail = $this->input->post('email');

        $query = $this->db->get_where('users', array('email' => $userEmail));
        if($query->num_rows() > 0){
            $this->session->set_flashdata('error', 'Email already exist and not available.');
            redirect('user/view/' . $userID, 'refresh');
        }else{
            $data['email'] = $userEmail;
            $updateStatus = $this->db->update('users', $data, array('id' => $userID));
            if ($updateStatus) {
                $this->session->set_flashdata('success', 'Email Successfully Changed');
                redirect('user/view/' . $userID, 'refresh');
            } else {
                $this->session->set_flashdata('error', 'Opps! Something Wrong');
                redirect('user/view/' . $userID, 'refresh');
            }
        }

    }

    public function reports() {
        $userID = $this->input->post('userID');
        $selectedYear = $this->input->post('selectedYear');
        $query = $this->main->getBillIDYear($userID, $selectedYear);
        $table = "";
        foreach ($query as $row) {
            $table .= "
            <tr>
                <td>" . $row->month . "</td>
                <td>" . $row->year . "</td>
                <td><span class='label label-success'>" . package($row->package)->packname . " (" . package($row->package)->packvolume . ")" . "</span></td>";

            if($row->billstatus == "Paid"){
                $table .= "<td><span class='label label-success'>" . $row->billstatus . "</span></td>";
            }else if($row->billstatus == "Unpaid"){
                $table .= "<td><span class='label label-danger'>" . $row->billstatus . "</span></td>";
            }

            $table .= "<td class='action-link'>";

//            if(invoiceByUser($row->userid)){
//                $table .= "<a href='" . base_url() . "invoice/view/" . invoiceByUser($row->userid)->invoiceID . "' target='_blank'><span class='label label-primary'>Invoice</span></a>";
//            }

//            if($row->billstatus == "Paid"){
//                $table .= "<a href='" . base_url() . "bill/makeunpaid/" . $row->billid . "'><span class='label label-warning'>Make Unpaid</span></a>
//                ";
//            }else if($row->billstatus == "Unpaid"){
//                $table .= "<a href='" . base_url() . "bill/makepaid/" . $row->billid . "'><span class='label label-warning'>Make Paid</span></a>
//                ";
//            }

//            $table .= "<a href='" . base_url() . "bill/delete/" . $row->billid . "'><span class='label label-danger delete'>Delete</span></a>
//            </td>";

            $table .= "</tr>";
        }
        echo json_encode($table);
    }


    public function invoices() {
        $id = $this->session->userdata('user_id');
        $data['invoices'] = $this->main->getAllInvoicsByUser($id);
        $this->load->view('header');
        $this->load->view('userInvoices', $data);
        $this->load->view('footer');
    }

    public function invoiceview($id) {
        $userid = $this->session->userdata('user_id');
        $data['invoice'] = $this->main->getUserInvoice($id, $userid);
        $this->load->view('header');
        $this->load->view('userInvoice', $data);
        $this->load->view('footer');
    }

    public function payments() {
        $userid = $this->session->userdata('user_id');
        $invoices = $this->main->getInvoicesByUserID($userid);

        $invoicsIDs = array();

        if($invoices){
            foreach ($invoices as $invoice) {
                $invoicsIDs[] = $invoice->invoiceID;
            }
        }

        //var_dump($invoicsIDs);
        if(count($invoicsIDs) > 0){
            $data['payments'] = $this->main->getPaymenstsByInvoiceIDs($invoicsIDs);
        }else{
            $data['payments'] = "";
        }

        $this->load->view('header');
        $this->load->view('userPayments', $data);
        $this->load->view('footer');
    }

}

?>
