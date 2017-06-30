<?php
if (preg_match('/(?i)msie [5-8]/', $_SERVER['HTTP_USER_AGENT'])) {
 echo ($_SERVER['HTTP_USER_AGENT']);
 echo "<h2>Sorry! Your browser is outdated and not compatible with this site!!!</h2> "
 . "Please use any modern browsers such as Firefox, Opera, Chrome, IE 10+ ";
 exit;
}
$dont_check_login = true;
?>
<?php
if (file_exists('install.php')) {
 if (isset($_GET['install'])) {
  if ($_GET['install'] == 'done') {
   // Delete the insatll file after installation
   @unlink('install.php');
   // Redirect to main page
   header('location: index.php');
  }
 } else {
  header('location: install.php');
 }
 return;
}
?>
<?php
$content_class = true;
if (empty($_GET['class_name']) && empty($_GET['cname'])) {
 $class_names[] = 'content';
} else if (!empty($_GET['class_name'])) {
 $class_names[] = $_GET['class_name'];
} elseif (!empty($_GET['cname'])) {
 $class_names[] = $_GET['cname'];
}
?>
<?php
include_once("includes/functions/loader.inc");
?>
<!DOCTYPE html>
<html>
 <head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <?php
  if (!empty($metaname_description)) {
   echo "<meta name='description' content=\"MyERP - A Open Source PHP based Enterprise Management System\">";
  }
  ?>
  <meta name="keywords" content="ERP,PHP ERP,Open Source ERP ">
  <title><?php echo isset($pageTitle) ? $pageTitle . ' - MyERP!' : ' MyERP! ' ?></title>
  <link rel="shortcut icon" type="image/x-icon" href="files/favicon.ico">
  <link href="<?php
