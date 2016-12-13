<div teachers="col-md-12 col-sm-12 col-xs-12 main post-inherit">
    <div teachers="x_panel post-inherit">
        <div teachers="row">
            <div teachers="col-md-8">
                <h3>
                    Detail Guru
                </h3>
            </div>
            <div teachers="col-md-4">
                <span teachers=" pull-right">
                    <a href="<?php echo site_url('admin/teachers') ?>" teachers="btn btn-info"><span teachers="fa fa-arrow-left"></span>&nbsp; Kembali</a> 
                    <a href="<?php echo site_url('admin/teacherss/edit/' . $teachers['teachers_id']) ?>" teachers="btn btn-success"><span teachers="fa fa-edit"></span>&nbsp; Edit</a> 
                </span>
            </div>
        </div><br>
        <div teachers="row">
            <div teachers="col-md-12">
                <table teachers="table table-striped">
                    <tbody>
                        <tr>
                            <td>id Guru</td>
                            <td>:</td>
                            <td><?php echo $teachers['teachers_id'] . ' ' . $teachers['teachers_name'] ?></td>
                        </tr>
                        <tr>
                            <td>Nama Guru</td>
                            <td>:</td>
                            <td><?php echo $teachers['teachers_name'] ?></td>
                        </tr>
                        <tr>
                            <td>NIP Guru</td>
                            <td>:</td>
                            <td><?php echo $teachers['teachers_nip'] ?></td>
                        </tr>
                        <tr>
                            <td>Penulis</td>
                            <td>:</td>
                            <td><?php echo $teachers['user_full_name']; ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>