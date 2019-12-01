<?php defined('BASEPATH') OR exit('No direct script access allowed');

use Mailgun\Mailgun;

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

class Communication extends CI_Controller {

    function __construct() {
        parent::__construct();
        isAdmin();
        isKena();
        isLogin();
        $this->load->model('main');
        $this->load->model('global_m');
    }

    public function index() {
        $data['users'] = $this->main->getAllUsers();
        $data['packages'] = $this->main->getAllPackages();
        $data['areas'] = $this->main->getAllAreas();
        $data['staffs'] = $this->main->getAllStaffs();
        $this->load->view('header');
        $this->load->view('communication', $data);
        $this->load->view('footer');
    }


    public function quickemail() {

        $emails = $this->input->post('emails');
        $textMessage =  $this->input->post('message');
        $emailsubject =  $this->input->post('subject');
        $mailArray = explode(',', $emails);
        $i=0;
        $j=0;
        $error = '';
        for($x=0; $x < count($mailArray); $x++){
            $i++;
            $mg = Mailgun::create($this->config->item('mailgun_api'));
            try{
                $mg->messages()->send($this->config->item('mailgun_domain'), [
                  'from'    => $this->config->item('mailgun_from'),
                  'to'      => $mailArray[$x],
                  'subject' => character_limiter(strip_tags($emailsubject), 50),
                  'text'    => strip_tags($textMessage),
                  'html'    => $textMessage
                ]);

                $data = array();
                $data['time'] = date('d-m-Y H:i:s');
                $data['emailTo'] = $mailArray[$x];
                $data['emailSubject'] = character_limiter(strip_tags($emailsubject), 50);
                $data['message'] = character_limiter(strip_tags($textMessage), 300);
                $data['network'] = 'Mailgun';
                $this->global_m->globalInsert('email', $data);
            }catch(\Exception $e){
                $error =  $e->getMessage();
                $j++;
            }
        }

        $this->session->set_flashdata('success', $i . ' Emails Successfully Delivered & ' . $j . ' Failed. ' . $error);
        redirect('communication/', 'refresh');

    }


