<div class="col-md-12 col-sm-12 col-xs-12 main post-inherit">
    <div class="x_panel post-inherit">
        <h3>
            Daftar Kelas
            <a href="<?php echo site_url('admin/classes/add'); ?>" ><span class="glyphicon glyphicon-plus-sign"></span></a>
        </h3>

        <!-- Indicates a successful or positive action -->

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