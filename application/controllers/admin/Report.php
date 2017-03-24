<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');


class Report extends CI_Controller {

    public function __construct() {
        parent::__construct(TRUE);
        if ($this->session->userdata('logged') == NULL) {
            header("Location:" . site_url('admin/auth/login') . "?location=" . urlencode($_SERVER['REQUEST_URI']));
        }
        $this->load->model(array('Present_model'));
    }

    // Classes view in list
    public function index($offset = NULL) {
        $this->load->library('pagination');
        $this->load->model('Students_model');

        // Apply Filter
        // Get $_GET variable
        $q = $this->input->get(NULL, TRUE);

        $data['q'] = $q;
        $params = array();
        $params['class'] = '';

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

        $data['reports'] = $this->Present_model->get($params);
        $data['students'] = $this->Students_model->get(array('class' => $params['class']));
        $config['base_url'] = site_url('admin/report/index');
        $config['total_rows'] = count($this->Present_model->get());
        $this->pagination->initialize($config);

        $data['ngapp'] = 'ng-app="satsApp"';
        $data['title'] = 'Laporan Kehadiran';
        $data['main'] = 'admin/report/report_list';
        $this->load->view('admin/layout', $data);
    }

    function detail($id = NULL) {
        if ($this->Present_model->get(array('id' => $id)) == NULL) {
            redirect('admin/report');
        }
        $data['report'] = $this->Present_model->get(array('id' => $id));
        $data['title'] = 'Detail Kehadiran';
        $data['main'] = 'admin/report/report_view';
        $this->load->view('admin/layout', $data);
    }

}

/* End of file report.php */
/* Location: ./application/controllers/admin/report.php */
