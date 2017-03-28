<!DOCTYPE html>
<html lang="en">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <!-- Meta, title, CSS, favicons, etc. -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>SATS WIRABUANA <?php echo isset($title) ? ' | ' . $title : null; ?></title>
  <link rel="icon" href="<?php echo media_url('images/logo.png'); ?>" type="image/x-icon">

  <!-- Bootstrap core CSS -->

  <link href="<?php echo media_url() ?>/css/bootstrap.min.css" rel="stylesheet">
  <link href="<?php echo media_url() ?>/css/dataTables.bootstrap.css" rel="stylesheet">
  <link href="<?php echo media_url() ?>/css/jquery-ui.min.css" rel="stylesheet">
  <link href="<?php echo media_url() ?>/css/jquery-ui.structure.min.css" rel="stylesheet">
  <link href="<?php echo media_url() ?>/css/jquery-ui.theme.min.css" rel="stylesheet">

  <link href="<?php echo media_url() ?>/fonts/css/font-awesome.min.css" rel="stylesheet">
  <link href="<?php echo media_url() ?>/css/animate.min.css" rel="stylesheet">
  <link href="<?php echo media_url() ?>/css/select2.min.css" rel="stylesheet">
  <!-- Notyfy JS - Notification -->
  <link rel="stylesheet" href="<?php echo media_url() ?>/css/jquery.notyfy.css">

  <!-- Custom styling plus plugins -->
  <link href="<?php echo media_url() ?>/css/custom.css" rel="stylesheet">

  <script src="<?php echo media_url() ?>/js/jquery-2.2.3.min.js"></script>
  <script src="<?php echo media_url() ?>/js/bootstrap.min.js"></script>
  <script src="<?php echo media_url() ?>/js/jquery.dataTables.min.js"></script>
  <script src="<?php echo media_url() ?>/js/dataTables.bootstrap.min.js"></script>
  <script src="<?php echo media_url() ?>/js/jquery-ui.min.js"></script>
  <script src="<?php echo media_url(); ?>/js/mm.js"></script>
  <!-- Notyfy JS -->
  <script src="<?php echo media_url() ?>/js/jquery.notyfy.js"></script>
  <!-- Angular JS-->
  <script src="<?php echo media_url() ?>/js/angular.min.js"></script>

  <!--[if lt IE 9]>
  <script src="../assets/js/ie8-responsive-file-warning.js"></script>
  <![endif]-->

  <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
  <script type="text/javascript">
    var BASEURL = '<?php echo base_url() ?>';
  </script>

</head>

