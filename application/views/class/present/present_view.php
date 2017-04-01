<div class="col-md-12 col-sm-12 col-xs-12">
  <div class="x_panel">
    <div class="x_title">
      <h2><i class="fa fa-list"></i> Detail Kehadiran</h2>
      <ul class="nav navbar-right panel_toolbox">
        <li><a class="btn btn-info" href="<?php echo site_url('class/present') ?>"><i class="fa fa-arrow-left"></i>&nbsp; Kembali</a>
        </li>
        <li><a class="btn btn-success" href="<?php echo site_url('class/present/edit/' . $present['present_id']) ?>"><i class="fa fa-edit"></i>&nbsp; Edit</a>
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
            <td>Tanggal</td>
            <td>:</td>
            <td><?php echo pretty_date($present['present_date'], 'Y') ?></td>
          </tr>
          <tr>
            <td>Nama Siswa</td>
            <td>:</td>
            <td><?php echo $present['student_full_name'] ?></td>
          </tr>
          <tr>
            <td>NIP</td>
            <td>:</td>
            <td><?php echo $present['student_nip'] ?></td>
          </tr>
          <tr>
            <td>Keterangan</td>
            <td>:</td>
            <td><?php echo $present['present_type']; ?></td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</div>
