<?php
if (isset($present)) {
  $DateValue = $present['present_date'];
  $TypeValue = $present['present_type'];
  $DescValue = $present['present_description'];
} else {
  $DateValue = set_value('present_date');
  $TypeValue = set_value('present_type');
  $DescValue = set_value('present_description');
}
?>
<div class="col-md-12 col-sm-12 col-xs-12">
  <div class="x_panel">
    <div class="x_title">
      <h2><i class="fa fa-list"></i> <?php echo $operation ?> Kehadiran</h2>
      <div class="clearfix"></div>
    </div>
    <div class="x_content">
      <!-- /.col-lg-12 -->
      <?php echo validation_errors(); ?>
      <?php echo form_open_multipart(current_url()); ?>
      <div class="col-sm-9 col-md-9">
        <?php if (isset($present)): ?>
          <input type="hidden" name="present_id" value="<?php echo $present['present_id']; ?>" />
        <?php endif; ?>
        <div class="form-group">
          <label >Keterangan </label>
          <div class="checkbox">
            <label>
            <input type="radio" name="present_type" class="flat" <?php echo $TypeValue == 'Hadir' ? 'checked' : '' ?> value="Hadir" > Hadir
            </label>
          </div>
          <div class="checkbox">
            <label>
            <input type="radio" name="present_type" class="flat" <?php echo $TypeValue == 'Izin' ? 'checked' : '' ?> value="Izin"> Izin
            </label>
          </div>
          <div class="checkbox">
            <label>
              <input type="radio" name="present_type" class="flat" <?php echo $TypeValue == 'Alfa' ? 'checked' : '' ?> value="Alfa"> Alfa
            </label>
          </div>
          <div class="checkbox">
            <label>
              <input type="radio" name="present_type" class="flat" <?php echo $TypeValue == 'Sakit' ? 'checked' : '' ?> value="Sakit"> Sakit
            </label>
          </div>
          <textarea name="present_description" class="form-control"><?php echo $DescValue ?></textarea>
        </div>
        <p class="text text-muted"><i>*) Field Wajib Diisi</i></p>
      </div>
      <div class="col-sm-9 col-md-3">
        <div class="form-group">
          <button type="submit" class="btn btn-success btn-form"><i class="fa fa-check"></i> Simpan</button>
          <a href="<?php echo site_url('admin/present'); ?>" class="btn btn-info btn-form"><i class="fa fa-arrow-left"></i> Batal</a>
          <?php if (isset($present)): ?>
            <button type="button" class="btn btn-danger btn-block" data-toggle="modal" data-target="#confirm-del"><i class="fa fa-trash"></i> Hapus</button>
          <?php endif; ?>
        </div>
      </div>
    </div>
    <?php echo form_close(); ?>
  </div>
</div>

<?php if (isset($present)): ?>
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
        <?php echo form_open('admin/present/delete/' . $present['present_id']); ?>
        <div class="modal-footer">
          <a><button style="float: right;margin-left: 10px" type="button" class="btn btn-default" data-dismiss="modal">Tidak</button></a>
          <input type="hidden" name="del_name" value="<?php echo $present['present_date'] ?>" />
          <button type="submit" class="btn btn-danger"> Ya</button>
        </div>
        <?php echo form_close(); ?>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->
<?php endif; ?>
