<?php
if (isset($teacher)) {
  $NipValue = $teacher['teacher_nip'];
  $NameValue = $teacher['teacher_name'];
} else {
  $NipValue = set_value('teacher_nip');
  $NameValue = set_value('teacher_name');
}
?>
<div class="col-md-12 col-sm-12 col-xs-12">
  <div class="x_panel">
    <div class="x_title">
      <h2><i class="fa fa-list"></i> <?php echo $operation ?> Guru</h2>
      <div class="clearfix"></div>
    </div>
    <div class="x_content">
      <!-- /.col-lg-12 -->
      <?php echo validation_errors(); ?>
      <?php echo form_open_multipart(current_url()); ?>
      <div class="col-sm-9 col-md-9">
        <?php if (isset($teacher)): ?>
          <input type="hidden" name="teacher_id" value="<?php echo $teacher['teacher_id']; ?>" />
        <?php endif; ?>
        <div class="form-group">
          <label >NIP *</label>
          <input name="teacher_nip" required="" placeholder="NIP" type="text" class="form-control" value="<?php echo $NipValue; ?>">
        </div>
        <div class="form-group">
          <label >Nama *</label>
          <input name="teacher_name" required="" placeholder="Nama" type="text" class="form-control" value="<?php echo $NameValue; ?>">
        </div>
        <p class="text text-muted"><i>*) Field Wajib Diisi</i></p>
      </div>
      <div class="col-sm-9 col-md-3">
        <div class="form-group">
          <button type="submit" class="btn btn-success btn-form"><i class="fa fa-check"></i> Simpan</button>
          <a href="<?php echo site_url('admin/teachers'); ?>" class="btn btn-info btn-form"><i class="fa fa-arrow-left"></i> Batal</a>
          <?php if (isset($teacher)): ?>
            <button type="button" class="btn btn-danger btn-block" data-toggle="modal" data-target="#confirm-del"><i class="fa fa-trash"></i> Hapus</button>
          <?php endif; ?>
        </div>
      </div>
    </div>
    <?php echo form_close(); ?>
  </div>
</div>

<?php if (isset($teacher)): ?>
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
        <?php echo form_open('admin/teachers/delete/' . $teacher['teacher_id']); ?>
        <div class="modal-footer">
          <a><button style="float: right;margin-left: 10px" type="button" class="btn btn-default" data-dismiss="modal">Tidak</button></a>
          <input type="hidden" name="del_name" value="<?php echo $teacher['teacher_name'] ?>" />
          <button type="submit" class="btn btn-danger"> Ya</button>
        </div>
        <?php echo form_close(); ?>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->
<?php endif; ?>
