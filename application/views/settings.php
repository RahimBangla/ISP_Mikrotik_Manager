
<div class="col-md-11 col-sm-11 col-xs-11 rightSideWrapper">
    <div class="x_panel">
        <div class="x_title">
            <h2><i class="material-icons">settings</i> Settings</h2>

            <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <?php foreach ($settings as $set) : ?>
                <form id="settings" class="form-horizontal form-label-left" role="form" enctype="multipart/form-data" method="post" action="<?php echo base_url(); ?>settings/insert" accept-charset="utf-8">

                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Logo</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input class="form-control col-md-7 col-xs-12" name="logo" type="file">
                        </div>
                    </div>

                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Favicon</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input class="form-control col-md-7 col-xs-12" name="favicon" type="file">
                        </div>
                    </div>

                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Company Name <span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input class="form-control col-md-7 col-xs-12" id="name" name="name" type="text" placeholder="Enter Name Here" value="<?php echo $set->name; ?>" required>
                        </div>
                    </div>

                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Slogan <span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input class="form-control col-md-7 col-xs-12" id="name" name="slogan" type="text" placeholder="Enter Slogan Here" value="<?php echo $set->slogan; ?>" required>
                        </div>
                    </div>

                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Mobile <span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input class="form-control col-md-7 col-xs-12" id="mobile" name="mobile" type="text" placeholder="Enter Mobile Number" value="<?php echo $set->mobile; ?>" required>
                        </div>
                    </div>

                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Email <span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input class="form-control col-md-7 col-xs-12" id="email" name="email" type="email" placeholder="Enter Email" value="<?php echo $set->email; ?>" required>
                        </div>
                    </div>

                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Default Currency <span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">

                            <select class="form-control col-md-7 col-xs-12" id="currency" name="currency" required>
                                <option>Select Currency</option>
                                <option selected value="<?php echo $set->currency; ?>" ><?php echo $set->currency; ?></option>
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
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Default Payment Mehtod <span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input class="form-control col-md-7 col-xs-12" name="paymentmethod" type="text" placeholder="Enter Default Payment Ex: Paypal/Stripe" value="<?php echo $set->paymentmethod; ?>" required>
                        </div>
                    </div>

                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Default Payment Recipient <span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input class="form-control col-md-7 col-xs-12" name="paymentacc" type="text" placeholder="Enter Default Payment ID Ex: Paypal/Stripe ID" value="<?php echo $set->paymentacc; ?>" required>
                        </div>
                    </div>

                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Default VAT <span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input class="form-control col-md-7 col-xs-12" name="vat" type="number" placeholder="Enter Default VAT amount" value="<?php echo $set->vat; ?>" required>
                        </div>
                    </div>

                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Default Email API <span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <select class="form-control col-md-7 col-xs-12" name="emailapi">
                                <option value="">Select Email API</option>
                                <option selected value="<?php echo $set->emailapi; ?>"><?php echo $set->emailapi; ?> (Current)</option>
                                <option value="Mailgun">Mailgun</option>
                            </select>
                        </div>
                    </div>

                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Default SMS API <span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <select class="form-control col-md-7 col-xs-12" name="smsapi">
                                <option value="">Select SMS API</option>
                                <option selected value="<?php echo $set->smsapi; ?>"><?php echo $set->smsapi; ?> (Current)</option>
                                <option value="Nexmo">Nexmo</option>
                                <option value="Twilio">Twilio</option>
                            </select>
                        </div>
                    </div>

                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Send SMS On New Bills & Invoice <span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <select class="form-control col-md-7 col-xs-12" name="smsonbills">
                                <option value="">Select SMS On/Off</option>
                                <option selected value="<?php echo $set->smsonbills; ?>"><?php echo ($set->smsonbills == 1) ? 'On' : "Off" ; ?> (Current)</option>
                                <option value="1">On</option>
                                <option value="0">Off</option>
                            </select>
                        </div>
                    </div>


                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Send Email On New Bills & Invoice <span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <select class="form-control col-md-7 col-xs-12" name="emailonbills">
                                <option value="">Select Email On/Off</option>
                                <option selected value="<?php echo $set->emailonbills; ?>"><?php echo ($set->emailonbills == 1) ? 'On' : "Off" ; ?> (Current)</option>
                                <option value="1">On</option>
                                <option value="0">Off</option>
                            </select>
                        </div>
                    </div>

                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Mikrotik IP Address <span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input class="form-control col-md-7 col-xs-12" name="mkipadd" type="text" placeholder="Enter Your Mikrotik Router IP" value="<?php echo $set->mkipadd; ?>" required>
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Mikrotik User <span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input class="form-control col-md-7 col-xs-12" name="mkuser" type="text" placeholder="Enter Mikrotik User" value="<?php echo $set->mkuser; ?>" required>
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Mikrotik Password <span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input class="form-control col-md-7 col-xs-12" name="mkpassword" type="password" placeholder="Enter Mikrotik Password" value="<?php echo $set->mkpassword; ?>" required>
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Address <span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input class="form-control col-md-7 col-xs-12" name="address" type="text" placeholder="Enter Address" value="<?php echo $set->address; ?>" required>
                        </div>
                    </div>

                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">City <span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input class="form-control col-md-7 col-xs-12" name="city" type="text" placeholder="Enter City" value="<?php echo $set->city; ?>" required>
                        </div>
                    </div>

                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Country <span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input class="form-control col-md-7 col-xs-12" name="country" type="text" placeholder="Enter Country" value="<?php echo $set->country; ?>" required>
                        </div>
                    </div>

                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Zip Code <span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input class="form-control col-md-7 col-xs-12" name="zip" type="text" placeholder="Enter Zip Code" value="<?php echo $set->zip; ?>" required>
                        </div>
                    </div>

                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Copyright Text</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input class="form-control col-md-7 col-xs-12" id="location" name="copyright" type="text" placeholder="Enter Copyright Text" value="<?php echo $set->copyright; ?>">
                        </div>
                    </div>

                    <div class="ln_solid"></div>

                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-3">
                            <button id="settingsSubmit" type="submit" class="btn btn-success"><i class="material-icons">done</i> Save Now</button>
                        </div>
                    </div>

                </form>
            <?php endforeach; ?>
        </div>
    </div>
</div>
</div><!-- Container -->
