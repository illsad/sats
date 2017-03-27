<div class="row">
    <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="tile-stats">
            <div class="icon"><i class="fa fa-bank"></i>
            </div>
            <div class="count"><?php echo $class ?></div>

            <h3>Total Kelas</h3>
        </div>
    </div>
    <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="tile-stats">
            <div class="icon"><i class="fa fa-user"></i>
            </div>
            <div class="count"><?php echo $teachers ?></div>

            <h3>Total Guru</h3>
        </div>
    </div>
    <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="tile-stats">
            <div class="icon"><i class="fa fa-graduation-cap"></i>
            </div>
            <div class="count"><?php echo $students ?></div>

            <h3>Total Siswa</h3>
        </div>
    </div>
    <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="tile-stats">
            <div class="icon"><i class="fa fa-users"></i>
            </div>
            <div class="count"><?php echo $users ?></div>

            <h3>Total Admin</h3>
        </div>
    </div>
</div>
<?php 
$sx = 0;
$ix = 0;
$ax = 0;
foreach ($presentX as $row): 
    switch ($row['present_type']) {
        case 'Izin':
        $ix++;
        break;

        case 'Sakit':
        $sx++;
        break;

        case 'Alfa':
        $ax++;
        break;

        default:
        break;
    }
    endforeach;
    ?>

    <div class="row">
        <div class="col-md-4">
            <div class="x_panel">
                <div class="x_title">
                    <h2><i class="fa fa-bank"></i> Kelas X</h2>
                    <br>
                    <br>
                    <ul class="nav panel_toolbox">
                        <li><button class="btn btn-xs btn-success">IZIN: <?php echo $ix; ?></button>
                        </li>
                        <li><button class="btn btn-xs btn-warning">SAKIT: <?php echo $sx; ?></button>
                        </li>
                        <li><button class="btn btn-xs btn-danger">ALFA: <?php echo $ax; ?></button>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <div class="table-responsive">
                        <table class="table table-hover table-stripped">
                          <tbody>
                              <?php foreach ($presentX as $row): ?>
                                  <tr>
                                      <td><a href=""><?php echo $row['class_level'].' '.$row['class_name'] ?></a></td>
                                      <td><a href=""><?php echo $row['student_full_name'] ?></a></td>
                                      <td><span class="badge"><?php echo $row['present_type'] ?></span></td>
                                  </tr>
                              <?php endforeach ?>
                          </tbody>
                      </table>
                  </div>
              </div>
          </div>
      </div>

      <?php 
      $sxi = 0;
      $ixi = 0;
      $axi = 0;
      foreach ($presentXI as $row): 
        switch ($row['present_type']) {
            case 'Izin':
            $ixi++;
            break;

            case 'Sakit':
            $sxi++;
            break;

            case 'Alfa':
            $axi++;
            break;

            default:
            break;
        }
        endforeach;
        ?>
        <div class="col-md-4">
            <div class="x_panel">
                <div class="x_title">
                    <h2><i class="fa fa-bank"></i> Kelas XI</h2>
                    <br>
                    <br>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><button class="btn btn-xs btn-success">IZIN: <?php echo $ixi; ?></button>
                        </li>
                        <li><button class="btn btn-xs btn-warning">SAKIT: <?php echo $sxi; ?></button>
                        </li>
                        <li><button class="btn btn-xs btn-danger">ALFA: <?php echo $axi; ?></button>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <div class="table-responsive">
                        <table class="table table-hover table-stripped">
                          <tbody>
                              <?php foreach ($presentXI as $row): ?>
                                  <tr>
                                      <td><a href=""><?php echo $row['class_level'].' '.$row['class_name'] ?></a></td>
                                      <td><a href=""><?php echo $row['student_full_name'] ?></a></td>
                                      <td><span class="badge"><?php echo $row['present_type'] ?></span></td>
                                  </tr>
                              <?php endforeach ?>
                          </tbody>
                      </table>
                  </div>
              </div>
          </div>
      </div>

      <?php 
      $sxii = 0;
      $ixii = 0;
      $axii = 0;
      foreach ($presentXII as $row): 
        switch ($row['present_type']) {
            case 'Izin':
            $ixii++;
            break;

            case 'Sakit':
            $sxii++;
            break;

            case 'Alfa':
            $axii++;
            break;

            default:
            break;
        }
        endforeach;
        ?>
        <div class="col-md-4">
            <div class="x_panel">
                <div class="x_title">
                    <h2><i class="fa fa-bank"></i> Kelas XII</h2>
                    <br>
                    <br>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><button class="btn btn-xs btn-success">IZIN: <?php echo $ixii; ?></button>
                        </li>
                        <li><button class="btn btn-xs btn-warning">SAKIT: <?php echo $sxii; ?></button>
                        </li>
                        <li><button class="btn btn-xs btn-danger">ALFA: <?php echo $axii; ?></button>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <div class="table-responsive">
                        <table class="table table-hover table-stripped">
                          <tbody>
                              <?php foreach ($presentXII as $row): ?>
                                  <tr>
                                      <td><a href=""><?php echo $row['class_level'].' '.$row['class_name'] ?></a></td>
                                      <td><a href=""><?php echo $row['student_full_name'] ?></a></td>
                                      <td><span class="badge"><?php echo $row['present_type'] ?></span></td>
                                  </tr>
                              <?php endforeach ?>
                          </tbody>
                      </table>
                  </div>
              </div>
          </div>
      </div>
  </div>
