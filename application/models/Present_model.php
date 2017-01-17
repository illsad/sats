<?php

if (!defined('BASEPATH'))
exit('No direct script access allowed');

/**
* Present Model Class
*
* @package     SYSCMS
* @subpackage  Models
* @category    Models
* @author      Sistiandy Syahbana nugraha <sistiandy.web.id>
*/
class Present_model extends CI_Model {

  var $table = 'present';
  var $all_column = array('present.present_id', 'present_year', 'present_month',
  'present_date',
  'present_type',
  'present_description',
  'students_student_id',
  'student_full_name',
  'present_input_date', 'present_last_update'); //set all column field database
  var $order = array('present_last_update' => 'desc'); // default order

  function __construct() {
    parent::__construct();
  }

  private function _get_datatables_query() {

    $this->db->from($this->table);

    $i = 0;

    foreach ($this->all_column as $item) { // loop column
      if ($_POST['search']['value']) { // if datatable send POST for search
        if ($i === 0) { // first loop
          $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
          $this->db->like($item, $_POST['search']['value']);
        } else {
          $this->db->or_like($item, $_POST['search']['value']);
        }

        if (count($this->all_column) - 1 == $i) //last loop
        $this->db->group_end(); //close bracket
      }
      $i++;
    }

    if (isset($_POST['order'])) { // here order processing
      $this->db->order_by($this->all_column[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
    } else if (isset($this->order)) {
      $order = $this->order;
      $this->db->order_by(key($order), $order[key($order)]);
    }
  }

  function get_datatables() {
    $this->_get_datatables_query();
    if ($_POST['length'] != -1)
    $this->db->limit($_POST['length'], $_POST['start']);

    $this->db->select('present.present_id, present_year, present_month,
    present_date, present_type, present_description,
    user_user_id,
    students_student_id,
    present_input_date, present_last_update');
    $this->db->select('students.student_full_name, student_nip');
    $this->db->select('user.user_name');
    $this->db->join('students', 'students.student_id = present.students_student_id', 'left');
    $this->db->join('user', 'user.user_id = present.user_user_id', 'left');
    $query = $this->db->get();
    return $query->result();
  }

  function count_filtered() {
    $this->_get_datatables_query();
    $query = $this->db->get();
    return $query->num_rows();
  }

  public function count_all() {
    $this->db->from($this->table);
    return $this->db->count_all_results();
  }

  // Get From Databases
  function get($params = array()) {
    if (isset($params['id'])) {
      $this->db->where('present.present_id', $params['id']);
    }

    if (isset($params['limit'])) {
      if (!isset($params['offset'])) {
        $params['offset'] = NULL;
      }

      $this->db->limit($params['limit'], $params['offset']);
    }

    if (isset($params['order_by'])) {
      $this->db->order_by($params['order_by'], 'desc');
    } else {
      $this->db->order_by('present_last_update', 'desc');
    }

    $this->db->select('present.present_id, present_year, present_month,
    present_date, present_type, present_description,
    user_user_id,
    students_student_id,
    present_input_date, present_last_update');
    $this->db->select('students.student_full_name, student_nip');
    $this->db->select('user.user_name');
    $this->db->join('students', 'students.student_id = present.students_student_id', 'left');
    $this->db->join('user', 'user.user_id = present.user_user_id', 'left');
    $res = $this->db->get('present');

    if (isset($params['id'])) {
      return $res->row_array();
    } else {
      return $res->result_array();
    }
  }

  // Add and update to database
  function add($data = array()) {

    if (isset($data['present_id'])) {
      $this->db->set('present_id', $data['present_id']);
    }

    if (isset($data['present_year'])) {
      $this->db->set('present_year', $data['present_year']);
    }

    if (isset($data['present_month'])) {
      $this->db->set('present_month', $data['present_month']);
    }

    if (isset($data['present_date'])) {
      $this->db->set('present_date', $data['present_date']);
    }

    if (isset($data['present_type'])) {
      $this->db->set('present_type', $data['present_type']);
    }

    if (isset($data['present_description'])) {
      $this->db->set('present_description', $data['present_description']);
    }

    if (isset($data['present_input_date'])) {
      $this->db->set('present_input_date', $data['present_input_date']);
    }

    if (isset($data['present_last_update'])) {
      $this->db->set('present_last_update', $data['present_last_update']);
    }
    
    if (isset($data['user_user_id'])) {
      $this->db->set('user_user_id', $data['user_user_id']);
    }

    if (isset($data['students_student_id'])) {
      $this->db->set('students_student_id', $data['students_student_id']);
    }

    if (isset($data['present_id'])) {
      $this->db->where('present_id', $data['present_id']);
      $this->db->update('present');
      $id = $data['present_id'];
    } else {
      $this->db->insert('present');
      $id = $this->db->insert_id();
    }

    $status = $this->db->affected_rows();
    return ($status == 0) ? FALSE : $id;
  }

  // Delete to database
  function delete($id) {
    $this->db->where('present_id', $id);
    $this->db->delete('present');
  }

}
