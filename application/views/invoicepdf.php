<?php 

    $thisUser = getUser($invoice[0]->userid) ;
    $thisPackage = package(getUser($invoice[0]->userid)->package) ;
    $subTotal = $thisPackage->packprice + $thisPackage->value1 + $thisPackage->value2 + $thisPackage->value3 + $thisPackage->value4 + $thisPackage->value5;
    $extraCostSubTotal = $invoice[0]->value1 + $invoice[0]->value2 + $invoice[0]->value3 + $invoice[0]->value4 + $invoice[0]->value5;
    $discountTotal = (int)$invoice[0]->discount;
    $subTotal = $subTotal + $extraCostSubTotal;
    $vatTotal = $subTotal * (int)settings()[0]->vat / 100;
    $netTotal = ($subTotal - $discountTotal) + $vatTotal;
?>

<style>
    
/********* Invoice Style *********/ 

.invoice-box {
    margin: 0;
    padding: 30px;
    border: 1px solid #eee;
    font-size: 14px;
    line-height: 25px;
    color: #555;
    float: left;
    width: 100% !important;
}

.invoice-box table {
    width: 140%;
}

</style>


<div class="invoice-box">
    <table cellpadding="0" cellspacing="0">
        <tr class="item info">

            <td class="title">
                <img src="<?php echo base_url(); ?>assets/images/final/<?php echo logo(); ?>" style="width:50px; max-width:50px;">
            </td>
            <td>
                <strong>Invoice #:</strong> <?php echo $invoice[0]->invoiceID; ?><br>
                <strong>Created:</strong> <?php echo $invoice[0]->createdate; ?><br>
                <strong>Due:</strong> <?php echo $invoice[0]->duedate; ?><br>
                <strong>Payment Method:</strong> <?php echo settings()[0]->paymentmethod;?><br>
                <strong>Account:</strong> <?php echo settings()[0]->paymentacc;?><br>
                <?php if($invoice[0]->status !== "Paid"){ ?> 
                    <strong>Status:</strong><span class="text-danger"> <?php echo $invoice[0]->status; ?></span><br>
                <?php }else{ ?>
                    <strong>Status:</strong><span class="text-success"><?php echo $invoice[0]->status; ?></span><br>
                    <strong>Paid Amount:</strong> <?php echo $invoice[0]->paidamount; ?><br>
                    <strong>Paid Method:</strong> <?php echo $invoice[0]->paidmethod; ?><br>
                    <strong>Paid Acc. Info:</strong> <?php echo $invoice[0]->paidacc; ?><br><br>
                <?php } ?>
            </td>
        </tr>
        <tr class="item info">                            
            <td>
                <br><strong><?php echo settings()[0]->name;?></strong><br>
                <?php echo settings()[0]->slogan;?><br>
                <?php echo settings()[0]->address;?><br>
                <?php echo settings()[0]->city;?>, <?php echo settings()[0]->country;?>, <?php echo settings()[0]->zip;?><br>
                <?php echo settings()[0]->mobile;?><br>
                <?php echo settings()[0]->email;?><br><br>
            </td>
            <td>
                <br><strong><?php echo $thisUser->name; ?></strong><br>
               <?php echo $thisPackage->packname . " (" . $thisPackage->packvolume . ")" ; ?><br>
                <?php echo $thisUser->area; ?>, <?php $thisUser->location; ?><br>
                <?php echo $thisUser->mobile; ?><br>
                <?php echo $thisUser->email; ?><br><br>
            </td>
        </tr>

        <tr class="item">
            <td><strong>Package/Services</strong></td>
            <td><strong>Amount</strong></td>
        </tr>

        <tr class="item">
            <td><?php echo $thisPackage->packname . " (" . $thisPackage->packvolume . ")" ; ?></td>
            <td><?php echo settings()[0]->currency . " " . number_format($thisPackage->packprice, 2); ?></td>
        </tr>
        <?php if($thisPackage->cost1){ ?>
            <tr class="item">
                <td><?php echo $thisPackage->cost1; ?></td>
                <td><?php echo settings()[0]->currency . " " . number_format($thisPackage->value1, 2); ?></td>
            </tr>
        <?php }?>
        <?php if($thisPackage->cost2){ ?>
            <tr class="item">
                <td><?php echo $thisPackage->cost2; ?></td>
                <td><?php echo settings()[0]->currency . " " . number_format($thisPackage->value2, 2); ?></td>
            </tr>
        <?php }?>
        <?php if($thisPackage->cost3){ ?>
            <tr class="item">
                <td><?php echo $thisPackage->cost3; ?></td>
                <td><?php echo settings()[0]->currency . " " . number_format($thisPackage->value3, 2); ?></td>
            </tr>
        <?php }?>
        <?php if($thisPackage->cost4){ ?>
            <tr class="item">
                <td><?php echo $thisPackage->cost4; ?></td>
                <td><?php echo settings()[0]->currency . " " . number_format($thisPackage->value4, 2); ?></td>
            </tr>
        <?php }?>
        <?php if($thisPackage->cost5){ ?>
            <tr class="item">
                <td><?php echo $thisPackage->cost5; ?></td>
                <td><?php echo settings()[0]->currency . " " . number_format($thisPackage->value5, 2); ?></td>
            </tr>
        <?php }?>
            
        <?php if($invoice[0]->cost1){ ?>
	<tr class="item">
		<td><?php echo $invoice[0]->cost1; ?></td>
		<td><?php echo settings()[0]->currency . " " . number_format($invoice[0]->value1, 2); ?></td>
	</tr>
        <?php }?>
        <?php if($invoice[0]->cost2){ ?>
                <tr class="item">
                        <td><?php echo $invoice[0]->cost2; ?></td>
                        <td><?php echo settings()[0]->currency . " " . number_format($invoice[0]->value2, 2); ?></td>
                </tr>
        <?php }?>
        <?php if($invoice[0]->cost3){ ?>
                <tr class="item">
                        <td><?php echo $invoice[0]->cost3; ?></td>
                        <td><?php echo settings()[0]->currency . " " . number_format($invoice[0]->value3, 2); ?></td>
                </tr>
        <?php }?>
        <?php if($invoice[0]->cost4){ ?>
                <tr class="item">
                        <td><?php echo $invoice[0]->cost4; ?></td>
                        <td><?php echo settings()[0]->currency . " " . number_format($invoice[0]->value4, 2); ?></td>
                </tr>
        <?php }?>
        <?php if($invoice[0]->cost5){ ?>
                <tr class="item">
                        <td><?php echo $invoice[0]->cost5; ?></td>
                        <td><?php echo settings()[0]->currency . " " . number_format($invoice[0]->value5, 2); ?></td>
                </tr>
        <?php }?>    


        <tr class="item">
            <td><strong>Subtotal</strong></td>
            <td><strong><?php echo settings()[0]->currency . " " . number_format($subTotal, 2); ?></strong></td>
        </tr>
        <tr class="item">
            <td><strong>Discount</strong></td>
            <td><strong><?php echo settings()[0]->currency . " " . number_format($discountTotal, 2); ?></strong></td>
        </tr>
        <tr class="item">
            <td><strong>Vat (<?php echo settings()[0]->vat;?>%)</strong></td>
            <td><strong><?php echo settings()[0]->currency . " " . number_format($vatTotal, 2); ?></strong></td>
        </tr>
        <tr class="item">
            <td><strong>Total</strong></td>
            <td><strong><?php echo settings()[0]->currency . " " . number_format($netTotal, 2); ?></strong></td>
        </tr>
    </table>
</div>