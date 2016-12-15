<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
        <div class="x_title">
        <h2><i class="fa fa-book"></i> Detail Pengguna</h2>
            <ul class="nav navbar-right panel_toolbox">
                <li><a href="<?php echo site_url('admin/user') ?>" class="btn btn-info btn-sm"><span class="fa fa-arrow-left"></span>&nbsp; Kembali</a>
                </li>
                <li><a href="<?php echo site_url('admin/user/edit/' . $user['user_id']) ?>" class="btn btn-success btn-sm"><span class="fa fa-edit"></span>&nbsp; Edit</a>
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
