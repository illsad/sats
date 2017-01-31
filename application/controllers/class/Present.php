<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');


class Present extends CI_Controller {

    public function __construct() {
        parent::__construct(TRUE);
        if ($this->session->userdata('logged_class') == NULL) {
            header("Location:" . site_url('class/auth/login') . "?location=" . urlencode($_SERVER['REQUEST_URI']));
        }
        $this->load->model(array('Present_model', 'Activity_log_model'));
        $this->load->library('upload');
    }

    // Classes view in list
    public function index($offset = NULL) {
        $this->load->library('pagination');
        $data['present'] = $this->Present_model->get(array('limit' => 10, 'offset' => $offset));
        $config['base_url'] = site_url('class/present/index');
        $config['total_rows'] = count($this->Present_model->get());
        $this->pagination->initialize($config);

        $data['title'] = 'Kehadiran';
        $data['main'] = 'class/present/present_list';
        $this->load->view('class/layout', $data);
    }

    function detail($id = NULL) {
        if ($this->Present_model->get(array('id' => $id)) == NULL) {
            redirect('class/present');
        }
        $data['present'] = $this->Present_model->get(array('id' => $id));
        $data['title'] = 'Detail Kehadiran';
        $data['main'] = 'class/present/present_view';
        $this->load->view('class/layout', $data);
    }

    public function ajax_list() {
        $keys = $this->Present_model->get_datatables(array('class_id' => $this->session->userdata('class_id')));
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
            $row[] = '<a class="btn btn-warning btn-xs" href="'.site_url().'class/present/detail/'.$key->present_id.'" ><span class="glyphicon glyphicon-eye-open"></span></a>' ;

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
/* Location: ./application/controllers/class/present.php */
