<div class="content-wrapper">
    <!-- Content Header (Page header) -->

    <!-- Main content -->
    <section class="content">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-md-12">
                <div class="box-body">
                       <h1><i class="fa fa-file-excel-o text-green"></i> Upload Data Guru</h1>

                       <body><br>
                        <h4>Petunjuk Singkat</h4>
                        <p>Penginputan data Guru bisa dilakukan dengan mengcopy data dari file Ms. Excel. Format file excel harus sesuai kebutuhan aplikasi. Silahkan download formatnya <a href="<?=site_url('admin/teachers/download');?>"><span class="label label-success">Disini</span></a>
                            <br><br>
                            <strong>CATATAN :</strong>
                            <ol>
                                <li>Pengisian jenis data <strong>TANGGAL</strong>  diisi dengan format <strong>YYYY-MM-DD</strong> Contoh <strong>2017-12-21</strong><br> Cara ubah : blok semua tanggal pilih format cell di excel ganti dengan format date pilih yang tahunnya di depan</li>  
                            </ol>
                        </p>
                    </div>
                    <br>
                    <div class="form-body">
                        <?php echo form_open_multipart(current_url()) ?>
                        <div class="form-body">
                            <div class="form-group">
                                <div class="col-md-12">
                                    <textarea placeholder="Copy data yang akan dimasukan dari file excel, dan paste disini" rows="10" class="form-control" name="rows"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-success btn-sm btn-flat"><i class="fa fa-save"></i> Import</button>
                                <a href="<?=site_url('teachers');?>" class="btn btn-default btn-sm btn-flat"><i class="fa fa-angle-double-left"></i> KEMBALI</a>
                            </div>
                        </div>
                    </div>
                    <?php echo form_close() ?>
                </div>

                    </section>
                    <!-- /.content -->
                </div>