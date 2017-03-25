<?php

if (!defined('BASEPATH'))
  exit('No direct script access allowed');


class Classes extends CI_Controller {

  public function __construct() {
    parent::__construct(TRUE);
    if ($this->session->userdata('logged') == NULL) {
      header("Location:" . site_url('admin/auth/login') . "?location=" . urlencode($_SERVER['REQUEST_URI']));
    }
    $this->load->model(array('Classes_model', 'Activity_log_model'));
    $this->load->library('upload');
  }

  // Classes view in list
  public function index($offset = NULL) {
    $this->load->library('pagination');
    $data['classes'] = $this->Classes_model->get(array('limit' => 10, 'offset' => $offset));
    $config['base_url'] = site_url('admin/classes/index');
    $config['total_rows'] = count($this->Classes_model->get());
    $this->pagination->initialize($config);

    $data['title'] = 'Kelas';
    $data['main'] = 'admin/classes/classes_list';
    $this->load->view('admin/layout', $data);
  }

  function detail($id = NULL) {
    $this->load->model('Students_model');
    $this->load->model('Present_model');
    if ($this->Classes_model->get(array('id' => $id)) == NULL) {
      redirect('admin/classes');
    }
    
    $params['class'] = $id;
    $params['date_start'] = date('Y-m-d',strtotime("-30 days"));
    $params['date_end'] = date('Y-m-d');
    $data['reports'] = $this->Present_model->get($params);
    $data['ngapp'] = 'ng-app="satsApp"';
    $data['class'] = $this->Classes_model->get(array('id' => $id));
    $data['students'] = $this->Students_model->get(array('class' => $id));
    $data['title'] = 'Detail Kelas';
    $data['main'] = 'admin/classes/classes_view';
    $this->load->view('admin/layout', $data);
  }

  // Add Classes and Update
  public function add($id = NULL) {
    $this->load->model('Teachers_model');
    $this->load->library('form_validation');
    if (!$this->input->post('class_id')) {
      $this->form_validation->set_rules('password', 'password', 'trim|required|xss_clean|min_length[6]');
      $this->form_validation->set_rules('passconf', 'Konfirmasi Password', 'trim|required|xss_clean|min_length[6]|matches[password]');
    }
    $this->form_validation->set_rules('class_name', 'Nama', 'trim|required|xss_clean');
    $this->form_validation->set_rules('class_level', 'Jenjang', 'trim|required|xss_clean');
    $this->form_validation->set_rules('teacher_id', 'Wali Kelas', 'trim|required|xss_clean');
    $this->form_validation->set_error_delimiters('<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>', '</div>');
    $data['operation'] = is_null($id) ? 'Tambah' : 'Sunting';

    if ($_POST AND $this->form_validation->run() == TRUE) {

      if ($this->input->post('class_id')) {
        $params['class_id'] = $this->input->post('class_id');
      } else {
        $params['class_input_date'] = date('Y-m-d H:i:s');
        $params['class_years'] = date('Y');
        $params['password'] = sha1($this->input->post('password'));
      }

      $params['user_user_id'] = $this->session->userdata('user_id');
      $params['class_last_update'] = date('Y-m-d H:i:s');
      $params['class_name'] = $this->input->post('class_name');
      $params['username'] = $this->input->post('username');
      $params['class_name'] = $this->input->post('class_name');
      $params['class_level'] = $this->input->post('class_level');
      $params['teachers_teacher_id'] = $this->input->post('teacher_id');
      $status = $this->Classes_model->add($params);


      // activity log
      $this->Activity_log_model->add(
        array(
          'log_date' => date('Y-m-d H:i:s'),
          'user_id' => $this->session->userdata('user_id'),
          'log_module' => 'Kelas',
          'log_action' => $data['operation'],
          'log_info' => 'ID:'.$status.';Title:' . $params['class_name']
          )
        );

      $this->session->set_flashdata('success', $data['operation'] . ' Kelas berhasil');
      redirect('admin/classes');
    } else {
      if ($this->input->post('class_id')) {
        redirect('admin/classes/edit/' . $this->input->post('class_id'));
      }

        // Edit mode
      if (!is_null($id)) {
        $data['class'] = $this->Classes_model->get(array('id' => $id));
      }
      $data['title'] = $data['operation'] . ' Kelas';
      $data['teachers'] = $this->Teachers_model->get();
      $data['main'] = 'admin/classes/classes_add';
      $this->load->view('admin/layout', $data);
    }
  }

