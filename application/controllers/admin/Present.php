<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');


class Present extends CI_Controller {

    public function __construct() {
        parent::__construct(TRUE);
        if ($this->session->userdata('logged') == NULL) {
            header("Location:" . site_url('admin/auth/login') . "?location=" . urlencode($_SERVER['REQUEST_URI']));
        }
        $this->load->model(array('Present_model', 'Activity_log_model'));
        $this->load->library('upload');
    }

    // Classes view in list
    public function index($offset = NULL) {
        $this->load->library('pagination');
        $data['present'] = $this->Present_model->get(array('limit' => 10, 'offset' => $offset));
        $config['base_url'] = site_url('admin/present/index');
        $config['total_rows'] = count($this->Present_model->get());
        $this->pagination->initialize($config);

        $data['title'] = 'Kehadiran';
        $data['main'] = 'admin/present/present_list';
        $this->load->view('admin/layout', $data);
    }

    function detail($id = NULL) {
        if ($this->Present_model->get(array('id' => $id)) == NULL) {
            redirect('admin/present');
        }
        $data['present'] = $this->Present_model->get(array('id' => $id));
        $data['title'] = 'Detail Kehadiran';
        $data['main'] = 'admin/present/present_view';
        $this->load->view('admin/layout', $data);
    }

    // Add Classes and Update
    public function add($id = NULL) {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('present_type', 'Jenis Kehadiran', 'trim|required|xss_clean');
        $this->form_validation->set_error_delimiters('<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>', '</div>');
        $data['operation'] = is_null($id) ? 'Tambah' : 'Sunting';

        if ($_POST AND $this->form_validation->run() == TRUE) {

            if ($this->input->post('present_id')) {
                $params['present_id'] = $this->input->post('present_id');
                $params['present_type'] = $this->input->post('present_type');
            } else {
                $params['present_input_date'] = date('Y-m-d H:i:s');
            }

            $params['user_user_id'] = $this->session->userdata('user_id');
            $params['present_last_update'] = date('Y-m-d H:i:s');
            $params['present_date'] = $this->input->post('present_date');
            $params['present_year'] = pretty_date($this->input->post('present_date'), 'Y', false);
            $params['present_month'] = pretty_date($this->input->post('present_month'), 'm', false);
            $params['present_description'] = $this->input->post('present_description');
            $params['students_student_id'] = $this->input->post('student_id');
            $status = $this->Present_model->add($params);


            // activity log
            $this->Activity_log_model->add(
                    array(
                        'log_date' => date('Y-m-d H:i:s'),
                        'user_id' => $this->session->userdata('user_id'),
                        'log_module' => 'Kehadiran',
                        'log_action' => $data['operation'],
                        'log_info' => 'ID:'.$status.';Date:' . $params['present_date']
                    )
            );

            $this->session->set_flashdata('success', $data['operation'] . ' Kehadiran berhasil');
            redirect('admin/present');
        } else {
            if ($this->input->post('present_id')) {
                redirect('admin/present/edit/' . $this->input->post('present_id'));
            }

            // Edit mode
            if (!is_null($id)) {
                $data['present'] = $this->Present_model->get(array('id' => $id));
            }
            $data['title'] = $data['operation'] . ' Kehadiran';
            $data['main'] = 'admin/present/present_add';
            $this->load->view('admin/layout', $data);
        }
    }

    // Delete Classes
    public function delete($id = NULL) {
        if ($_POST) {
            $this->Present_model->delete($id);
            // activity log
            $this->Activity_log_model->add(
                    array(
                        'log_date' => date('Y-m-d H:i:s'),
                        'user_id' => $id,
                        'log_module' => 'Kehadiran',
                        'log_action' => 'Hapus',
                        'log_info' => 'ID:' . $id . ';Title:' . $this->input->post('del_name')
                    )
            );
            redirect('admin/present');
        } elseif (!$_POST) {
            redirect('admin/present/edit/' . $id);
        }
    }

    public function ajax_list() {
        $keys = $this->Present_model->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($keys as $key) {
            $no++;
            $row = array();
            $row[] = pretty_date($key->present_date, 'l, d-m-Y', false);
            $row[] = $key->student_full_name;
            $row[] = $key->student_nip;
            $row[] = $key->present_type;

            //add html for action
            $row[] = '<a class="btn btn-warning btn-xs" href="'.site_url().'admin/present/detail/'.$key->present_id.'" ><span class="glyphicon glyphicon-eye-open"></span></a><a class="btn btn-success btn-xs" href="'.site_url().'admin/present/edit/'.$key->present_id.'" ><span class="glyphicon glyphicon-edit"></span></a>' ;

            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->Present_model->count_all(),
            "recordsFiltered" => $this->Present_model->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

}

/* End of file present.php */
/* Location: ./application/controllers/admin/present.php */
