<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class Dashboard extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('logged_class') == NULL) {
            header("Location:" . site_url('class/auth/login') . "?location=" . urlencode($_SERVER['REQUEST_URI']));
        }
    }

    // Dashboard View
    public function index()
    {
        $this->load->model('Classes_model');
        $data['ngapp'] = 'ng-app="satsApp"';
        $data['class'] = $this->Classes_model->get(array('id' => $this->session->userdata('class_id')));
        $data['title'] = 'Dashboard';
        $data['main'] = 'class/dashboard/dashboard';
        $this->load->view('class/layout', $data);
    }

}

/* End of file dashboard.php */
/* Location: ./application/controllers/dashboard.php */
