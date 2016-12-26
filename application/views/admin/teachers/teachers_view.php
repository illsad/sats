<div class="col-md-12 col-sm-12 col-xs-12">
  <div class="x_panel">
    <div class="x_title">
      <h2><i class="fa fa-list"></i> Detail Guru</h2>
      <ul class="nav navbar-right panel_toolbox">
        <li><a class="btn btn-info" href="<?php echo site_url('admin/teachers') ?>"><i class="fa fa-arrow-left"></i>&nbsp; Kembali</a>
        </li>
        <li><a class="btn btn-success" href="<?php echo site_url('admin/teachers/edit/' . $teacher['teacher_id']) ?>"><i class="fa fa-edit"></i>&nbsp; Edit</a>
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
            <td>NIP Guru</td>
            <td>:</td>
            <td><?php echo $teacher['teacher_nip'] ?></td>
          </tr>
          <tr>
            <td>Nama Guru</td>
            <td>:</td>
            <td><?php echo $teacher['teacher_name'] ?></td>
          </tr>
          <tr>
            <td>Penulis</td>
            <td>:</td>
            <td><?php echo $teacher['user_full_name']; ?></td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</div>
