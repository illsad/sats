<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');


class Students extends CI_Controller {

    public function __construct() {
        parent::__construct(TRUE);
        if ($this->session->userdata('logged') == NULL) {
            header("Location:" . site_url('admin/auth/login') . "?location=" . urlencode($_SERVER['REQUEST_URI']));
        }
        $this->load->model(array('Students_model', 'Activity_log_model'));
        $this->load->library('upload');
    }

    // Classes view in list
    public function index($offset = NULL) {
        $this->load->library('pagination');
        $data['students'] = $this->Students_model->get(array('limit' => 10, 'offset' => $offset));
        $config['base_url'] = site_url('admin/students/index');
        $config['total_rows'] = count($this->Students_model->get());
        $this->pagination->initialize($config);

        $data['title'] = 'Siswa';
        $data['main'] = 'admin/students/students_list';
        $this->load->view('admin/layout', $data);
    }

    function detail($id = NULL) {
        if ($this->Students_model->get(array('id' => $id)) == NULL) {
            redirect('admin/students');
        }
        $data['student'] = $this->Students_model->get(array('id' => $id));
        $data['title'] = 'Detail Siswa';
        $data['main'] = 'admin/students/students_view';
        $this->load->view('admin/layout', $data);
    }

    // Add Classes and Update
    public function add($id = NULL) {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('student_full_name', 'Nama Siswa', 'trim|required|xss_clean');
        $this->form_validation->set_rules('student_nis', 'NIS Siswa', 'trim|required|xss_clean');
        $this->form_validation->set_rules('student_phone', 'No Telepon Siswa', 'trim|required|xss_clean');
        $this->form_validation->set_error_delimiters('<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>', '</div>');
        $data['operation'] = is_null($id) ? 'Tambah' : 'Sunting';

        if ($_POST AND $this->form_validation->run() == TRUE) {

            if ($this->input->post('student_id')) {
                $params['student_id'] = $this->input->post('student_id');
            } else {
                $params['student_input_date'] = date('Y-m-d H:i:s');
                $params['student_is_deleted'] = false;
                $params['student_is_resign'] = false;
                $params['classes_class_id'] = $this->input->post('classes_class_id');
            }

            $params['user_user_id'] = $this->session->userdata('user_id');
            $params['student_nis'] = $this->input->post('student_nis');
            $params['student_last_update'] = date('Y-m-d H:i:s');
            $params['student_full_name'] = $this->input->post('student_full_name');
            $params['student_phone'] = $this->input->post('student_phone');
            $params['student_address'] = $this->input->post('student_address');
            $params['student_pob'] = $this->input->post('student_pob');
            $params['student_dob'] = $this->input->post('student_dob');
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
            redirect('admin/students');
        } else {
            if ($this->input->post('student_id')) {
                redirect('admin/students/edit/' . $this->input->post('student_id'));
            }

            // Edit mode
            if (!is_null($id)) {
                $data['student'] = $this->Students_model->get(array('id' => $id));
            }
            $this->load->model('Classes_model');
            $data['classes'] = $this->Classes_model->get();
            $data['title'] = $data['operation'] . ' Siswa';
            $data['main'] = 'admin/students/students_add';
            $this->load->view('admin/layout', $data);
        }
    }

    // Delete Classes
    public function delete($id = NULL) {
        if ($_POST) {
            $this->Students_model->delete($id);
            // activity log
            $this->Activity_log_model->add(
                    array(
                        'log_date' => date('Y-m-d H:i:s'),
                        'user_id' => $id,
                        'log_module' => 'Siswa',
                        'log_action' => 'Hapus',
                        'log_info' => 'ID:' . $id . ';Title:' . $this->input->post('del_name')
                    )
            );
            redirect('admin/students');
        } elseif (!$_POST) {
            redirect('admin/students/edit/' . $id);
        }
    }

    public function ajax_list() {
        $keys = $this->Students_model->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($keys as $key) {
            $no++;
            $row = array();
            $row[] = $key->student_full_name;
            $row[] = $key->student_nis;
            $row[] = $key->class_level.' '.$key->class_name;

            //add html for action
            $row[] = '<a class="btn btn-warning btn-xs" href="'.site_url().'admin/students/detail/'.$key->student_id.'" ><span class="glyphicon glyphicon-eye-open"></span></a><a class="btn btn-success btn-xs" href="'.site_url().'admin/students/edit/'.$key->student_id.'" ><span class="glyphicon glyphicon-edit"></span></a>' ;

            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->Students_model->count_all(),
            "recordsFiltered" => $this->Students_model->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

}

/* End of file students.php */
/* Location: ./application/controllers/admin/students.php */
