  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2><i class="fa fa-book"></i> Daftar Kelas</h2>
        <ul class="nav navbar-right panel_toolbox">
          <li><a class="btn btn-success" href="<?php echo site_url('admin/class/add'); ?>"><i class="fa fa-plus"></i> Tambah</a>
          </li>
          <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
          </li>
        </ul>
        <div class="clearfix"></div>
      </div>

      <div class="x_content">
        <div class="table-responsive">
          <table class="table table-striped">
            <thead>
              <tr>
                <th class="controls" align="center">KELAS</th>
                <th class="controls" align="center">WALI KELAS</th>
                <th class="controls" align="center">TAHUN</th>
                <th class="controls" align="center">AKSI</th>
              </tr>
            </thead>
            <?php
            if (!empty($classes)) {
              foreach ($classes as $row) {
                ?>
                <tbody>
                  <tr>
                    <td ><?php echo $row['class_level'].' '.$row['class_name']; ?></td>
                    <td ><?php echo $row['teacher_name']; ?></td>
                    <td ><?php echo $row['class_years']; ?></td>
                    <td>
                      <a class="btn btn-warning btn-xs" href="<?php echo site_url('admin/classes/detail/' . $row['class_id']); ?>" ><span class="glyphicon glyphicon-eye-open"></span></a>
                      <a class="btn btn-success btn-xs" href="<?php echo site_url('admin/classes/edit/' . $row['class_id']); ?>" ><span class="glyphicon glyphicon-edit"></span></a>
                    </td>
                  </tr>
                </tbody>
                <?php
              }
            } else {
              ?>
              <tbody>
                <tr id="row">
                  <td colspan="4" align="center">Data Kosong</td>
                </tr>
              </tbody>
              <?php
            }
            ?>
          </table>
        </div>
        <div >
          <?php echo $this->pagination->create_links(); ?>
        </div>
      </div>
    </div>
  </div>
