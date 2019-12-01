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

class Router extends CI_Controller {

    function __construct() {
        parent::__construct();
    }

    public function index() {
        // phpinfo();
        try {

            $client = new RouterOS\Client('192.168.0.3', 'admin', '');
            //echo 'OK';

            // $responses = $client->sendSync(new RouterOS\Request('/ip/arp/print'));
            //
            // foreach ($responses as $response) {
            //     if ($response->getType() === RouterOS\Response::TYPE_DATA) {
            //         echo 'IP: ' . $response->getProperty('address') . '<br><br> MAC: ', $response->getProperty('mac-address') . "<br><br>";
            //     }
            // }


            // $addRequest = new RouterOS\Request('/ip/arp/add');
            //
            // $addRequest->setArgument('address', '192.168.0.7');
            // $addRequest->setArgument('mac-address', '00:00:00:00:00:01');
            // $addRequest->setArgument('interface', 'ether1');
            // if ($client->sendSync($addRequest)->getType() !== RouterOS\Response::TYPE_FINAL) {
            //     die("Error when creating ARP entry for '192.168.88.100'");
            // }
            //
            // $addRequest->setArgument('address', '192.168.0.8');
            // $addRequest->setArgument('mac-address', '00:00:00:00:00:02');
            // $addRequest->setArgument('interface', 'ether1');
            // if ($client->sendSync($addRequest)->getType() !== RouterOS\Response::TYPE_FINAL) {
            //     die("Error when creating ARP entry for '192.168.88.101'");
            // }
            //
            // echo 'OK';


            ?>


        <table>
            <thead>
                <tr>
                    <th>Time</th>
                    <th>Topics</th>
                    <th>Message</th>
                </tr>
            </thead>
            <tbody>
                <?php

                $util = new RouterOS\Util($client);
                foreach ($util->setMenu('/log')->getAll() as $entry) { ?>
                    
                <tr>
                    <td><?php echo $entry('time'); ?></td>
                    <td>
                    <?php foreach (explode(',', $entry('topics')) as $topic) { ?>
                        <span><?php echo $topic; ?></span>
                    <?php } ?>
                    </td>
                    <td><?php echo $entry('message'); ?></td>
                </tr>
                <?php } ?>
            </tbody>
        </table>


        <?php

        } catch (Exception $e) {
            echo $e->getMessage();
        }

    }


}

?>
