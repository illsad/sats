<div class="col-md-12 col-sm-12 col-xs-12">
  <div class="x_panel">
    <div class="x_title">
      <h2><i class="fa fa-list"></i> Detail Kelas</h2>
      <ul class="nav navbar-right panel_toolbox">
        <li><a class="btn btn-info" href="<?php echo site_url('admin/classes') ?>"><i class="fa fa-arrow-left"></i>&nbsp; Kembali</a>
        </li>
        <li><a class="btn btn-success" href="<?php echo site_url('admin/classes/edit/' . $class['class_id']) ?>"><i class="fa fa-edit"></i>&nbsp; Edit</a>
        </li>
        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
        </li>
      </ul>
      <div class="clearfix"></div>
    </div>
    <div class="x_content">
      <table class="table table-striped">
        <tbody>
          <tr>
            <td>Kelas</td>
            <td>:</td>
            <td><?php echo $class['class_level'] . ' ' . $class['class_name'] ?></td>
          </tr>
          <tr>
            <td>Wali Kelas</td>
            <td>:</td>
            <td><?php echo $class['teacher_name'] ?></td>
          </tr>
          <tr>
            <td>Tahun</td>
            <td>:</td>
            <td><?php echo $class['class_years'] ?></td>
          </tr>
          <tr>
            <td>Username</td>
            <td>:</td>
            <td><?php echo $class['username'] ?></td>
          </tr>
          <tr>
            <td>Penulis</td>
            <td>:</td>
            <td><?php echo $class['user_full_name']; ?></td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>

  <div class="x_panel">
    <div class="x_title">
      <h2><i class="fa fa-users"></i> Daftar Siswa</h2>
      <ul class="nav navbar-right panel_toolbox">
        <li><button class="btn btn-success" type="button" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus"></i>&nbsp; Tambah</button>
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
              <th class="controls" align="center">NAMA SISWA</th>
              <th class="controls" align="center">NIP SISWA</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($students as $student): ?>
              <tr>
                <td>
                  <?php echo $student['student_full_name'] ?>
                </td>
                <td>
                  <?php echo $student['student_nip'] ?>
                </td>
              </tr>
            <?php endforeach ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <div class="modal fade" id="myModal">
    <div class="modal-dialog">
      <?php echo form_open('admin/classes/addStudent/' . $class['class_id']); ?>
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title"><b><span class="fa fa-users"></span> Tambah Siswa</b></h4>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label >NIP *</label>
            <input name="student_nip" required="" placeholder="NIP" type="text" class="form-control">
          </div>
          <div class="form-group">
            <label >Nama *</label>
            <input name="student_full_name" required="" placeholder="Nama" type="text" class="form-control">
          </div>
          <div class="form-group">
            <label >No. Telepon</label>
            <input name="student_phone" required="" placeholder="Phone" type="number" class="form-control">
          </div>
          <p class="text text-muted"><i>*) Field Wajib Diisi</i></p>
        </div>

        <div class="modal-footer">
          <a><button style="float: right;margin-left: 10px" type="button" class="btn btn-default" data-dismiss="modal">Batal</button></a>

          <button type="submit" class="btn btn-success"> Submit</button>
        </div>
        <?php echo form_close(); ?>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->
