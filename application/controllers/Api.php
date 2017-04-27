<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Api controllers class
 *
 * @package     SYSCMS
 * @subpackage  Controllers
 * @category    Controllers
 * @author      Sistiandy Syahbana nugraha <sistiandy.web.id>
 */
class Api extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $res = array('message' => 'Nothing here');

        $this->output
        ->set_content_type('application/json')
        ->set_output(json_encode($res));
    }
    
    public function getTeacher() {
        $this->load->model('Teachers_model');
        $res = $this->Teachers_model->get();

        $this->output
        ->set_content_type('application/json')
        ->set_output(json_encode($res));
    }
    
    public function getStudentByClass($id = NULL) {
        $this->load->model('Student_model');
        $res = $this->Student_model->get(array('class_id' => $id));

        $this->output
        ->set_content_type('application/json')
        ->set_output(json_encode($res));
    }
    
    public function getClassByLevel($level = NULL) {
        $this->load->model('Classes_model');
        $res = $this->Classes_model->get(array('level' => $level));

        $this->output
        ->set_content_type('application/json')
        ->set_output(json_encode($res));
    }
    
    public function getPresentToday($id = NULL) {
        $this->load->model('Present_model');
        $res = $this->Present_model->get(array('class' => $id, 'date' => date('Y-m-d')));

        $this->output
        ->set_content_type('application/json')
        ->set_output(json_encode($res));
    }

    public function makePresentToday() {
        $this->load->model('Present_model');
        $this->load->model('Students_model');
        $id = $this->input->post('class_id');

        $check = $this->Present_model->get(array('class' => $id, 'date' => date('Y-m-d')));
        if(count($check) > 0){
            $res = '';
        }else{
            $students = $this->Students_model->get(array('class_id'=>$id));

            $params['user_user_id'] = $this->session->userdata('user_id');
            $params['present_year'] = date('Y');
            $params['present_month'] = date('m');
            $params['present_date'] = date('Y-m-d');
            $params['present_type'] = 'Hadir';
            $params['classes_class_id'] = $id;
            $params['present_input_date'] = date('Y-m-d H:i');
            $params['present_last_update'] = date('Y-m-d H:i');
            $present_id = array();
            foreach ($students as $row) {
                $params['students_student_id'] = $row['student_id'];
                $present_id[] = $this->Present_model->add($params);
            }
            $res = $present_id;
        }

        $this->output
        ->set_content_type('application/json')
        ->set_output(json_encode($res));
    }

    public function inputType() {
        $this->load->model('Present_model');
        $id = $this->input->post('present_id');
        $type = $this->input->post('present_type');

        $params['present_id'] = $id;
        $params['present_type'] = $type;
        $this->Present_model->add($params);
        $res = $id;

        $this->output
        ->set_content_type('application/json')
        ->set_output(json_encode($res));
    }

}
