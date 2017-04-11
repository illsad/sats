<div class="col-md-12 col-sm-12 col-xs-12">
  <div class="x_panel">
    <div class="x_title">
      <h2><i class="fa fa-list"></i> Detail Siswa</h2>
      <ul class="nav navbar-right panel_toolbox">
        <li><a class="btn btn-info" href="<?php echo site_url('class/students') ?>"><i class="fa fa-arrow-left"></i>&nbsp; Kembali</a>
        </li>
        <li><a class="btn btn-success" href="<?php echo site_url('class/students/edit/' . $student['student_id']) ?>"><i class="fa fa-edit"></i>&nbsp; Edit</a>
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
            <td><?php echo $student['class_level'].' '.$student['class_name']; ?></td>
          </tr>
          <tr>
            <td>NIS Siswa</td>
            <td>:</td>
            <td><?php echo $student['student_nis'] ?></td>
          </tr>
          <tr>
            <td>Nama Siswa</td>
            <td>:</td>
            <td><?php echo $student['student_full_name'] ?></td>
          </tr>
          <tr>
            <td>No. Telepon</td>
            <td>:</td>
            <td>0<?php echo $student['student_phone'] ?></td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</div>
