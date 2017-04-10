<?php
$this->load->view('admin/datepicker');
if (isset($teacher)) {
  $NikValue = $teacher['teacher_nik'];
  $NameValue = $teacher['teacher_name'];
  $AddressValue = $teacher['teacher_address'];
  $NuptkValue = $teacher['teacher_nuptk'];
  $GenderValue = $teacher['teacher_gender'];
  $ReligonValue = $teacher['teacher_religion'];
  $PhoneValue = $teacher['teacher_phone'];
  $PobValue = $teacher['teacher_pob'];
  $DobValue = $teacher['teacher_dob'];
} else {
  $NikValue = set_value('teacher_nik');
  $NameValue = set_value('teacher_name');
  $AddressValue = set_value('teacher_address');
  $NuptkValue = set_value('teacher_nuptk');
  $GenderValue = set_value('teacher_gender');
  $ReligonValue = set_value('teacher_religion');
  $PhoneValue = set_value('teacher_phone');
  $PobValue = set_value('teacher_pob');
  $DobValue = set_value('teacher_dob');
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
          <label >NIK *</label>
          <input name="teacher_nik" placeholder="NIK" type="text" class="form-control" value="<?php echo $NikValue; ?>">
        </div>
        <div class="form-group">
          <label >NUPTK </label>
          <input name="teacher_nuptk" placeholder="NUPTK" type="text" class="form-control" value="<?php echo $NuptkValue; ?>">
        </div>
        <div class="form-group">
          <label >Nama *</label>
          <input name="teacher_name" required="" placeholder="Nama" type="text" class="form-control" value="<?php echo $NameValue; ?>">
        </div>
        <div class="form-group">
          <label >Alamat  </label>
          <input name="teacher_address" placeholder="Alamat" type="text" class="form-control" value="<?php echo $AddressValue; ?>">
        </div>
        <div class="row">
          <div class="col-md-4 col-xs-12">
            <label >Tempat Lahir *</label>
            <input name="teacher_pob" required="" placeholder="Tempat Lahir" type="text" class="form-control" value="<?php echo $PobValue; ?>">
          </div>
          <div class="col-md-4 col-xs-12">
            <label >Tanggal Lahir *</label>
            <input name="teacher_dob" required="" placeholder="Tanggal Lahir" type="text" class="datepicker form-control f_mr_top" value="<?php echo $DobValue; ?>">
          </div>
          <div class="col-md-4 col-xs-12">
            <label >Gender</label>
            <div class="radio">
              <label class="radio-inline">
                <input type="radio" name="teacher_gender" value="L" <?php echo ($GenderValue == 'L') ? 'checked' : '' ?>> Laki-laki
              </label>
              <label class="radio-inline">
                <input type="radio" name="teacher_gender" value="P" <?php echo ($GenderValue == 'P') ? 'checked' : '' ?>> Perempuan
              </label>
            </div>
          </div>
        </div>
        <div class="form-group">
          <label >Agama *</label>
          <select name="teacher_religion" class="form-control">
            <option value="">- Pilih Agama -</option>
            <option value="Islam" <?php echo ($ReligonValue == 'Islam') ? 'selected' : '' ?>>Islam</option>
            <option value="Kristen" <?php echo ($ReligonValue == 'Kristen') ? 'selected' : '' ?>>Kristen</option>
            <option value="Katolik" <?php echo ($ReligonValue == 'Katolik') ? 'selected' : '' ?>>Katolik</option>
            <option value="Hindu" <?php echo ($ReligonValue == 'Hindu') ? 'selected' : '' ?>>Hindu</option>
            <option value="Budha" <?php echo ($ReligonValue == 'Budha') ? 'selected' : '' ?>>Budha</option>
            <option value="Kongucu" <?php echo ($ReligonValue == 'Kongucu') ? 'selected' : '' ?>>Konghucu</option>
          </select>
        </div>
        <div calss="form-group">
         <label>Telephone </label>
         <input name="teacher_phone" placeholder="Telephone" type="text" class="form-control" value="<?php echo $PhoneValue; ?>">
       </div>
     </div>
     <div class="form-group">
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
