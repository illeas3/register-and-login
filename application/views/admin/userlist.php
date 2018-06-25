<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
  <!-- START MAIN -->
  <div id="main">
    <!-- START WRAPPER -->
    <div class="wrapper">

      <!-- START LEFT SIDEBAR NAV-->
      <?php include('sidebar.php');?>
      <!-- END LEFT SIDEBAR NAV-->

      <!-- START CONTENT -->
      <section id="content">
        
        <!--start container-->
        <div class="container">
          <div class="section">

            <!-- <p class="caption">Register user list</p> -->
            <div class="divider"></div>
            <!--DataTables example-->
            <div id="table-datatables">
              <h4 class="header"><?=$title;?></h4>
              <div class="row">
                <div class="col s12 m12 16">
                  <table id="data-table-simple" class="responsive-table display" cellspacing="0">
                    <thead>
                        <tr>
                            <th><?=lang('name');?></th>
                            <th><?=lang('email');?></th>
                            <th><?=lang('contact');?></th>
                            <th><?=lang('address');?></th>
                            <th><?=lang('action');?></th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                 
                    <tfoot>
                        <tr>
                            <th><?=lang('name');?></th>
                            <th><?=lang('email');?></th>
                            <th><?=lang('contact');?></th>
                            <th><?=lang('address');?></th>
                            <th><?=lang('action');?></th>
                            <th></th>
                            <th></th>
                        </tr>
                    </tfoot>
                 
                    <tbody>
                        <?php $allusers= $this->db->get_where('users' , array('userstatus' => 1))->result_array(); 
                        foreach ($allusers as $key => $user) {
                        ?>
                        <tr>
                            <td><?=$user['first_name']." ".$user['last_name'];?></td>
                            <td><?=$user['email'];?></td>
                            <td><?=$user['contact'];?></td>
                            <td><?=$user['address'];?></td>
                            <td><p><a onclick="viewdetails(this.id);" id="<?=$user['id'];?>" class="waves-effect waves-light btn modal-trigger  light-blue" href="#modal1"><th><?=lang('details');?></th></a></p></td>
                            <td><a href="<?=base_url();?>admin/useredit/<?=$user['id'];?>" class="waves-effect waves-light btn-large "><i class="mdi-editor-border-color right"></i><?=lang('edit');?></a></td>
                            <td><a onClick="javascript: return confirm('are you sure you want to delete this user?');" href="<?=base_url();?>admin/userdelete/<?=$user['id'];?>" class="btn-floating waves-effect waves-light "><i class="mdi-content-clear"></i></a></td>
                        </tr>
                        <?php } ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div> 
          </div>
        </div>
        <!--end container-->
      </section>

<!-- View details modal -->
<div id="modal1" class="modal">
  <div class="modal-content" id="modalValue">
  </div>
  <div class="modal-footer">
    <a href="#" class="waves-effect waves-red btn-flat modal-action modal-close">Close</a>
    <!-- <a href="#" class="waves-effect waves-green btn-flat modal-action modal-close">Agree</a> -->
  </div>