//  echo THEME_URL;
//  echo (!empty($content_class)) ? '/content_layout.css' : '/layout.css'
  ?>" media="all" rel="stylesheet" type="text/css" />
  <link href="<?php echo THEME_URL; ?>/public.css" media="all" rel="stylesheet" type="text/css" />
  <link href="<?php echo THEME_URL; ?>/menu.css" media="all" rel="stylesheet" type="text/css" />
  <link href="<?php echo THEME_URL; ?>/jquery.css" media="all" rel="stylesheet" type="text/css" />
  <?php
  if (!empty($css_file_paths)) {
   foreach ($css_file_paths as $key => $css_file) {
    ?>
    <link href="<?php echo HOME_URL . $css_file; ?>" media="all" rel="stylesheet" type="text/css" />
    <?php
   }
  }
  ?>
  <link href="<?php echo HOME_URL; ?>tparty/bootstrap/css/bootstrap.css" rel="stylesheet">
  <!-- Styles -->
  <link href="<?php echo HOME_URL; ?>tparty/bootstrap/css/style.css" rel="stylesheet">
  <!-- Carousel Slider -->
  <link href="<?php echo HOME_URL; ?>tparty/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <link href='https://fonts.googleapis.com/css?family=PT+Sans:400,400italic,700,700italic' rel='stylesheet' type='text/css'>
  <link href='https://fonts.googleapis.com/css?family=Lato:400,300,400italic,300italic,700,700italic,900' rel='stylesheet' type='text/css'>
  <link href='https://fonts.googleapis.com/css?family=Exo:400,300,600,500,400italic,700italic,800,900' rel='stylesheet' type='text/css'>
  <link href="<?php echo HOME_URL; ?>themes/default/index.css" media="all" rel="stylesheet" type="text/css" />
  <script src="<?php echo HOME_URL; ?>includes/js/jquery-2.0.3.min.js"></script>
  <script src="<?php echo HOME_URL; ?>includes/js/jquery-ui.min.js"></script>
  <script src="<?php echo HOME_URL; ?>tparty/bootstrap/js/bootstrap.min.js"></script>
  <script src="<?php echo HOME_URL; ?>tparty/bootstrap/js/menu.js"></script>
  <script src="<?php echo HOME_URL; ?>includes/js/custom/tinymce/tinymce.min.js"></script>
  <script src="<?php echo HOME_URL; ?>includes/js/save.js"></script>
  <script src="<?php echo HOME_URL; ?>includes/js/custom_plugins.js"></script>
  <script src="<?php echo HOME_URL; ?>includes/js/basics.js"></script>
  <script src="<?php echo HOME_URL; ?>includes/js/jssor.slider.mini.js"></script>

  <?php
  if (!empty($js_file_paths)) {
   foreach ($js_file_paths as $key => $js_file) {
    ?>
    <script src="<?php echo HOME_URL . $js_file; ?>"></script>
    <?php
   }
  }
  ?>
 </head>
 <body>

  <nav class="navbar navbar-default navbar-fixed-top">
   <div id="topbar" class="topbar clearfix ">
    <div class="container">
     <div class="row ">
      <?php
      if ($showBlock) {
       echo '<div id = "header_top" class = "clear"></div>';
      }
      ?>
      <div class="dashborad_l col-lg-4 col-md-4 col-sm-3 col-xs-6 ">
       <?php
       $show_header_links = true;
       if ((!empty($mode)) && ($mode > 8) && !empty($access_level) && $access_level > 3) {
        if (empty($current_page_path)) {
         $current_page_path = thisPage_url();
        }
        $f->form_button_withImage($current_page_path);
        $show_header_links = false;
       }
       ?>
       <?php if ($show_header_links) { ?>
        <div class="social-icons">
         <span class="hidden-sm hidden-md hidden-lg"><a class="fa fa-navicon clickable right_navicon" href="#"></a><div id="navbar-collapse-right" class="hidden"><j class="fa fa-close ino-close-right-navbar clickable white-font-link" title="close navigation"></j><?php echo $menu_line->show_menu_list(1); ?></div></span>
         <span><a class="fa fa-dashboard clickable erp_dashborad" href="form.php?class_name=user_dashboard_v&mode=2" title="<?php echo gettext('ERP Dashboard') ?>"></a></span>
        </div><!-- end social icons -->
       <?php } ?>

      </div><!-- end columns -->


      <div class="callus col-lg-6 col-md-6 col-sm-7 hidden-xs">
       <span class="topbar-email"><i class="fa fa-envelope"></i> <a href="<?php echo HOME_URL . 'content.php?mode=9&content_type=web_contact' ?>"><?php echo!empty($si->email) ? $si->email : gettext('contact@site.org'); ?></a></span>
       <span class="topbar-phone"><i class="fa fa-phone"></i> <a href="#"><?php echo!empty($si->phone_no) ? $si->phone_no : '1-111-1111' ?></a></span>
      </div><!-- end callus -->
      <div class="topbar-login col-lg-2 col-md-2 col-sm-2 col-xs-6 "><?php ino_topbar_login(); ?></div><!-- end top menu -->

     </div>
    </div><!-- end container -->
   </div><!-- end topbar -->

   <header id="header-style-1">
    <div class="container ino-top-nav">
     <div class="navbar-header">
      <img src="<?php
      echo HOME_URL;
      echo!empty($si->logo_path) ? $si->logo_path : 'files/logo.png'
      ?>" class="logo_image" alt="logo"/>
      <a href="<?php echo HOME_URL; ?>" class="navbar-brand"><?php echo!empty($si->site_name) ? $si->site_name : 'inoERP'; ?></a>
     </div>
     <div id="navbar-collapse-1" class="navbar-collapse collapse navbar-right"> <?php echo $menu_line->show_menu_list(1); ?></div>
    </div>
   </header>
  </nav>
  <?php
  if ($showBlock) {
   echo '<div id="header_bottom"></div>';
  }
  ?>

  <?php
  if ($si->maintenance_cb == 1) {
   echo ino_access_denied('Site is under maintenance mode');
   return;
  }

  if (!empty($access_denied_msg)) {
   echo ino_access_denied($access_denied_msg);
   return;
  }
  ?>

  <!-- end grey-wrapper -->

  <div class="jt-shadow white-wrapper first_content">
      <div class="container">
          <div class="col-md-6">
              <div class="embed-responsive embed-responsive-16by9">
                  <img src="files/inoerp_dashboard.PNG" class="img-responsive" alt="inoERP Dashboard Image">
              </div>

              <!--  </div><!-- end accordion first -->
              <!--  </div> --><!-- end widget -->
          </div><!-- end col-lg-6 -->
          <div class="col-md-5 ">
              <div class="release_message">
      <span class="longHeading">MyERP là một hệ thống web dựa trên hệ thống quản lý doanh nghiệp tổng thể.
        <br>
       Mục tiêu của hệ thống MyERP là cung cấp <span class="text-success">một hệ thống kéo động dựa trên các giao dịch tự động </span>(using IOT & RFID)
      </span>
                  <span class="heading">MyERP 0.1 </span>
                  MyERP version 0.1 được phát hành ngày 01/05/2017 dựa trên hệ thống mã nguồn mở InoERP
                  <br>
                  <form action="https://www.google.com" id="cse-search-box" target="_blank">
                      <div>
                          <input type="hidden" name="cx" value="partner-pub-3081028146173931:7997050045" />
                          <input type="hidden" name="ie" value="UTF-8" />
                          <input type="text" name="q" size="40" />
                          <input type="submit" name="sa" value="Search" />
                      </div>
                  </form>
                  <script type="text/javascript" src="https://www.google.com/coop/cse/brand?form=cse-search-box&amp;lang=en"></script>

              </div>
          </div><!-- end col-lg-6 -->
      </div><!-- end container -->
  </div>

  <div class="grey-wrapper jt-shadow no-padding-imp">
      <div class="container">
          <div class="text-center text-warning"><h1> Modules & Extensions</h1></div>
          <div class="col-md-4 col-sm-6">
              <div class="panel panel-ino-light-grey">
                  <!-- Default panel contents -->
                  <div class="panel-heading  text-center large-text-bold"><i class="fa fa-bank"></i> Tài chính</div>
                  <div class="panel-body">
                      <ul class="list-group">
                          <li class="list-group-item">Khoản phải trả</li>
                          <li class="list-group-item">Khoản phải thu</li>
                          <li class="list-group-item">Tài sản cố định</li>
                          <li class="list-group-item">Sổ cái</li>
                          <li class="list-group-item">Hóa đơn dự án</li>
                          <li class="list-group-item">Chi phí dự án</li>
                      </ul>
                  </div>
              </div>
          </div>


          <div class="col-md-4 col-sm-6">
              <div class="panel panel-ino-light-grey">
                  <!-- Default panel contents -->
                  <div class="panel-heading text-center large-text-bold"><i class="fa fa-truck"></i> Chuỗi cung ứng</div>
                  <div class="panel-body">
                      <ul class="list-group">
                          <li class="list-group-item">Bán hàng</li>
                          <li class="list-group-item">Kho</li>
                          <li class="list-group-item">Mua sắm</li>
                          <li class="list-group-item">Dự báo và lặp KH</li>
                          <li class="list-group-item">Điểm bán lẻ</li>
                          <li class="list-group-item">Thương mại điện tử</li>
                      </ul>
                  </div>
              </div>
          </div>

          <div class="col-md-4 col-sm-6">
              <div class="panel panel-ino-light-grey">
                  <!-- Default panel contents -->
                  <div class="panel-heading text-center large-text-bold"><i class="fa fa-cogs"></i> Sản xuất</div>
                  <div class="panel-body">
                      <ul class="list-group">
                          <li class="list-group-item">Nguyên vật liệu</li>
                          <li class="list-group-item">Công thức</li>
                          <li class="list-group-item">Quản lý giá thành</li>
                          <li class="list-group-item">Chất lượng</li>
                          <li class="list-group-item">Tiến trình sản xuất</li>
                          <li class="list-group-item">Thực thi sản xuất</li>
                      </ul>
                  </div>
              </div>
          </div>

          <div class="col-md-4 col-sm-6">
              <div class="panel panel-ino-light-grey">
                  <!-- Default panel contents -->
                  <div class="panel-heading text-center large-text-bold"><i class="fa fa-life-bouy"></i> Dịch vụ & hỗ trợ</div>
                  <div class="panel-body">
                      <ul class="list-group">
                          <li class="list-group-item">Hợp đồng dịch vụ</li>
                          <li class="list-group-item">Help Desk</li>
                          <li class="list-group-item">Quản lý thay đổi</li>
                          <li class="list-group-item">Quản lý tài liệu</li>
                          <li class="list-group-item">Bảo trì tài sản</li>
                          <li class="list-group-item">RFID & Barcode</li>
                      </ul>
                  </div>
              </div>
          </div>

          <div class="col-md-4 col-sm-6">
              <div class="panel panel-ino-light-grey">
                  <!-- Default panel contents -->
                  <div class="panel-heading text-center large-text-bold"><i class="fa fa-users"></i> Nhân sự</div>
                  <div class="panel-body">
                      <ul class="list-group">
                          <li class="list-group-item">Nhân viên</li>
                          <li class="list-group-item">Compensation, Payroll & Expense</li>
                          <li class="list-group-item">Approval Process</li>
                          <li class="list-group-item">Timesheet & Leave Management</li>
                          <li class="list-group-item">Self Service</li>
                          <li class="list-group-item">Work Structure</li>
                      </ul>
                  </div>
              </div>
          </div>


          <div class="col-md-4 col-sm-6">
              <div class="panel panel-ino-light-grey">
                  <!-- Default panel contents -->
                  <div class="panel-heading  text-center large-text-bold"><i class="fa fa-sliders"></i> Mở rộng</div>
                  <div class="panel-body">
                      <ul class="list-group">
                          <li class="list-group-item">User, Role & Group</li=>
                          <li class="list-group-item">Quản trị nội dung</li>
                          <li class="list-group-item">Thông báo, eMail & Chat</li>
                          <li class="list-group-item">Site, Theme & Blocks</li>
                          <li class="list-group-item">Custom Form, Reports, Menus</li>
                          <li class="list-group-item">...Many More..</li>
                      </ul>
                  </div>
              </div>
          </div>

      </div>

  </div>

  <div class="green-wrapper jt-shadow padding-top">
      <div class="container">
          <div id="slider_msg">
              <div id="slider1_container" style="position: relative; width: 900px; height: 400px; overflow: hidden;">

                  <!-- Loading Screen -->
                  <div u="loading" style="position: absolute; top: 0px; left: 0px;">
                      <div style="filter: alpha(opacity=70); opacity:0.7; position: absolute; display: block;
            background-color: #000; top: 0px; left: 0px;width: 100%;height:100%;">
                      </div>
                      <div style="position: absolute; display: block; background: url(files/images/loading.gif) no-repeat center center;
            top: 0px; left: 0px;width: 100%;height:100%;">
                      </div>
                  </div>

                  <!-- Slides Container -->
                  <div u="slides" style="cursor: move; position: absolute; left: 0px; top: 0px; width: 900px; height: 400px;
           overflow: hidden;">
                      <div>
                          <a u=image href="#"><img src="files/images/landscape/simple_ui1.png" /></a>
                          <div u=caption t="*" class="captionOrange"  style="position:absolute; left:600px; top: 30px; width:300px; height:250px;">
                              Simple & Consistent User Interface across all the document forms, reports and search forms. <br>
                          </div>
                      </div>
                      <div>
                          <a u=image href="#"><img src="files/images/landscape/easy_navigation1.png" /></a>
                          <div u=caption t="*" class="captionOrange"  style="position:absolute; left:600px; top: 30px; width:300px; height:300px;">
                              Easy Navigation - Laptop, Tablet & Mobile. <br> Easy data entry through barcode enabled forms and labels.
                          </div>
                      </div>
                      <div>
                          <a u=image href="#"><img src="files/images/landscape/dynamic_search1.png" /></a>
                          <div u=caption t="*" class="captionOrange"  style="position:absolute; left:600px; top: 30px; width:300px; height:300px;">
                              Powerful & Dynamic Searching Capabilities. <br>Can be customized on the fly to suit various business requirements.
                          </div>
                      </div>
                      <div>
                          <a u=image href="#"><img src="files/images/landscape/graphical_reports.gif" /></a>
                          <div u=caption t="*" class="captionOrange"  style="position:absolute; left:600px; top: 30px; width:300px; height:330px;">
                              Text & Visual Reporting. Visual reports are dynamically generated SVG images. <br>Text reports can be downloaded in any format, such as
                              Excel, Pdf, Word Doc & etc.
                          </div>
                      </div>
                  </div>

                  <!-- Bullet Navigator Skin Begin -->
                  <!-- jssor slider bullet navigator skin 01 -->

                  <!-- bullet navigator container -->
                  <div u="navigator" class="jssorb01" style="position: absolute; bottom: 16px; right: 10px;">
                      <!-- bullet navigator item prototype -->
                      <div u="prototype" style="POSITION: absolute; WIDTH: 12px; HEIGHT: 12px;"></div>
                  </div>
                  <!-- Bullet Navigator Skin End -->

                  <!-- Arrow Navigator Skin Begin -->

                  <!-- Arrow Left -->
                  <span u="arrowleft" class="jssora05l" style="width: 40px; height: 40px; top: 123px; left: 8px;">
      </span>
                  <!-- Arrow Right -->
                  <span u="arrowright" class="jssora05r" style="width: 40px; height: 40px; top: 123px; right: 8px">
      </span>

              </div>
          </div>

      </div>
  </div>


  <div class="white-wrapper no-padding-imp">
      <div class="container">
          <div style="text-align:center;"> <h1>Các tính năng đặc biệt</h1></div>
          <div class="services_vertical">
              <div class="col-sm-6">
                  <div class="service_vertical_box">
                      <div class="service-icon">
                          <i class="fa fa-lightbulb-o fa-4x"></i>
                      </div>
                      <h3>Hệ thống kéo động</h3>
                      <p>
                          Hệ thống kéo động là phiên bản nâng cao của hệ thống kéo, nó đã bao gồm những tính năng nâng cao của hệ thống kéo truyền thống. </p>
                  </div><!-- end service_vertical_box -->
              </div><!-- end col-lg-4 -->
              <div class="col-sm-6">
                  <div class="service_vertical_box">
                      <div class="service-icon">
                          <i class="fa fa-cogs fa-4x"></i>
                      </div>
                      <h3>Xây dựng báo cáo</h3>
                      <p>Hệ thống hỗ trợ xây dựng các câu truy vấn kéo thả, mà có thể tạo nhiều loại báo cáo khác nhau mà không cần phải lập trình  </p>
                  </div><!-- end service_vertical_box -->
              </div><!-- end col-lg-4 -->
              <div class="col-sm-6">
                  <div class="service_vertical_box">
                      <div class="service-icon">
                          <i class="fa fa-tablet fa-4x"></i>
                      </div>
                      <h3>Tương thích các loại thiết bị</h3>
                      <p>MyERP có thể sử dụng với các trình duyệt trên desktop, laptop & thiết bị di động. </p>
                      <a href="#" class="readmore">Read More...</a>
                  </div><!-- end service_vertical_box -->
              </div><!-- end col-lg-4 -->
              <div class="col-sm-6">
                  <div class="service_vertical_box">
                      <div class="service-icon">
                          <i class="fa fa-crosshairs fa-4x"></i>
                      </div>
                      <h3>End to End System</h3>
                      <p>Có thể sử dụng như một hệ thống đơn chuỗi cung ứng, tài chính, tài liệu, nhân sự, sản xuất kinh doanh. </p>
                  </div><!-- end service_vertical_box -->
              </div><!-- end col-lg-4 -->
              <div class="col-sm-6">
                  <div class="service_vertical_box">
                      <div class="service-icon">
                          <i class="fa fa-users fa-4x"></i>
                      </div>
                      <h3>Quản trị nội dung </h3>
                      <p>Hệ thống quản trị nội dung được tích hợp với hệ thống ERP. Có thể sử dụng cho nhân viên, nhà cung cấp và khách hàng </p>
                      <!--<a href="#" class="readmore">Read More...</a>-->
                  </div><!-- end service_vertical_box -->
              </div><!-- end col-lg-4 -->
              <div class="col-sm-6">
                  <div class="service_vertical_box">
                      <div class="service-icon">
                          <i class="fa fa-bars fa-4x"></i>
                      </div>
                      <h3>Kiến trúc linh hoạt</h3>
                      <p>Tất cả forms, báo cáo & tài liệu đủ linh hoạt để đáp ứng các yêu cầu của doanh nghiệp. </p>
                      <!--<a href="#" class="readmore">Read More...</a>-->
                  </div><!-- end service_vertical_box -->
              </div><!-- end col-lg-4 -->
              <div class="clearfix"></div>
          </div><!-- end services_vertical -->
      </div><!-- end container -->
  </div><!-- end transparent-bg -->

  <div class="jt-shadow grey-wrapper first_content padding-top content_summary">
   <div class="make-center wow fadeInUp animated" style="visibility: visible;">
    <div class="container">
     <div id="structure">
