<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');


class Students extends CI_Controller {

    public function __construct() {
        parent::__construct(TRUE);
        if ($this->session->userdata('logged_class') == NULL) {
            header("Location:" . site_url('class/auth/login') . "?location=" . urlencode($_SERVER['REQUEST_URI']));
        }
        $this->load->model(array('Students_model', 'Activity_log_model'));
        $this->load->library('upload');
    }

    // Classes view in list
    public function index($offset = NULL) {
        $this->load->library('pagination');
        $data['students'] = $this->Students_model->get(array('limit' => 10, 'offset' => $offset));
        $config['base_url'] = site_url('class/students/index');
        $config['total_rows'] = count($this->Students_model->get());
        $this->pagination->initialize($config);

        $data['title'] = 'Siswa';
        $data['main'] = 'class/students/students_list';
        $this->load->view('class/layout', $data);
    }

    function detail($id = NULL) {
        if ($this->Students_model->get(array('id' => $id)) == NULL) {
            redirect('class/students');
        }
        $data['student'] = $this->Students_model->get(array('id' => $id));
        $data['title'] = 'Detail Siswa';
        $data['main'] = 'class/students/students_view';
        $this->load->view('class/layout', $data);
    }

    public function ajax_list() {
        $keys = $this->Students_model->get_datatables(array('class_id' => $this->session->userdata('class_id')));
        $data = array();
        $no = $_POST['start'];
        foreach ($keys as $key) {
            $no++;
            $row = array();
            $row[] = $key->student_full_name;
            $row[] = $key->student_nip;
            $row[] = $key->class_level.' '.$key->class_name;

            //add html for action
            $row[] = '<a class="btn btn-warning btn-xs" href="'.site_url().'class/students/detail/'.$key->student_id.'" ><span class="glyphicon glyphicon-eye-open"></span></a><a class="btn btn-success btn-xs" href="'.site_url().'class/students/edit/'.$key->student_id.'" ><span class="glyphicon glyphicon-edit"></span></a>' ;

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
/* Location: ./application/controllers/class/students.php */