    public function emailbyuser() {

        $error = '';
        $userID = $this->input->post('userid');
        $textMessage =  $this->input->post('message');
        $emailsubject =  $this->input->post('subject');

        $email = $this->main->getUserDataByID($userID)->email;
        $mg = Mailgun::create($this->config->item('mailgun_api'));
        try{
            $mg->messages()->send($this->config->item('mailgun_domain'), [
              'from'    => $this->config->item('mailgun_from'),
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
            $this->global_m->globalInsert('email', $data);
        }catch(\Exception $e){
            $error =  $e->getMessage();
        }

        if($error !=''){
            $this->session->set_flashdata('success', 'Emails Successfully Delivered');
        }else{
            $this->session->set_flashdata('error', $error);
        }
        redirect('communication/', 'refresh');

    }


    public function emailbypackage() {

        $error = array();
        $i=0;
        $j=0;
        $packageID = $this->input->post('package');
        $emailsubject =  $this->input->post('subject');
        $textMessage =  $this->input->post('message');

        $users = $this->main->getUserByPackageID($packageID);
        if($users !=false){
            foreach($users as $user){
                $email = $user->email;
                $mg = Mailgun::create($this->config->item('mailgun_api'));
                try{
                    $mg->messages()->send($this->config->item('mailgun_domain'), [
                      'from'    => $this->config->item('mailgun_from'),
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
                    $this->global_m->globalInsert('email', $data);
                    $i++;
                }catch(\Exception $e){
                    $j++;
                    $error[] =  $e->getMessage();
                }
            }
        }

        $this->session->set_flashdata('success', $i . ' Emails Successfully Delivered & ' . count($error) . ' Not Delivered.');
        redirect('communication/', 'refresh');

    }


    public function emailbyarea() {

        $error = array();
        $i=0;
        $j=0;
        $area = $this->input->post('area');
        $emailsubject =  $this->input->post('subject');
        $textMessage =  $this->input->post('message');

        $users = $this->main->getUserByAreaName($area);
        if($users !=false){
            foreach($users as $user){
                $email = $user->email;
                $mg = Mailgun::create($this->config->item('mailgun_api'));
                try{
                    $mg->messages()->send($this->config->item('mailgun_domain'), [
                      'from'    => $this->config->item('mailgun_from'),
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
                    $this->global_m->globalInsert('email', $data);
                    $i++;
                }catch(\Exception $e){
                    $j++;
                    $error[] =  $e->getMessage();
                }
            }
        }

        $this->session->set_flashdata('success', $i . ' Emails Successfully Delivered & ' . count($error) . ' Not Delivered.');
        redirect('communication/', 'refresh');

    }



    public function emailbystaff() {

        $error = array();
        $i=0;
        $j=0;
        $staff = $this->input->post('staff');
        $emailsubject =  $this->input->post('subject');
        $textMessage =  $this->input->post('message');

        $users = $this->main->getUserByStaff($staff);
        if($users !=false){
            foreach($users as $user){
                $email = $user->email;
                $mg = Mailgun::create($this->config->item('mailgun_api'));
                try{
                    $mg->messages()->send($this->config->item('mailgun_domain'), [
                      'from'    => $this->config->item('mailgun_from'),
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
                    $this->global_m->globalInsert('email', $data);
                    $i++;
                }catch(\Exception $e){
                    $j++;
                    $error[] =  $e->getMessage();
                }
            }
        }

        $this->session->set_flashdata('success', $i . ' Emails Successfully Delivered & ' . count($error) . ' Not Delivered.');
        redirect('communication/', 'refresh');

    }



    public function quicksms() {

        $smsApiType = settings()[0]->smsapi;
        $numbers = $this->input->post('numbers');
        $textMessage =  $this->input->post('message');
        $numsArray = explode(',', $numbers);
        $i=0;
        $j=0;
        $error = '';
        for($x=0; $x < count($numsArray); $x++){

            if($smsApiType == 'Nexmo'){

                //Nexmo API
                $client = new Nexmo\Client(new Nexmo\Client\Credentials\Basic($this->config->item('nexmo_api'), $this->config->item('nexmo_secret')));
                try{
                    $message = $client->message()->send([
                        'to' => $numsArray[$x],
                        'from' => $this->config->item('nexmo_from'),
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
                    $insert = $this->global_m->globalInsert('sms', $data);
                    if($insert == True){
                        $i++;
                    }

                }catch(\Exception $e){
                    $error =  $e->getMessage();
                    $j++;
                }
                //End of Nexmo

            }else{

                // Your Account SID and Auth Token from twilio.com/console
                $account_sid = $this->config->item('twilio_sid');
                $auth_token = $this->config->item('twilio_token');
                // In production, these should be environment variables. E.g.:
                // $auth_token = $_ENV["TWILIO_ACCOUNT_SID"]

                // A Twilio number you own with SMS capabilities
                $twilio_number = $this->config->item('twilio_sender');
                $client = new Twilio\Rest\Client($account_sid, $auth_token);

                try{
                    $message = $client->messages->create(
                        $numsArray[$x], //To Number
                        array(
                            'from' => $twilio_number,
                            'body' => character_limiter(strip_tags($textMessage), 160)
                        )
                    );

                    $data = array();
                    $data['time'] = date('d-m-Y H:i:s');
                    $data['to'] = $numsArray[$x];
                    $data['message'] = character_limiter(strip_tags($textMessage), 160);
                    $data['messageid'] = 'N/A';
                    $data['remainingbalance'] = 'N/A';
                    $data['messageprice'] = 'N/A';
                    $data['network'] = 'N/A';
                    $insert = $this->global_m->globalInsert('sms', $data);
                    if($insert == True){
                        $i++;
                    }

                }catch(\Exception $e){
                    $error = $e->getMessage();
                    $j++;
                }

            }

        }

        $this->session->set_flashdata('success', $i . ' SMSs Successfully Delivered & ' . $j . ' Failed. ' . $error);
        redirect('communication/', 'refresh');

    }



    public function smsbyuser() {

        $smsApiType = settings()[0]->smsapi;
        $userID = $this->input->post('userid');
        $number = $this->main->getUserDataByID($userID)->mobile;
        $textMessage =  $this->input->post('message');
        $i=0;
        $j=0;
        $error = '';
        if($smsApiType == 'Nexmo'){

            //Nexmo API
            $client = new Nexmo\Client(new Nexmo\Client\Credentials\Basic($this->config->item('nexmo_api'), $this->config->item('nexmo_secret')));
            try{
                $message = $client->message()->send([
                    'to' => $number,
                    'from' => $this->config->item('nexmo_from'),
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
                $insert = $this->global_m->globalInsert('sms', $data);
                if($insert == True){
                    $i++;
                }

            }catch(\Exception $e){
                $error =  $e->getMessage();
                $j++;
            }
            //End of Nexmo

        }else if($smsApiType == 'Twilio'){

            // Your Account SID and Auth Token from twilio.com/console
            $account_sid = $this->config->item('twilio_sid');
            $auth_token = $this->config->item('twilio_token');
            // In production, these should be environment variables. E.g.:
            // $auth_token = $_ENV["TWILIO_ACCOUNT_SID"]

            // A Twilio number you own with SMS capabilities
            $twilio_number = $this->config->item('twilio_sender');
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
                $insert = $this->global_m->globalInsert('sms', $data);
                if($insert == True){
                    $i++;
                }

            }catch(\Exception $e){
                $error = $e->getMessage();
                $j++;
            }

        }

        $this->session->set_flashdata('success', $i . ' SMSs Successfully Delivered & ' . $j . ' Failed. ' . $error);
        redirect('communication/', 'refresh');

    }


    public function smsbypackage() {

        $smsApiType = settings()[0]->smsapi;
        $error = '';
        $i=0;
        $j=0;
        $packageID = $this->input->post('package');
        $textMessage =  $this->input->post('message');
        $users = $this->main->getUserByPackageID($packageID);
        if($users !=false){
            foreach($users as $user){
                $number = $user->mobile;

                if($smsApiType == 'Nexmo'){

                    //Nexmo API
                    $client = new Nexmo\Client(new Nexmo\Client\Credentials\Basic($this->config->item('nexmo_api'), $this->config->item('nexmo_secret')));
                    try{
                        $message = $client->message()->send([
                            'to' => $number,
                            'from' => $this->config->item('nexmo_from'),
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
                        $insert = $this->global_m->globalInsert('sms', $data);
                        if($insert == True){
                            $i++;
                        }

                    }catch(\Exception $e){
                        $error =  $e->getMessage();
                        $j++;
                    }
                    //End of Nexmo

                }else if($smsApiType == 'Twilio'){

                    // Your Account SID and Auth Token from twilio.com/console
                    $account_sid = $this->config->item('twilio_sid');
                    $auth_token = $this->config->item('twilio_token');
                    // In production, these should be environment variables. E.g.:
                    // $auth_token = $_ENV["TWILIO_ACCOUNT_SID"]

                    // A Twilio number you own with SMS capabilities
                    $twilio_number = $this->config->item('twilio_sender');
                    $client = new Twilio\Rest\Client($account_sid, $auth_token);

                    try{
                        $message = $client->messages->create(
                            $numsArray[$x], //To Number
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
                        $insert = $this->global_m->globalInsert('sms', $data);
                        if($insert == True){
                            $i++;
                        }

                    }catch(\Exception $e){
                        $error = $e->getMessage();
                        $j++;
                    }

                }

            }
        }

        $this->session->set_flashdata('success', $i . ' SMSs Successfully Delivered & ' . $j . ' Failed. ' . $error);
        redirect('communication/', 'refresh');

    }


    public function smsbyarea() {

        $smsApiType = settings()[0]->smsapi;
        $error = '';
        $i=0;
        $j=0;

        $area = $this->input->post('area');
        $textMessage =  $this->input->post('message');
        $users = $this->main->getUserByAreaName($area);

        if($users !=false){
            foreach($users as $user){
                $number = $user->mobile;

                if($smsApiType == 'Nexmo'){

                    //Nexmo API
                    $client = new Nexmo\Client(new Nexmo\Client\Credentials\Basic($this->config->item('nexmo_api'), $this->config->item('nexmo_secret')));
                    try{
                        $message = $client->message()->send([
                            'to' => $number,
                            'from' => $this->config->item('nexmo_from'),
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
                        $insert = $this->global_m->globalInsert('sms', $data);
                        if($insert == True){
                            $i++;
                        }

                    }catch(\Exception $e){
                        $error =  $e->getMessage();
                        $j++;
                    }
                    //End of Nexmo

                }else if($smsApiType == 'Twilio'){

                    // Your Account SID and Auth Token from twilio.com/console
                    $account_sid = $this->config->item('twilio_sid');
                    $auth_token = $this->config->item('twilio_token');
                    // In production, these should be environment variables. E.g.:
                    // $auth_token = $_ENV["TWILIO_ACCOUNT_SID"]

                    // A Twilio number you own with SMS capabilities
                    $twilio_number = $this->config->item('twilio_sender');
                    $client = new Twilio\Rest\Client($account_sid, $auth_token);

                    try{
                        $message = $client->messages->create(
                            $numsArray[$x], //To Number
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
                        $insert = $this->global_m->globalInsert('sms', $data);
                        if($insert == True){
                            $i++;
                        }

                    }catch(\Exception $e){
                        $error = $e->getMessage();
                        $j++;
                    }

                }

            }
        }

        $this->session->set_flashdata('success', $i . ' SMSs Successfully Delivered & ' . $j . ' Failed. ' . $error);
        redirect('communication/', 'refresh');

    }


    public function smsbystaff() {

        $smsApiType = settings()[0]->smsapi;
        $error = '';
        $i=0;
        $j=0;

        $staff = $this->input->post('staff');
        $textMessage =  $this->input->post('message');
        $users = $this->main->getUserByStaff($staff);

        if($users !=false){
            foreach($users as $user){
                $number = $user->mobile;

                if($smsApiType == 'Nexmo'){

                    //Nexmo API
                    $client = new Nexmo\Client(new Nexmo\Client\Credentials\Basic($this->config->item('nexmo_api'), $this->config->item('nexmo_secret')));
                    try{
                        $message = $client->message()->send([
                            'to' => $number,
                            'from' => $this->config->item('nexmo_from'),
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
                        $insert = $this->global_m->globalInsert('sms', $data);
                        if($insert == True){
                            $i++;
                        }

                    }catch(\Exception $e){
                        $error =  $e->getMessage();
                        $j++;
                    }
                    //End of Nexmo

                }else if($smsApiType == 'Twilio'){

                    // Your Account SID and Auth Token from twilio.com/console
                    $account_sid = $this->config->item('twilio_sid');
                    $auth_token = $this->config->item('twilio_token');
                    // In production, these should be environment variables. E.g.:
                    // $auth_token = $_ENV["TWILIO_ACCOUNT_SID"]

                    // A Twilio number you own with SMS capabilities
                    $twilio_number = $this->config->item('twilio_sender');
                    $client = new Twilio\Rest\Client($account_sid, $auth_token);

                    try{
                        $message = $client->messages->create(
                            $numsArray[$x], //To Number
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
                        $insert = $this->global_m->globalInsert('sms', $data);
                        if($insert == True){
                            $i++;
                        }

                    }catch(\Exception $e){
                        $error = $e->getMessage();
                        $j++;
                    }

                }

            }
        }

        $this->session->set_flashdata('success', $i . ' SMSs Successfully Delivered & ' . $j . ' Failed. ' . $error);
        redirect('communication/', 'refresh');

    }




}

?>