<!--      <a class="list-header" href="http://localhost/inoerp/form.php?class_name=po_requisition_header&amp;mode=9">&nbsp;<i class="fa fa-dot-circle-o"></i> &nbsp; Requisition</a>
      <div id='form-modal'>
       Form Here
       <div id='mod-structure'> </div>
       <div id='mod-header_top_container'> </div>
      </div>-->

      <?php
      $content = new content();
      $subject_no_of_char = 50;
      $summary_no_of_char = 300;
      $fp_contnts = $content->frontPage_contents(200, 500);

      $pageno = !empty($_GET['pageno']) ? $_GET['pageno'] : 1;
      $per_page = !empty($_GET['per_page']) ? $_GET['per_page'] : 6;
      $total_count = count($fp_contnts);
      $pagination = new pagination($pageno, $per_page, $total_count);
      $pagination->setProperty('_path', 'index.php?');
      $position = ($pageno - 1) * $per_page;
      if (!empty($fp_contnts)) {
       $fp_contnts_ai = new ArrayIterator($fp_contnts);
       if ($position > 0) {
        $fp_contnts_ai->seek($position);
       }
       $cont_count = 1;
       while ($fp_contnts_ai->valid()) {
        $contnent = $fp_contnts_ai->current();
        if ($cont_count == 1 || $cont_count == 4) {
         $count_class_val = ' first ';
        } else if ($cont_count == 2 || $cont_count == 5) {
         $count_class_val = ' last ';
        } else {
         $count_class_val = '';
        }
        echo '<div class="col-lg-4 col-md-4' . $count_class_val . ' ">
              <div class="panel panel-success">
                <div class="panel-heading">';
        echo "<h3 class='panel-title'>";
        echo '<a href="' . HOME_URL . 'content.php?mode=2&'
        . 'content_id=' . $contnent->content_id . '&content_type_id=' . $contnent->content_type_id . '">';
        echo substr($contnent->subject, 0, $subject_no_of_char) . "</a></h3>";
        echo '</div>';
        echo "<div class='panel-body'>" . nl2br(html_entity_decode($contnent->content_summary, $summary_no_of_char)) . "</div>";
        echo '</div></div>';
        $cont_count++;
        $fp_contnts_ai->next();
        if ($fp_contnts_ai->key() == $position + $per_page) {
         $cont_count = 1;
         break;
        }
       }
      }
      ?>
     </div>

    </div>
   </div>
  </div>
  <div id="pagination1" style="clear: both;" class="pagination">
   <?php echo $pagination->show_pagination(); ?>
  </div>

  <div id="footer-style-1">
   <div class="container">
    <div id="footer_top"></div>
   </div>
  </div>
  <div id="copyrights">
   <div class="container">
    <div class="col-lg-5 col-md-6 col-sm-12">
     <div class="copyright-text">
      <p>
       <?php
       global $si;
       echo nl2br($si->footer_message);
       ?>
      </p>
     </div><!-- end copyright-text -->
    </div><!-- end widget -->
    <div class="col-lg-7 col-md-6 col-sm-12 clearfix">
     <div class="footer-menu">
      <ul class="menu">

       <li><a href="http://inoideas.org/content.php?mode=9&content_type=web_contact">Contact</a></li>
       <li><a href="https://github.com/inoerp/inoERP/releases">Releases</a></li>
       <li><a href="https://www.mozilla.org/MPL/2.0/">MPL 2</a></li>
       <li><a href="#">Cookie Preferences</a></li>
       <li class="active"><a href="#">Terms of Use</a></li>

      </ul>
     </div>
    </div><!-- end large-7 -->
   </div><!-- end container -->
  </div>
  <div class="dmtop"><?php echo gettext('Scroll to Top'); ?></div>

  <?php
  global $f;
  echo (!empty($footer_bottom)) ? "<div id=\"footer_bottom\"> $footer_bottom </div>" : "";
  echo $f->hidden_field_withId('home_url', HOME_URL);
  echo '<div class="hidden">' .$si->analytics_code .'</div>';
  ?>
  <script>
   $(document).ready(function () {
    dialog = $("#form-modal").dialog({
     autoOpen: false,
     height: 500,
     width: 900,
     modal: true,
     buttons: {
      Cancel: function () {
       dialog.dialog("close");
      }
     },
     close: function () {
      form[ 0 ].reset();
      allFields.removeClass("ui-state-error");
     }
    });
    $("#structure a.list-header").on("click", function (e) {
     e.preventDefault();
     var urlLink = $(this).attr('href');
     var urlLink_a = urlLink.split('?');
     var urlLink_firstPart_a = urlLink_a[0].split('/');
     var pageType = urlLink_firstPart_a.pop();
     if (pageType == 'form.php') {
      var formUrl = 'includes/json/json_form.php?' + urlLink_a[1];
     } else if (pageType == 'program.php') {
      var formUrl = 'includes/json/json_program.php?' + urlLink_a[1];
     } else {
      var formUrl = urlLink;
     }

     $.when(getModalFormDetails(formUrl)).then(
             dialog.dialog("open"));

    });
   });


   function getModalFormDetails(url) {
    return $.ajax({
     url: url,
     type: 'get',
     data: {
     },
     beforeSend: function () {
      $('#overlay').css('display', 'block');
     },
     complete: function () {

     }
    }).done(function (result) {
     var newContent = $(result).find('div#structure').html();
     var allButton = $(result).find('div#header_top_container #form_top_image').html();
     if (typeof allButton === 'undefined') {
      allButton = '';
     }
     var commentForm = $(result).find('div#comment_form').html();
     if (newContent) {
      $('#mod-structure').replaceWith('<div id="mod-structure">' + newContent + '</div>');
      $('#mod-header_top_container').replaceWith('<div id="mod-header_top_container"> <ul id="form_top_image" class="draggable">' + allButton + '</ul></div>');
      $('#display_comment_form').append(commentForm);
      if ($(result).find('div#document_history').html()) {
       $('#document_history').replaceWith('<div id="document_history">' + $(result).find('div#document_history').html() + '</div>');
      }
      var homeUrl = $('#home_url').val();

      $(result).find('#js_files').find('li').each(function () {
       $.getScript($(this).html());
      });
      $(result).find('ul#css_files').find('li').each(function () {
       var filePath = $(this).html();
       if (!$("link[href='" + filePath + "']").length) {
        $('<link href="' + filePath + '" rel="stylesheet">').appendTo("head");
       }
      });
      $.getScript(homeUrl + "includes/js/reload.js").done(function () {
       $('#overlay').css('display', 'none');
      });
     } else {
      $('#overlay').css('display', 'none');
     }

    }).fail(function () {
     alert("Form loading failed!");
     $('#overlay').css('display', 'none');
    });
   }


  </script>
 </body>
</html>
