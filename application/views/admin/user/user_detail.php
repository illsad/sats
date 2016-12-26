<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
        <div class="x_title">
            <h2><i class="fa fa-list"></i> Detail Pengguna</h2>
            <ul class="nav navbar-right panel_toolbox">
                <li><a class="btn btn-info" href="<?php echo site_url('admin/user') ?>"><i class="fa fa-arrow-left"></i>&nbsp; Kembali</a>
                </li>
                <li><a class="btn btn-success" href="<?php echo site_url('admin/user/edit/' . $user['user_id']) ?>"><i class="fa fa-edit"></i>&nbsp; Edit</a>
                </li>
                <li><?php if ($this->session->userdata('user_id') != $user['user_id']) { ?>
                  <a class="btn btn-primary btn-xs" href="<?php echo site_url('admin/user/rpw/' . $user['user_id']); ?>" ><i class="glyphicon glyphicon-lock"></i> Reset Password</a>
                  <?php } else {
                    ?>
                    <a class = "btn btn-primary btn-xs" href = "<?php echo site_url('admin/profile/cpw/'); ?>" ><i class = "glyphicon glyphicon-repeat"></i> Ubah Password</a>
                    <?php } ?>
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
                        <td>Nama Singkat</td>
                        <td>:</td>
                        <td><?php echo $user['user_name'] ?></td>
                    </tr>
                    <tr>
                        <td>Nama Lengkap</td>
                        <td>:</td>
                        <td><?php echo $user['user_full_name'] ?></td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td>:</td>
                        <td><?php echo $user['user_email'] ?></td>
                    </tr>
                    <tr>
                        <td>Tanggal Daftar</td>
                        <td>:</td>
                        <td><?php echo pretty_date($user['user_input_date'], 'l, d m Y', FALSE) ?></td>
                    </tr>
                    <tr>
                        <td>Jabatan</td>
                        <td>:</td>
                        <td><?php echo $user['role_name']; ?></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
