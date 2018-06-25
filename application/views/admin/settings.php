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
        <div class="container">

          <div id="basic-tabs" class="section">
            <h4 class="header"><?=$title;?></h4>
            <div class="row">
              <div class="col s12 m4 l3">
                <p>When you click on each tab, only the container with the corresponding tab id will become visible.</p>
              </div>
              <div class="col s12 m8 l9">

                <div class="row">
                  <div class="col s12">
                    <ul class="tabs tab-demo z-depth-1">
                      <li class="tab col s3"><a class="active" href="#test1"><?=lang('edit_profile');?></a>
                      </li>
                      <li class="tab col s3"><a href="#test2"><?=lang('change_password');?></a>
                      </li>
                      <li class="tab col s3"><a href="#test3"><?=lang('system_language');?></a>
                      </li>
                    </ul>
                  </div>
                  <div class="col s12">
                    <div id="test1" class="col s12">
                      <div id="login-page" class="row">
                        <div class="col s12 z-depth-4 card-panel">
                            <?php echo form_open('admin/editdetails', array('class' => 'login-form')); ?>
                            <div class="row">
                              <div class="input-field col s12 center">
                                <h4><?=lang('user_details');?></h4>
                              </div>
                            </div>
                            <div class="row margin">
                              <div class="input-field col s12">
                                <i class="mdi-social-person-outline prefix"></i>
                                <input type="hidden" name="id" value="<?=$user->id;?>">
                                <input id="name3" name="first_name" required="" type="text" value="<?=$user->first_name;?>">
                                <label for="first_name" class="center-align"><?=lang('first_name');?></label>
                              </div>
                            </div>
                            <div class="row margin">
                              <div class="input-field col s12">
                                <i class="mdi-social-person-outline prefix"></i>
                                <input id="name3" name="last_name" required="" type="text" value="<?=$user->last_name;?>">
                                <label for="last_name" class="center-align"><?=lang('last_name');?></label>
                              </div>
                            </div>
                            <div class="row margin">
                              <div class="input-field col s12">
                                <i class="mdi-communication-email prefix"></i>
                                <input id="email" type="email" name="email" required="" value="<?=$user->email;?>">
                                <label for="email" class="center-align"><?=lang('email');?></label>
                              </div>
                            </div>
                            <div class="row margin">
                              <div class="input-field col s12">
                                <input id="contact" name="contact" required="" type="number" value="<?=$user->contact;?>">
                                <label for="Contact" class="center-align"><?=lang('contact');?></label>
                              </div>
                            </div>
                            <div class="row margin">
                              <div class="input-field col s12">
                                <textarea id="message5" class="materialize-textarea" name="address" length="120"><?=$user->address;?></textarea>
                                <label for="address" class="center-align"><?=lang('address');?></label>
                              </div>
                            </div><br>
                            <div class="row">
                              <div class="input-field col s12">
                                <button class="btn waves-effect waves-light col s12" type="submit" name="action"><?=lang('update');?></button>
                              </div>
                            </div><br>
                          </form>
                        </div>
                      </div>
                    </div>
                    <div id="test2" class="col s12">
                      <div id="login-page" class="row">
                        <div class="col s12 z-depth-4 card-panel">
                            <?php echo form_open('admin/passchange', array('class' => 'login-form')); ?>
                            <div class="row margin">
                              <div class="input-field col s12">
                                <i class="mdi-action-lock-outline prefix"></i>
                                <input type="hidden" name="id" value="<?=$user->id;?>">
                                <input id="password3" name="old_password" type="password" required="">
                                <label for="old_password"><?=lang('old_password');?></label>
                              </div>
                            </div>
                            <div class="row margin">
                              <div class="input-field col s12">
                                <i class="mdi-action-lock-outline prefix"></i>
                                <input id="password3" name="password" type="password" required="">
                                <label for="password"><?=lang('new_password');?></label>
                              </div>
                            </div>
                            <div class="row margin">
                              <div class="input-field col s12">
                                <i class="mdi-action-lock-outline prefix"></i>
                                <input id="password3" name="cpassword" required="" type="password">
                                <label for="password"><?=lang('new_confirm_password');?></label>
                              </div>
                            </div><br>
                            <div class="row">
                              <div class="input-field col s12">
                                <button class="btn waves-effect waves-light col s12" type="submit" name="action"><?=lang('change');?></button>
                              </div>
                            </div><br>
                          </form>
                        </div>
                      </div>
                    </div>
                    <div id="test3" class="col s12">
                      <div id="login-page" class="row">
                        <div class="col s12 z-depth-4 card-panel">
                            <?php echo form_open('admin/changelang', array('class' => 'login-form')); ?>
                            <div class="row margin">
                              <div class="input-field col s12">
                                <select name="language" required="" class="initialized">
                                  <option value="" selected=""><?=lang('choose_your_option');?></option>
                                  <option value="english">English</option>
                                  <option value="french">French</option>
                                  <option value="chinese">Chinese</option>
                                  <option value="german">German</option>
                                </select>
                              </div>
                            </div>
                            </div><br>
                            <div class="row">
                              <div class="input-field col s12">
                                <button class="btn waves-effect waves-light col s12" type="submit" name="action"><?=lang('change');?></button>
                              </div>
                            </div><br>
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

              </div>
            </div>
          </div>
        </div>
      </section>

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
                            <div class="col s4"><img src="<?=base_url();?>assets/<?=base_url();?>assets/images/avatar.jpg" alt="" class="circle responsive-img online-user valign profile-image">
                            </div>
                            <div class="col s8">
                                <p>Eileen Sideways</p>
                                <p class="place">Los Angeles, CA</p>
                            </div>
                        </div>
                        <div class="favorite-associate-list chat-out-list row">
                            <div class="col s4"><img src="<?=base_url();?>assets/<?=base_url();?>assets/images/avatar.jpg" alt="" class="circle responsive-img online-user valign profile-image">
                            </div>
                            <div class="col s8">
                                <p>Zaham Sindil</p>
                                <p class="place">San Francisco, CA</p>
                            </div>
                        </div>
                        <div class="favorite-associate-list chat-out-list row">
                            <div class="col s4"><img src="<?=base_url();?>assets/<?=base_url();?>assets/images/avatar.jpg" alt="" class="circle responsive-img offline-user valign profile-image">
                            </div>
                            <div class="col s8">
                                <p>Renov Leongal</p>
                                <p class="place">Cebu City, Philippines</p>
                            </div>
                        </div>
                        <div class="favorite-associate-list chat-out-list row">
                            <div class="col s4"><img src="<?=base_url();?>assets/<?=base_url();?>assets/images/avatar.jpg" alt="" class="circle responsive-img online-user valign profile-image">
                            </div>
                            <div class="col s8">
                                <p>Weno Carasbong</p>
                                <p>Tokyo, Japan</p>
                            </div>
                        </div>
                        <div class="favorite-associate-list chat-out-list row">
                            <div class="col s4"><img src="<?=base_url();?>assets/<?=base_url();?>assets/images/avatar.jpg" alt="" class="circle responsive-img offline-user valign profile-image">
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


  