    // Delete Classes
  public function delete($id = NULL) {
    if ($_POST) {
      $this->Classes_model->delete($id);
        // activity log
      $this->Activity_log_model->add(
        array(
          'log_date' => date('Y-m-d H:i:s'),
          'user_id' => $this->session->userdata('user_id'),
          'log_module' => 'Kelas',
          'log_action' => 'Hapus',
          'log_info' => 'ID:' . $id . ';Title:' . $this->input->post('del_name')
          )
        );
      redirect('admin/classes');
    } elseif (!$_POST) {
      redirect('admin/classes/edit/' . $id);
    }
  }

    // Add Classes and Update
  public function addStudent($id = NULL) {
    $this->load->model('Students_model');
    $this->load->library('form_validation');
    $this->form_validation->set_rules('student_full_name', 'Nama Siswa', 'trim|required|xss_clean');
    $this->form_validation->set_rules('student_nip', 'NIP Siswa', 'trim|required|xss_clean');
    $this->form_validation->set_rules('student_phone', 'No Telepon Siswa', 'trim|required|xss_clean');
    $this->form_validation->set_error_delimiters('<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>', '</div>');
    $data['operation'] = is_null($id) ? 'Tambah' : 'Sunting';

    if ($_POST AND $this->form_validation->run() == TRUE) {
      $params['student_input_date'] = date('Y-m-d H:i:s');
      $params['student_is_deleted'] = false;
      $params['student_is_resign'] = false;

      $params['user_user_id'] = $this->session->userdata('user_id');
      $params['student_last_update'] = date('Y-m-d H:i:s');
      $params['student_full_name'] = $this->input->post('student_full_name');
      $params['student_phone'] = $this->input->post('student_phone');
      $params['student_nip'] = $this->input->post('student_nip');
      $params['classes_class_id'] = $id;
      $status = $this->Students_model->add($params);


            // activity log
      $this->Activity_log_model->add(
        array(
          'log_date' => date('Y-m-d H:i:s'),
          'user_id' => $this->session->userdata('user_id'),
          'log_module' => 'Siswa',
          'log_action' => $data['operation'],
          'log_info' => 'ID:'.$status.';Title:' . $params['student_full_name']
          )
        );

      $this->session->set_flashdata('success', $data['operation'] . ' Siswa berhasil');
      redirect('admin/classes/detail/'.$id);
    } else {
      redirect('admin/classes/detail/'.$id);
    }
  }

  public function ajax_list() {
    $keys = $this->Classes_model->get_datatables();
    $data = array();
    $no = $_POST['start'];
    foreach ($keys as $key) {
      $no++;
      $row = array();
      $row[] = $key->class_level.' '.$key->class_name;
      $row[] = $key->teacher_name;
      $row[] = $key->class_years;

              //add html for action
      $row[] = '<a class="btn btn-warning btn-xs" href="'.site_url().'admin/classes/detail/'.$key->class_id.'" ><span class="glyphicon glyphicon-eye-open"></span></a><a class="btn btn-success btn-xs" href="'.site_url().'admin/classes/edit/'.$key->class_id.'" ><span class="glyphicon glyphicon-edit"></span></a>' ;

      $data[] = $row;
    }

    $output = array(
      "draw" => $_POST['draw'],
      "recordsTotal" => $this->Classes_model->count_all(),
      "recordsFiltered" => $this->Classes_model->count_filtered(),
      "data" => $data,
      );
          //output to json format
    echo json_encode($output);
  }

