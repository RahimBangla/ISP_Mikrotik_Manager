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

class Home extends CI_Controller {

    function __construct() {
        parent::__construct();
        isAdmin();
        isKena();
        isLogin();
        $this->load->model('main');
    }

    public function index() {

        $data['users'] = $this->main->getTopUser();
        $data['areas'] = $this->main->getAllAreas();
        $data['staffs'] = $this->main->getAllStaffs();

        $data['jan'] = $this->main->getPaymentsSumByMonth('01', date('Y'));
        $data['feb'] = $this->main->getPaymentsSumByMonth('02', date('Y'));
        $data['mar'] = $this->main->getPaymentsSumByMonth('03', date('Y'));
        $data['apr'] = $this->main->getPaymentsSumByMonth('04', date('Y'));
        $data['may'] = $this->main->getPaymentsSumByMonth('05', date('Y'));
        $data['jun'] = $this->main->getPaymentsSumByMonth('06', date('Y'));
        $data['jul'] = $this->main->getPaymentsSumByMonth('07', date('Y'));
        $data['aug'] = $this->main->getPaymentsSumByMonth('08', date('Y'));
        $data['sep'] = $this->main->getPaymentsSumByMonth('09', date('Y'));
        $data['oct'] = $this->main->getPaymentsSumByMonth('10', date('Y'));
        $data['nov'] = $this->main->getPaymentsSumByMonth('11', date('Y'));
        $data['dec'] = $this->main->getPaymentsSumByMonth('12', date('Y'));

        $data['janIncome'] = $this->main->getBalInSumByMonth('01', date('Y'));
        $data['febIncome'] = $this->main->getBalInSumByMonth('02', date('Y'));
        $data['marIncome'] = $this->main->getBalInSumByMonth('03', date('Y'));
        $data['aprIncome'] = $this->main->getBalInSumByMonth('04', date('Y'));
        $data['mayIncome'] = $this->main->getBalInSumByMonth('05', date('Y'));
        $data['junIncome'] = $this->main->getBalInSumByMonth('06', date('Y'));
        $data['julIncome'] = $this->main->getBalInSumByMonth('07', date('Y'));
        $data['augIncome'] = $this->main->getBalInSumByMonth('08', date('Y'));
        $data['sepIncome'] = $this->main->getBalInSumByMonth('09', date('Y'));
        $data['octIncome'] = $this->main->getBalInSumByMonth('10', date('Y'));
        $data['novIncome'] = $this->main->getBalInSumByMonth('11', date('Y'));
        $data['decIncome'] = $this->main->getBalInSumByMonth('12', date('Y'));

        $data['janExpense'] = $this->main->getBalExSumByMonth('01', date('Y'));
        $data['febExpense'] = $this->main->getBalExSumByMonth('02', date('Y'));
        $data['marExpense'] = $this->main->getBalExSumByMonth('03', date('Y'));
        $data['aprExpense'] = $this->main->getBalExSumByMonth('04', date('Y'));
        $data['mayExpense'] = $this->main->getBalExSumByMonth('05', date('Y'));
        $data['junExpense'] = $this->main->getBalExSumByMonth('06', date('Y'));
        $data['julExpense'] = $this->main->getBalExSumByMonth('07', date('Y'));
        $data['augExpense'] = $this->main->getBalExSumByMonth('08', date('Y'));
        $data['sepExpense'] = $this->main->getBalExSumByMonth('09', date('Y'));
        $data['octExpense'] = $this->main->getBalExSumByMonth('10', date('Y'));
        $data['novExpense'] = $this->main->getBalExSumByMonth('11', date('Y'));
        $data['decExpense'] = $this->main->getBalExSumByMonth('12', date('Y'));

        $this->load->view('header');
        $this->load->view('home', $data);
        $this->load->view('footer');

    }
    
}

?>
