<div class="col-md-12 col-sm-12 col-xs-12 main post-inherit">
    <div class="x_panel post-inherit">
        <div class="row">
            <div class="col-md-8">
                <h3>
                    Detail Kelas
                </h3>
            </div>
            <div class="col-md-4">
                <span class=" pull-right">
                    <a href="<?php echo site_url('admin/classes') ?>" class="btn btn-info"><span class="fa fa-arrow-left"></span>&nbsp; Kembali</a> 
                    <a href="<?php echo site_url('admin/classes/edit/' . $class['class_id']) ?>" class="btn btn-success"><span class="fa fa-edit"></span>&nbsp; Edit</a> 
                </span>
            </div>
        </div><br>
        <div class="row">
            <div class="col-md-12">
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
                            <td>Penulis</td>
                            <td>:</td>
                            <td><?php echo $class['user_full_name']; ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>