<body class="nav-md" <?php echo isset($ngapp) ? $ngapp : null; ?>>
  <div class="container body">
    <div class="main_container">
      <div class="col-md-3 left_col">
        <div class="left_col scroll-view">

          <div class="navbar nav_title" style="border: 0;">
            <a href="<?php echo site_url ('index.php')?>" class="site_title"><i class="fa fa-book"></i> <span>WIRABUANA</span></a>
          </div>
          <div class="clearfix"></div>
          <br />

          <?php $this->load->view('class/sidebar') ?>
        </div>
      </div>

      <!-- top navigation -->
      <div class="top_nav">
        <div class="nav_menu">
          <nav class="" role="navigation">
            <div class="nav toggle">
              <a id="menu_toggle"><i class="fa fa-bars"></i></a>
            </div>

            <ul class="nav navbar-nav navbar-right">

              <li class="">
                <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                  <img src="<?php echo media_url() ?>/images/user.png" alt=""><?php echo $text = $this->session->userdata('class_level'). ' '.ucfirst($this->session->userdata('class_name')); ?>
                  <span class=" fa fa-angle-down"></span>
                </a>
                <ul class="dropdown-menu dropdown-usermenu animated fadeInDown pull-right">
                  <li><a href="<?php echo site_url('class/dashboard') ?>">  Home</a>
                  </li>
                  <li>
                    <center>
                      <?php echo form_open(site_url('class/auth/logout')) ?>
                      <input type="hidden" name="location" value="<?php echo htmlspecialchars($_SERVER['REQUEST_URI']) ?>">
                      <button class="btn btn-xs btn-danger" id="btn-lgout" type="submit">
                        <i class="fa fa-sign-out pull-right"></i> Log out
                      </button>
                      <?php echo form_close() ?>
                    </center>
                  </li>
                </ul>
              </li>

              <li class="">
               <h2 id="date-time"></h2>
              </li>


            </ul>
          </nav>
        </div>

      </div>
      <!-- /top navigation -->

      <!-- page content -->
      <div class="right_col" role="main">
        <div class="row">

          <?php isset($main) ? $this->load->view($main) : null; ?>

        </div>
        <!-- footer content -->
        <footer>
          <div class="">
            <p class="pull-right">© 2016 |
              <span class="lead"> <i class="fa fa-graduate-cap"></i> SMK WIRABUANA</span>
            </p>
          </div>
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->

      </div>
    </div>

    <div id="custom_notifications" class="custom-notifications dsp_none">
      <ul class="list-unstyled notifications clearfix" data-tabbed_notifications="notif-group">
      </ul>
      <div class="clearfix"></div>
      <div id="notif-group" class="tabbed_notifications"></div>
    </div>

    <script src="<?php echo media_url() ?>/js/custom.js"></script>
    <script src="<?php echo media_url() ?>/js/jquery.nicescroll.min.js"></script>

    <!-- dataTable -->
    <script>
          //Initiation dataTable
          $(function () {
            $('.table-init').DataTable({
              "renderer":  { "header": "bootstrap" },
              "processing": true,
              "serverSide": true,
              "aaSorting": [],
              "ajax": {
                "url": "<?php echo current_url().'/ajax_list' ?>",
                "type": "POST"
              },
              "oLanguage": {
                "sSearch": "Pencarian :"
              },
              "aoColumnDefs": [
              {
                'bSortable': false,
                'aTargets': [-1]
                } //disables sorting for last column
                ],
                "sPaginationType": "full_numbers",
              });
          });
        </script>

        <!-- select2 -->
        <script src="<?php echo media_url() ?>/js/select2.full.js"></script>
        <!-- select2 -->
        <script>
          $(document).ready(function () {
            $(".select2_single").select2({
              placeholder: "Select a state",
              allowClear: true
            });
          });
        </script>

        <?php if ($this->session->flashdata('success')) { ?>
        <script>
          $(function () {
            notyfy({
              layout: 'top',
              type: 'success',
              showEffect: function (bar) {
                bar.animate({height: 'toggle'}, 500, 'swing');
              },
              hideEffect: function (bar) {
                bar.animate({height: 'toggle'}, 500, 'swing');
              },
              timeout: 3000,
              text: '<?php echo $this->session->flashdata('success') ?>'
            });
          });

          

            function updatingClock(selector, type) {
    function currentDate() {
        var currentDate = new Date;
        var Day = currentDate.getDate();
        if (Day < 10) {
            Day = '0' + Day;
        } //end if
        var Month = currentDate.getMonth() + 1;
        if (Month < 10) {
            Month = '0' + Month;
        } //end if
        var Year = currentDate.getFullYear();
        var fullDate = Month + '/' + Day + '/' + Year;
        return fullDate;
    } //end current date function

    function currentTime() {
        var currentTime = new Date;
        var Minutes = currentTime.getMinutes();
        if (Minutes < 10) {
            Minutes = '0' + Minutes;
        }
        var Hour = currentTime.getHours();
        if (Hour > 12) {
            Hour -= 12;
        } //end if
        var Time = Hour + ':' + Minutes;
        if (currentTime.getHours() <= 12) {
            Time += ' AM';
        } //end if
        if (currentTime.getHours() > 12) {
            Time += ' PM';
        } //end if
        return Time;
    } // end current time function


    function updateOutput() {
        var output;
        if (type == 'time') {
            output = currentTime();
            if ($(selector).text() != output) {
                $(selector).text(output);
            } //end if
        } //end if
        if (type == 'date') {
            output = currentDate();
            if ($(selector).text() != output) {
                $(selector).text(output);
            } //end if
        } //end if
        if (type == 'both') {
            output = currentDate() + ' at ' + currentTime();
            if ($(selector).text() != output) {
                $(selector).text(output);
            } //end if
        } //end if
    }//end update output function
    updateOutput();
    window.setInterval(function() {
        updateOutput();
    }, 1000); //run update every 1 second
} // end updating clock function
updatingClock('#date-time', 'both');
        </script>
        <?php } ?>
      </body>

      </html>