  public function export_excel()
  {
    $this->load->model('Students_model');
        // Apply Filter
        // Get $_GET variable
    $q = $this->input->get(NULL, TRUE);

    $data['q'] = $q;

    $params = array();

        // Class
    if (isset($q['c']) && !empty($q['c']) && $q['c'] != '') {
      $params['class'] = $q['c'];
    }

        // Date start
    if (isset($q['ds']) && !empty($q['ds']) && $q['ds'] != '') {
      $params['date_start'] = $q['ds'];
    }

        // Date end
    if (isset($q['de']) && !empty($q['de']) && $q['de'] != '') {
      $params['date_end'] = $q['de'];
    }

    $reports = $this->Present_model->get($params);
    $students = $this->Students_model->get(array('class' => $params['class']));

    $this->load->library("PHPExcel");
    $objXLS   = new PHPExcel();
    $objSheet = $objXLS->setActiveSheetIndex(0);            
    $cell     = 2;        
    $no       = 1;

    $objSheet->setCellValue('A1', 'NO');
    $objSheet->setCellValue('B1', 'NIP');
    $objSheet->setCellValue('C1', 'NAMA SISWA');
    $objSheet->setCellValue('D1', 'KELAS');
    $objSheet->setCellValue('E1', 'IZIN');
    $objSheet->setCellValue('F1', 'SAKIT');
    $objSheet->setCellValue('G1', 'ALFA');

    if(isset($q) AND count($q) > 0){
      $i = 0;
      $s = 0;
      $a = 0;
      foreach ($students as $key):
        foreach ($reports as $row): 
          if($key['student_id'] == $row['students_student_id']){
            switch ($row['present_type']) {
              case 'Izin':
              $i++;
              break;

              case 'Sakit':
              $s++;
              break;

              case 'Alfa':
              $a++;
              break;
            }
          }
          endforeach;

          $objSheet->setCellValue('A'.$cell, $no);
          $objSheet->setCellValueExplicit('B'.$cell, $key['student_nip'],PHPExcel_Cell_DataType::TYPE_STRING);
          $objSheet->setCellValue('C'.$cell, $key['student_full_name']);
          $objSheet->setCellValue('D'.$cell, $key['class_level'].' '.$key['class_name']);
          $objSheet->setCellValue('E'.$cell, $i); 
          $objSheet->setCellValue('F'.$cell, $s); 
          $objSheet->setCellValue('G'.$cell, $a); 

          $i = 0;
          $s = 0;
          $a = 0;
          $cell++;
          $no++;  
          endforeach;                   

          $objXLS->getActiveSheet()->getColumnDimension('A')->setWidth(5);
          $objXLS->getActiveSheet()->getColumnDimension('B')->setWidth(11);
          $objXLS->getActiveSheet()->getColumnDimension('C')->setWidth(30);
          $objXLS->getActiveSheet()->getColumnDimension('C')->setWidth(10);
          $objXLS->getActiveSheet()->getColumnDimension('E')->setWidth(5);
          $objXLS->getActiveSheet()->getColumnDimension('F')->setWidth(5);
          $objXLS->getActiveSheet()->getColumnDimension('G')->setWidth(5);

          $font = array('font' => array( 'bold' => true));
          $objXLS->getActiveSheet()
          ->getStyle('A1:G1')
          ->applyFromArray($font);

          $objXLS->setActiveSheetIndex(0);        
          $styleArray = array(
            'borders' => array(
             'allborders' => array(
               'style' => PHPExcel_Style_Border::BORDER_THIN,
               'color' => array(
                'rgb'  => '111111' 
                ),
               ),
             ),
            );
          $objXLS->getActiveSheet()
          ->getStyle('A1:G1')
          ->getFill()
          ->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
          ->getStartColor()
          ->setRGB('00bbff');
          $objSheet->getStyle('A1:G'.$no)->applyFromArray($styleArray);
          $objWriter = PHPExcel_IOFactory::createWriter($objXLS, 'Excel5'); 
          header('Content-Type: application/vnd.ms-excel'); 
          header('Content-Disposition: attachment;filename="LAPORAN_ABSEN.xls"'); 
          header('Cache-Control: max-age=0'); 
          $objWriter->save('php://output'); 
          exit();      
        }
      }

    }

    /* End of file classes.php */
    /* Location: ./application/controllers/admin/classes.php */
