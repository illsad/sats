<?php
if (isset($student)) {
  $NipValue = $student['student_nis'];
  $NameValue = $student['student_full_name'];
  $PhoneValue = $student['student_phone'];
} else {
  $NipValue = set_value('student_nis');
  $NameValue = set_value('student_full_name');
  $PhoneValue = set_value('student_phone');
}
?>
<div class="col-md-12 col-sm-12 col-xs-12">
  <div class="x_panel">
    <div class="x_title">
      <h2><i class="fa fa-list"></i> <?php echo $operation ?> Siswa</h2>
      <div class="clearfix"></div>
    </div>
    <div class="x_content">
      <!-- /.col-lg-12 -->
      <?php echo validation_errors(); ?>
      <?php echo form_open_multipart(current_url()); ?>
      <div class="col-sm-9 col-md-9">
        <?php if (isset($student)): ?>
          <input type="hidden" name="student_id" value="<?php echo $student['student_id']; ?>" />
        <?php endif; ?>
        <div class="form-group">
          <label >NIS *</label>
          <input name="student_nis" required="" placeholder="NIS" type="text" class="form-control" value="<?php echo $NipValue; ?>">
        </div>
        <div class="form-group">
          <label >Nama *</label>
          <input name="student_full_name" required="" placeholder="Nama" type="text" class="form-control" value="<?php echo $NameValue; ?>">
        </div>
        <div class="form-group">
          <label >No. Telepon</label>
          <input name="student_phone" required="" placeholder="Phone" type="number" class="form-control" value="<?php echo $PhoneValue; ?>">
        </div>
        <p class="text text-muted"><i>*) Field Wajib Diisi</i></p>
      </div>
      <div class="col-sm-9 col-md-3">
        <div class="form-group">
          <button type="submit" class="btn btn-success btn-form"><i class="fa fa-check"></i> Simpan</button>
          <a href="<?php echo site_url('class/students'); ?>" class="btn btn-info btn-form"><i class="fa fa-arrow-left"></i> Batal</a>
        </div>
      </div>
    </div>
    <?php echo form_close(); ?>
  </div>
</div>
