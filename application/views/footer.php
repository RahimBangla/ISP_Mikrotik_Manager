
            <footer>
                    <div class="">
                        <p class="pull-right"><?php echo settings()[0]->name; ?> | <?php echo settings()[0]->slogan; ?> | <?php echo settings()[0]->copyright; ?></p>
                    </div>
                    <div class="clearfix"></div>
                </footer>

    <script> var baseurl = "<?php echo base_url(); ?>";</script>    
    <script type="text/javascript" src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>
    
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/vfs_fonts.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.10.16/b-1.5.1/b-flash-1.5.1/b-html5-1.5.1/b-print-1.5.1/r-2.2.1/datatables.min.js"></script>
    
    
      
    <script type="text/javascript" src="<?php echo base_url();?>assets/js/custom.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>assets/js/validator/validator.js"></script> 
    
    <?php if($this->uri->segment(1) == "invoice" && $this->uri->segment(2) == "view" || $this->uri->segment(1) == "user" && $this->uri->segment(2) == "invoiceview"){ ?>
    <!-- Stripe JS -->
    <script src="https://js.stripe.com/v3/"></script>
    <!-- Your JS File -->
    <script src="<?php echo base_url();?>assets/js/stripecharge.js"></script>
    <?php } ?>
    

                
                
    
</body>
</html>