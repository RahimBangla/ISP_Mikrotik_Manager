<?php 

    $thisUser = getUser($invoice[0]->userid) ;
    $thisPackage = package(getUser($invoice[0]->userid)->package) ;
    $subTotal = $thisPackage->packprice + $thisPackage->value1 + $thisPackage->value2 + $thisPackage->value3 + $thisPackage->value4 + $thisPackage->value5;
    $discountTotal = (int)$invoice[0]->discount;
    $vatTotal = $subTotal * (int)settings()[0]->vat / 100;
    $netTotal = $subTotal - $discountTotal + $vatTotal;
    
?>

<div class="col-md-11 col-sm-11 col-xs-11 rightSideWrapper">
    <div class="x_panel">
        <div class="x_title">
            <h2>Invoice</h2>                    
            <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <div class="col-md-12">
                <div class="invoice-box">
                    <table cellpadding="0" cellspacing="0">
                        <tr class="item info">
                           
                            <td class="title">
                                <img src="<?php echo base_url(); ?>assets/images/final/<?php echo logo(); ?>" style="width:100%; max-width:50px;">
                            </td>
                            <td>
                                <strong>Invoice #:</strong> <?php echo $invoice[0]->invoiceID; ?><br>
                                <strong>Created:</strong> <?php echo $invoice[0]->createdate; ?><br>
                                <strong>Due:</strong> <?php echo $invoice[0]->duedate; ?><br>
                                <strong>Payment Method:</strong> <?php echo settings()[0]->paymentmethod;?><br>
                                <strong>Account:</strong> <?php echo settings()[0]->paymentacc;?><br>
                                <?php if($invoice[0]->status !== "Paid"){ ?> 
                                    <strong>Status: </strong><span class="text-danger"> <?php echo $invoice[0]->status; ?></span><br>
                                <?php }else{ ?>
                                    <strong>Status: </strong><span class="text-success"><?php echo $invoice[0]->status; ?></span><br>
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
                <div class="col-md-11 mediumSpaceTop mediumSpaceBtm">
                    <button class="btn btn-primary right" id="print">Print</button>
                    <button class="btn btn-primary right"><a class="text white" href="<?php echo base_url();?>invoice/generate/<?php echo $invoice[0]->invoiceID; ?>">Generate PDF</a></button>
                    <!--<button class="btn btn-primary right"  href="<?php echo base_url('invoice/paypal/' . $invoice[0]->invoiceID);?>" data-toggle="modal" data-target=".bs-payment-modal-lg">Payment</button>-->
                    <button class="btn btn-primary right"  href="#" data-toggle="modal" data-target=".bs-payment-modal-lg">Pay Now By Paypal/Stripe</button>
                    
                    
                </div>
                
                
                <div class="modal fade bs-payment-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                      <div class="modal-content">

                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                          </button>
                          <h4 class="modal-title" id="myModalLabel">Payment</h4>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-offset-3 col-md-6 smallSpaceBtm">
                                    <img class="invoice-payment-logo paypal" src="<?php echo base_url();?>assets/images/paypal.jpg" alt="paypal">
                                    <a href="<?php echo base_url('invoice/paypal/' . $invoice[0]->invoiceID);?>" class="btn btn-primary col-md-offset-4 col-md-6 payNowBtn">Pay Now (<?php echo settings()[0]->currency . " " . $netTotal; ?>)</a>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-offset-3 col-md-6 smallSpaceBtm">
                                    <img class="invoice-payment-logo stripe" src="<?php echo base_url();?>assets/images/stripe.png" alt="stripe">
                                    <!-- stripe payment form -->
                                    <form action="<?php echo base_url('invoice/stripe/'); ?>" method="post" class="stripe-form" id="payment-form">
                                        <input type="hidden" name="invoiceid" value="<?php echo $invoice[0]->invoiceID; ?>">
                                        <div class="form-row">
                                          <p for="card-element">Credit or debit card</p>
                                          <div id="card-element">
                                            <!-- a Stripe Element will be inserted here. -->
                                          </div>
                                          <!-- Used to display form errors -->
                                          <div id="card-errors"></div>
                                        </div>
                                        <button type="submit" class="btn btn-primary col-md-offset-3 col-md-6 payNowBtn">Pay Now (<?php echo settings()[0]->currency . " " . $netTotal; ?>)</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                          <div class="modal-footer" style="border:0">
                          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>

                      </div>
                    </div>
                  </div>
                
                
                
                <div class="modal fade bs-update-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                      <div class="modal-content">

                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                          </button>
                          <h4 class="modal-title" id="myModalLabel">Manual Invoice Payment</h4>
                        </div>
                        <div class="modal-body">
                          <form class="form-horizontal form-label-left" role="form" enctype="multipart/form-data" method="post" action="<?php echo base_url(); ?>invoice/manual" accept-charset="utf-8">
                            <input id="id" name="id" value="<?php echo $invoice[0]->invoiceID; ?>" type="hidden">
                            
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Status <span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select class="form-control" name="status" required>
                                        <option value="">Select Status</option>                                        
                                        <option value="Paid">Paid</option>
                                        <option value="Unpaid">Unpaid</option>
                                    </select>
                                </div>
                            </div>
                            
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Paid Amount <span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input class="form-control col-md-7 col-xs-12" id="name" name="amount"  type="number" step="0.01" placeholder="Enter Amount" required>
                                </div>
                            </div>                    
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Currency <span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select class="form-control col-md-7 col-xs-12" id="currency" name="currency" required>
                                        <option>Select Currency</option>
                                        <option selected value="<?php echo settings()[0]->currency; ?>" ><?php echo settings()[0]->currency; ?></option>
                                        <option value="DZD" >Algeria Dinars </option>
                                        <option value="ARP" >Argentina Pesos </option>
                                        <option value="AUD" >Australia Dollars </option>
                                        <option value="ATS" >Austria Schillings </option>
                                        <option value="BSD" >Bahamas Dollars </option>
                                        <option value="BBD" >Barbados Dollars </option>
                                        <option value="BDT" >Bangladesh Taka </option>
                                        <option value="BEF" >Belgium Francs </option>
                                        <option value="BMD" >Bermuda Dollars </option>
                                        <option value="BRR" >Brazil Real </option>
                                        <option value="BGL" >Bulgaria Lev </option>
                                        <option value="CAD" >Canada Dollars </option>
                                        <option value="CLP" >Chile Pesos </option>
                                        <option value="CNY" >China Yuan Renmimbi </option>
                                        <option value="CYP" >Cyprus Pounds </option>
                                        <option value="CSK" >Czech Republic Koruna </option>
                                        <option value="DKK" >Denmark Kroner </option>
                                        <option value="NLG" >Dutch Guilders </option>
                                        <option value="XCD" >Eastern Caribbean Dollars </option>
                                        <option value="EGP" >Egypt Pounds </option>
                                        <option value="EUR" >Euro </option>
                                        <option value="FJD" >Fiji Dollars </option>
                                        <option value="FIM" >Finland Markka </option>
                                        <option value="FRF" >France Francs </option>
                                        <option value="DEM" >Germany Deutsche Marks </option>
                                        <option value="GRD" >Greece Drachmas </option>
                                        <option value="HKD" >Hong Kong Dollars </option>
                                        <option value="HUF" >Hungary Forint </option>
                                        <option value="ISK" >Iceland Krona </option>
                                        <option value="INR" >India Rupees </option>
                                        <option value="IDR" >Indonesia Rupiah </option>
                                        <option value="IEP" >Ireland Punt </option>
                                        <option value="ILS" >Israel New Shekels </option>
                                        <option value="ITL" >Italy Lira </option>
                                        <option value="JMD" >Jamaica Dollars </option>
                                        <option value="JPY" >Japan Yen </option>
                                        <option value="JOD" >Jordan Dinar </option>
                                        <option value="KRW" >Korea (South) Won </option>
                                        <option value="LBP" >Lebanon Pounds </option>
                                        <option value="LUF" >Luxembourg Francs </option>
                                        <option value="MYR" >Malaysia Ringgit </option>
                                        <option value="MXP" >Mexico Pesos </option>
                                        <option value="NLG" >Netherlands Guilders </option>
                                        <option value="NZD" >New Zealand Dollars </option>
                                        <option value="NOK" >Norway Kroner </option>
                                        <option value="PKR" >Pakistan Rupees </option>
                                        <option value="PHP" >Philippines Pesos </option>
                                        <option value="PLZ" >Poland Zloty </option>
                                        <option value="PTE" >Portugal Escudo </option>
                                        <option value="ROL" >Romania Leu </option>
                                        <option value="RUR" >Russia Rubles </option>
                                        <option value="SAR" >Saudi Arabia Riyal </option>
                                        <option value="SGD" >Singapore Dollars </option>
                                        <option value="SKK" >Slovakia Koruna </option>
                                        <option value="ZAR" >South Africa Rand </option>
                                        <option value="KRW" >South Korea Won </option>
                                        <option value="ESP" >Spain Pesetas </option>
                                        <option value="SDD" >Sudan Dinar </option>
                                        <option value="SEK" >Sweden Krona </option>
                                        <option value="CHF" >Switzerland Francs </option>
                                        <option value="TWD" >Taiwan Dollars </option>
                                        <option value="THB" >Thailand Baht </option>
                                        <option value="TTD" >Trinidad and Tobago Dollars </option>
                                        <option value="TRL" >Turkey Lira </option>
                                        <option value="GBP" >United Kingdom Pounds </option>
                                        <option value="USD" >United States Dollars </option>
                                        <option value="VEB" >Venezuela Bolivar </option>
                                        <option value="ZMK" >Zambia Kwacha </option>
                                    </select>
                                </div>
                            </div>                    
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Paid Method <span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input class="form-control col-md-7 col-xs-12" id="name" name="method"  type="text" placeholder="Enter Method Ex: Paypal, Stripe, Cash, Bank, Cheque" required>
                                </div>
                            </div>                    
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Payer Acc/Info <span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input class="form-control col-md-7 col-xs-12" id="name" name="accinfo"  type="text" placeholder="Enter Method Info Ex: Account Number" required>
                                </div>
                            </div>  
                            
                            <div class="ln_solid"></div>
                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-3">                                                
                                    <button id="send" type="Save Now!" class="btn btn-success"><i class="material-icons">save</i> Update Now</button>
                                </div>
                            </div>
                        </form>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>

                      </div>
                    </div>
                  </div>
                
            </div>
        </div>
    </div>
</div>

</div><!-- Container -->
