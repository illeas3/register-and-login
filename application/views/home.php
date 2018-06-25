<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!-- START MAIN -->
<div id="main">
    <!-- START WRAPPER -->
    <div class="wrapper">
        <!-- START CONTENT -->
        <section id="content">
            <!--start container-->
            <div class="container">
                <div class="divider"></div>
                <!--Basic Form-->
                <div class="row">
                    <div id="card-alert" class="card green lighten-5">
                      <div class="card-content green-text">
                        <p>SUCCESS : <?=lang('login_success')?>.</p>
                      </div>
                      <button type="button" class="close green-text" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                      </button>
                    </div>
                    <p><?=lang('welcome_to_dashboard')?>!</p>
                </div>
            </div>
        </section>
        <!-- END CONTENT -->
    </div>
    <!-- END WRAPPER -->

</div>
<!-- END MAIN -->

   