<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class Dashboard extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('logged') == NULL) {
            header("Location:" . site_url('admin/auth/login') . "?location=" . urlencode($_SERVER['REQUEST_URI']));
        }
    }

    // Dashboard View
    public function index()
    {
        $this->load->model('Students_model');
        $this->load->model('Teachers_model');
        $this->load->model('User_model');
        $this->load->model('Classes_model');
        $this->load->model('Present_model');
        $data['title'] = 'Dashboard';
        $data['students'] = count($this->Students_model->get());
        $data['teachers'] = count($this->Teachers_model->get());
        $data['users'] = count($this->User_model->get());
        $data['class'] = count($this->Classes_model->get());
        $data['presentX'] = $this->Present_model->get(array('level' => 'X', 'not_type' => 'Hadir', 'date' => date('Y-m-d')));
        $data['presentXI'] = $this->Present_model->get(array('level' => 'XI', 'not_type' => 'Hadir', 'date' => date('Y-m-d')));
        $data['presentXII'] = $this->Present_model->get(array('level' => 'XII', 'not_type' => 'Hadir', 'date' => date('Y-m-d')));

        $data['main'] = 'admin/dashboard/dashboard';
        $this->load->view('admin/layout', $data);
    }

}

/* End of file dashboard.php */
/* Location: ./application/controllers/dashboard.php */
