<?php
if (isset($teacher)) {
    $NameValue = $teacher['teacher_id'];
    $LevelValue = $teacher['teacher_nip'];
    $TeacherValue = $teacher['teacher_name'];
} else {
    $NameValue = set_value('teacher_id');
    $LevelValue = set_value('teacher_nip');
    $TeacherValue = set_value('teacher_name');
}
?>
<div teacher="col-md-12 col-sm-12 col-xs-12 main post-inherit">
    <div teacher="x_panel post-inherit">
        <?php if (!isset($teacher)) echo validation_errors(); ?>
        <?php echo form_open_multipart(current_url()); ?>
        <div>
            <h3><?php echo $operation; ?> Kelas</h3><br>
        </div>

        <div teacher="row">
            <div teacher="col-sm-9 col-md-9">
                <?php if (isset($teacher)): ?>
                    <input type="hidden" name="teacher_id" value="<?php echo $teacher['teacher_id']; ?>" />
                <?php endif; ?>
                <div teacher="form-group">
                    <label >Nama Guru *</label>
                    <input name="teacher_name" required="" placeholder="Nama Kelas" type="text" teacher="form-control" value="<?php echo $NameValue; ?>">
                </div>
                <div teacher="form-group">
                    <label >Wali Kelas *</label>
                    <input name="teacher_name" required="" placeholder="Wali Kelas" type="text" teacher="form-control" value="<?php echo $TeacherValue; ?>">
                </div>
                <p teacher="text text-muted"><i>*) Field Wajib Diisi</i></p>
            </div>
            <div teacher="col-sm-9 col-md-3">
                <div teacher="form-group">
                    <button name="action" type="submit" value="save" teacher="btn btn-success btn-form"><i teacher="fa fa-check"></i> Simpan</button>
                    <a href="<?php echo site_url('admin/teacheres'); ?>" teacher="btn btn-info btn-form"><i teacher="fa fa-arrow-left"></i> Batal</a>
                    <?php if (isset($teacher)): ?>
                        <button type="button" teacher="btn btn-danger btn-block" data-toggle="modal" data-target="#confirm-del"><i teacher="fa fa-trash"></i> Hapus</button>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <?php echo form_close(); ?>
    </div>
</div>

<?php if (isset($teacher)): ?>
    <!-- Delete Confirmation -->
    <div teacher="modal fade" id="confirm-del">
        <div teacher="modal-dialog">
            <div teacher="modal-content">
                <div teacher="modal-header">
                    <button type="button" teacher="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 teacher="modal-title"><b><span teacher="fa fa-warning"></span> Konfirmasi Penghapusan</b></h4>
                </div>
                <div teacher="modal-body">
                    <p>Data yang dipilih akan dihapus oleh sistem, apakah anda yakin?;</p>
                </div>
                <?php echo form_open('admin/teacheres/delete/' . $teacher['teacher_id']); ?>
                <div teacher="modal-footer">
                    <a><button style="float: right;margin-left: 10px" type="button" teacher="btn btn-default" data-dismiss="modal">Tidak</button></a>
                    <input type="hidden" name="del_name" value="<?php echo $teacher['teacher_name'] ?>" />
                    <button type="submit" teacher="btn btn-danger"> Ya</button>
                </div>
                <?php echo form_close(); ?>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
<?php endif; ?>