</div>
<!-- /View details modal -->

      <!-- END CONTENT -->
      <!-- START RIGHT SIDEBAR NAV-->
      <aside id="right-sidebar-nav">
        <ul id="chat-out" class="side-nav rightside-navigation">
            <li class="li-hover">
            <a href="#" data-activates="chat-out" class="chat-close-collapse right"><i class="mdi-navigation-close"></i></a>
            <div id="right-search" class="row">
                <form class="col s12">
                    <div class="input-field">
                        <i class="mdi-action-search prefix"></i>
                        <input id="icon_prefix" type="text" class="validate">
                        <label for="icon_prefix">Search</label>
                    </div>
                </form>
            </div>
            </li>
            <li class="li-hover">
                <ul class="chat-collapsible" data-collapsible="expandable">
                <li>
                    <div class="collapsible-header teal white-text active"><i class="mdi-social-whatshot"></i>Recent Activity</div>
                    <div class="collapsible-body recent-activity">
                        <div class="recent-activity-list chat-out-list row">
                            <div class="col s3 recent-activity-list-icon"><i class="mdi-action-add-shopping-cart"></i>
                            </div>
                            <div class="col s9 recent-activity-list-text">
                                <a href="#">just now</a>
                                <p>Jim Doe Purchased new equipments for zonal office.</p>
                            </div>
                        </div>
                        <div class="recent-activity-list chat-out-list row">
                            <div class="col s3 recent-activity-list-icon"><i class="mdi-device-airplanemode-on"></i>
                            </div>
                            <div class="col s9 recent-activity-list-text">
                                <a href="#">Yesterday</a>
                                <p>Your Next flight for USA will be on 15th August 2015.</p>
                            </div>
                        </div>
                        <div class="recent-activity-list chat-out-list row">
                            <div class="col s3 recent-activity-list-icon"><i class="mdi-action-settings-voice"></i>
                            </div>
                            <div class="col s9 recent-activity-list-text">
                                <a href="#">5 Days Ago</a>
                                <p>Natalya Parker Send you a voice mail for next conference.</p>
                            </div>
                        </div>
                        <div class="recent-activity-list chat-out-list row">
                            <div class="col s3 recent-activity-list-icon"><i class="mdi-action-store"></i>
                            </div>
                            <div class="col s9 recent-activity-list-text">
                                <a href="#">Last Week</a>
                                <p>Jessy Jay open a new store at S.G Road.</p>
                            </div>
                        </div>
                        <div class="recent-activity-list chat-out-list row">
                            <div class="col s3 recent-activity-list-icon"><i class="mdi-action-settings-voice"></i>
                            </div>
                            <div class="col s9 recent-activity-list-text">
                                <a href="#">5 Days Ago</a>
                                <p>Natalya Parker Send you a voice mail for next conference.</p>
                            </div>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="collapsible-header light-blue white-text active"><i class="mdi-editor-attach-money"></i>Sales Repoart</div>
                    <div class="collapsible-body sales-repoart">
                        <div class="sales-repoart-list  chat-out-list row">
                            <div class="col s8">Target Salse</div>
                            <div class="col s4"><span id="sales-line-1"></span>
                            </div>
                        </div>
                        <div class="sales-repoart-list chat-out-list row">
                            <div class="col s8">Payment Due</div>
                            <div class="col s4"><span id="sales-bar-1"></span>
                            </div>
                        </div>
                        <div class="sales-repoart-list chat-out-list row">
                            <div class="col s8">Total Delivery</div>
                            <div class="col s4"><span id="sales-line-2"></span>
                            </div>
                        </div>
                        <div class="sales-repoart-list chat-out-list row">
                            <div class="col s8">Total Progress</div>
                            <div class="col s4"><span id="sales-bar-2"></span>
                            </div>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="collapsible-header red white-text"><i class="mdi-action-stars"></i>Favorite Associates</div>
                    <div class="collapsible-body favorite-associates">
                        <div class="favorite-associate-list chat-out-list row">
                            <div class="col s4"><img src="<?=base_url();?>assets/images/avatar.jpg" alt="" class="circle responsive-img online-user valign profile-image">
                            </div>
                            <div class="col s8">
                                <p>Eileen Sideways</p>
                                <p class="place">Los Angeles, CA</p>
                            </div>
                        </div>
                        <div class="favorite-associate-list chat-out-list row">
                            <div class="col s4"><img src="<?=base_url();?>assets/images/avatar.jpg" alt="" class="circle responsive-img online-user valign profile-image">
                            </div>
                            <div class="col s8">
                                <p>Zaham Sindil</p>
                                <p class="place">San Francisco, CA</p>
                            </div>
                        </div>
                        <div class="favorite-associate-list chat-out-list row">
                            <div class="col s4"><img src="<?=base_url();?>assets/images/avatar.jpg" alt="" class="circle responsive-img offline-user valign profile-image">
                            </div>
                            <div class="col s8">
                                <p>Renov Leongal</p>
                                <p class="place">Cebu City, Philippines</p>
                            </div>
                        </div>
                        <div class="favorite-associate-list chat-out-list row">
                            <div class="col s4"><img src="<?=base_url();?>assets/images/avatar.jpg" alt="" class="circle responsive-img online-user valign profile-image">
                            </div>
                            <div class="col s8">
                                <p>Weno Carasbong</p>
                                <p>Tokyo, Japan</p>
                            </div>
                        </div>
                        <div class="favorite-associate-list chat-out-list row">
                            <div class="col s4"><img src="<?=base_url();?>assets/images/avatar.jpg" alt="" class="circle responsive-img offline-user valign profile-image">
                            </div>
                            <div class="col s8">
                                <p>Nusja Nawancali</p>
                                <p class="place">Bangkok, Thailand</p>
                            </div>
                        </div>
                    </div>
                </li>
                </ul>
            </li>
        </ul>
      </aside>
      <!-- LEFT RIGHT SIDEBAR NAV-->

    </div>
    <!-- END WRAPPER -->

  </div>
  <!-- END MAIN -->

<script type="text/javascript">
function viewdetails(id) {
   $.ajax({  
        url:"<?php echo base_url();?>ajax/getuser",  
        method:"POST",  
        data:{id:id},  
        success:function(a)  
        { 
            $('#modalValue').html(a);
        }  
    });
}
</script>


  