<!-- sidebar menu -->
<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">

  <div class="menu_section">
    <ul class="nav side-menu">
    <li class="list-side"><center><strong>SMK Wirabuana</strong></center></li><br>
    
      <li><a><i class="fa fa-home"></i> Home <span class="fa fa-chevron-down"></span></a>
        <ul class="nav child_menu" style="display: none">
          <li><a href="<?php echo site_url('admin') ?>">Dashboard</a>
          </li>
        </ul>
      </li>

      <li><a><i class="fa fa-calendar"></i> Kehadiran <span class="fa fa-chevron-down"></span></a>
        <ul class="nav child_menu" style="display: none">
          <li><a href="<?php echo site_url('admin/present') ?>">Daftar Kehadiran</a>
          </li>
        </ul>
      </li>

      <li><a><i class="fa fa-user"></i> Guru <span class="fa fa-chevron-down"></span></a>
        <ul class="nav child_menu" style="display: none">
          <li><a href="<?php echo site_url('admin/teachers') ?>">Daftar Guru</a>
          </li>
          <li><a href="<?php echo site_url('admin/teachers/import') ?>">Upload Guru</a>
          </li>
        </ul>
      </li>

      <li><a><i class="fa fa-institution"></i> Kelas <span class="fa fa-chevron-down"></span></a>
        <ul class="nav child_menu" style="display: none">
          <li><a href="<?php echo site_url('admin/classes') ?>">Daftar Kelas</a>
          </li>
        </ul>
      </li>

      <li><a><i class="fa fa-area-chart"></i> Laporan <span class="fa fa-chevron-down"></span></a>
        <ul class="nav child_menu" style="display: none">
          <li><a href="<?php echo site_url('admin/report') ?>">Daftar Laporan</a>
          </li>
        </ul>
      </li>

      <li><a><i class="fa fa-graduation-cap"></i> Siswa <span class="fa fa-chevron-down"></span></a>
        <ul class="nav child_menu" style="display: none">
          <li><a href="<?php echo site_url('admin/students') ?>">Daftar Siswa</a>
          </li>
          <li><a href="<?php echo site_url('admin/students/import') ?>">Upload Siswa</a>
          </li>
        </ul>
      </li>

      <li><a><i class="fa fa-users"></i> Pengguna <span class="fa fa-chevron-down"></span></a>
        <ul class="nav child_menu" style="display: none">
          <li><a href="<?php echo site_url('admin/user') ?>">Daftar Pengguna</a>
          </li>
        </ul>
      </li>
    </ul>
  </div>

</div>
<!-- /sidebar menu -->
