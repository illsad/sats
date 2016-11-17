<?php
if (isset($class)) {
    $NameValue = $class['class_name'];
    $LevelValue = $class['class_level'];
    $TeacherValue = $class['teacher_name'];
} else {
    $NameValue = set_value('class_name');
    $LevelValue = set_value('class_level');
    $TeacherValue = set_value('teacher_name');
}
?>
<div class="col-md-12 col-sm-12 col-xs-12 main post-inherit">
    <div class="x_panel post-inherit">
        <?php if (!isset($class)) echo validation_errors(); ?>
        <?php echo form_open_multipart(current_url()); ?>
        <div>
            <h3><?php echo $operation; ?> Kelas</h3><br>
        </div>

        <div class="row">
            <div class="col-sm-9 col-md-9">
                <?php if (isset($class)): ?>
                    <input type="hidden" name="class_id" value="<?php echo $class['class_id']; ?>" />
                <?php endif; ?>
                <div class="form-group">
                    <label >Jenjang *</label>
                    <select name="class_level" required="" class="form-control">
                        <option value="">- Pilih Jenjang -</option>
                        <option value="X" <?php echo $LevelValue == 'X' ? 'selected' : '' ?>>X</option>
                        <option value="XI" <?php echo $LevelValue == 'XI' ? 'selected' : '' ?>>XI</option>
                        <option value="XII" <?php echo $LevelValue == 'XII' ? 'selected' : '' ?>>XII</option>
                    </select>
                </div>
                <div class="form-group">
                    <label >Nama Kelas *</label>
                    <input name="class_name" required="" placeholder="Nama Kelas" type="text" class="form-control" value="<?php echo $NameValue; ?>">
                </div>
                <div class="form-group">
                    <label >Wali Kelas *</label>
                    <input name="teacher_name" required="" placeholder="Wali Kelas" type="text" class="form-control" value="<?php echo $TeacherValue; ?>">
                </div>
                <p class="text text-muted"><i>*) Field Wajib Diisi</i></p>
            </div>
            <div class="col-sm-9 col-md-3">
                <div class="form-group">
                    <button name="action" type="submit" value="save" class="btn btn-success btn-form"><i class="fa fa-check"></i> Simpan</button>
                    <a href="<?php echo site_url('admin/classes'); ?>" class="btn btn-info btn-form"><i class="fa fa-arrow-left"></i> Batal</a>
                    <?php if (isset($class)): ?>
                        <button type="button" class="btn btn-danger btn-block" data-toggle="modal" data-target="#confirm-del"><i class="fa fa-trash"></i> Hapus</button>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <?php echo form_close(); ?>
    </div>
</div>

<?php if (isset($class)): ?>
    <!-- Delete Confirmation -->
    <div class="modal fade" id="confirm-del">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title"><b><span class="fa fa-warning"></span> Konfirmasi Penghapusan</b></h4>
                </div>
                <div class="modal-body">
                    <p>Data yang dipilih akan dihapus oleh sistem, apakah anda yakin?;</p>
                </div>
                <?php echo form_open('admin/classes/delete/' . $class['class_id']); ?>
                <div class="modal-footer">
                    <a><button style="float: right;margin-left: 10px" type="button" class="btn btn-default" data-dismiss="modal">Tidak</button></a>
                    <input type="hidden" name="del_name" value="<?php echo $class['class_name'] ?>" />
                    <button type="submit" class="btn btn-danger"> Ya</button>
                </div>
                <?php echo form_close(); ?>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
<?php endif; ?>