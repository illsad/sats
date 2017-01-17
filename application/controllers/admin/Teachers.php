<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');


class Teachers extends CI_Controller {

    public function __construct() {
        parent::__construct(TRUE);
        if ($this->session->userdata('logged') == NULL) {
            header("Location:" . site_url('admin/auth/login') . "?location=" . urlencode($_SERVER['REQUEST_URI']));
        }
        $this->load->model(array('Teachers_model', 'Activity_log_model'));
        $this->load->library('upload');
    }

    // Classes view in list
    public function index($offset = NULL) {
        $this->load->library('pagination');
        $data['teachers'] = $this->Teachers_model->get(array('limit' => 10, 'offset' => $offset));
        $config['base_url'] = site_url('admin/teachers/index');
        $config['total_rows'] = count($this->Teachers_model->get());
        $this->pagination->initialize($config);

        $data['title'] = 'Guru';
        $data['main'] = 'admin/teachers/teachers_list';
        $this->load->view('admin/layout', $data);
    }

    function detail($id = NULL) {
        if ($this->Teachers_model->get(array('id' => $id)) == NULL) {
            redirect('admin/teachers');
        }
        $data['teacher'] = $this->Teachers_model->get(array('id' => $id));
        $data['title'] = 'Detail Guru';
        $data['main'] = 'admin/teachers/teachers_view';
        $this->load->view('admin/layout', $data);
    }

    // Add Classes and Update
    public function add($id = NULL) {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('teacher_name', 'Nama Guru', 'trim|required|xss_clean');
        $this->form_validation->set_rules('teacher_nip', 'NIP Guru', 'trim|required|xss_clean');
        $this->form_validation->set_error_delimiters('<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>', '</div>');
        $data['operation'] = is_null($id) ? 'Tambah' : 'Sunting';

        if ($_POST AND $this->form_validation->run() == TRUE) {

            if ($this->input->post('teacher_id')) {
                $params['teacher_id'] = $this->input->post('teacher_id');
            } else {
                $params['teacher_input_date'] = date('Y-m-d H:i:s');
            }

            $params['user_user_id'] = $this->session->userdata('user_id');
            $params['teacher_last_update'] = date('Y-m-d H:i:s');
            $params['teacher_name'] = $this->input->post('teacher_name');
            $params['teacher_nip'] = $this->input->post('teacher_nip');
            $status = $this->Teachers_model->add($params);


            // activity log
            $this->Activity_log_model->add(
                    array(
                        'log_date' => date('Y-m-d H:i:s'),
                        'user_id' => $this->session->userdata('user_id'),
                        'log_module' => 'Guru',
                        'log_action' => $data['operation'],
                        'log_info' => 'ID:'.$status.';Title:' . $params['teacher_name']
                    )
            );

            $this->session->set_flashdata('success', $data['operation'] . ' Guru berhasil');
            redirect('admin/teachers');
        } else {
            if ($this->input->post('teacher_id')) {
                redirect('admin/teachers/edit/' . $this->input->post('teacher_id'));
            }

            // Edit mode
            if (!is_null($id)) {
                $data['teacher'] = $this->Teachers_model->get(array('id' => $id));
            }
            $data['title'] = $data['operation'] . ' Guru';
            $data['main'] = 'admin/teachers/teachers_add';
            $this->load->view('admin/layout', $data);
        }
    }

    // Delete Classes
    public function delete($id = NULL) {
        if ($_POST) {
            $this->Teachers_model->delete($id);
            // activity log
            $this->Activity_log_model->add(
                    array(
                        'log_date' => date('Y-m-d H:i:s'),
                        'user_id' => $id,
                        'log_module' => 'Guru',
                        'log_action' => 'Hapus',
                        'log_info' => 'ID:' . $id . ';Title:' . $this->input->post('del_name')
                    )
            );
            redirect('admin/teachers');
        } elseif (!$_POST) {
            redirect('admin/teachers/edit/' . $id);
        }
    }

    public function ajax_list() {
        $keys = $this->Teachers_model->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($keys as $key) {
            $no++;
            $row = array();
            $row[] = $key->teacher_name;
            $row[] = $key->teacher_nip;

            //add html for action
            $row[] = '<a class="btn btn-warning btn-xs" href="'.site_url().'admin/teachers/detail/'.$key->teacher_id.'" ><span class="glyphicon glyphicon-eye-open"></span></a><a class="btn btn-success btn-xs" href="'.site_url().'admin/teachers/edit/'.$key->teacher_id.'" ><span class="glyphicon glyphicon-edit"></span></a>' ;

            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->Teachers_model->count_all(),
            "recordsFiltered" => $this->Teachers_model->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

}

/* End of file teachers.php */
/* Location: ./application/controllers/admin/teachers.php */
