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
    if ($this->Classes_model->get(array('id' => $id)) == NULL) {
      redirect('admin/classes');
    }
    $data['class'] = $this->Classes_model->get(array('id' => $id));
    $data['title'] = 'Detail Kelas';
    $data['main'] = 'admin/classes/classes_view';
    $this->load->view('admin/layout', $data);
  }

  // Add Classes and Update
  public function add($id = NULL) {
    $this->load->model('Teachers_model');
    $this->load->library('form_validation');
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
      }

      $params['user_user_id'] = $this->session->userdata('user_id');
      $params['class_last_update'] = date('Y-m-d H:i:s');
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
            'user_id' => $id,
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

    }

    /* End of file classes.php */
    /* Location: ./application/controllers/admin/classes.php */
