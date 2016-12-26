<div class="col-md-12 col-sm-12 col-xs-12">
  <div class="x_panel">
    <div class="x_title">
      <h2><i class="fa fa-list"></i> Daftar Pengguna</h2>
      <ul class="nav navbar-right panel_toolbox">
        <li><a class="btn btn-success" href="<?php echo site_url('admin/user/add'); ?>"><i class="fa fa-plus"></i> Tambah</a>
        </li>
        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
        </li>
      </ul>
      <div class="clearfix"></div>
    </div>

    <div class="x_content">
      <div class="table-responsive">
        <table class="table table-striped table-init">
          <thead>
            <tr>
              <th>Nama Singkat</th>
              <th>Nama Lengkap</th>
              <th>Email</th>
              <th>Status</th>
              <th>Aksi</th>
            </tr>
          </thead>
        </table>
      </div>
    </div>
    <div>
      <?php echo $this->pagination->create_links(); ?>
    </div>
  </div>
</div>
