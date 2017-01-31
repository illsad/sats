<?php

if (!defined('BASEPATH'))
exit('No direct script access allowed');

/**
* Students Model Class
*
* @package     SYSCMS
* @subpackage  Models
* @category    Models
* @author      Sistiandy Syahbana nugraha <sistiandy.web.id>
*/
class Students_model extends CI_Model {

  var $table = 'students';
  var $all_column = array('students.student_id', 'student_nip', 'student_full_name',
  'student_phone',
  'student_is_resign',
  'classes_class_id',
  'class_name',
  'student_is_deleted',
  'student_input_date', 'student_last_update'); //set all column field database
  var $order = array('student_last_update' => 'desc'); // default order

  function __construct() {
    parent::__construct();
  }

  private function _get_datatables_query() {

    $this->db->from($this->table);
    $this->db->where('student_is_deleted', FALSE);

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

  function get_datatables($params = array()) {
    $this->_get_datatables_query();
    if ($_POST['length'] != -1)
    $this->db->limit($_POST['length'], $_POST['start']);

    if (isset($params['class_id'])) {
      $this->db->where('classes_class_id', $params['class_id']);
    } 
    $this->db->select('students.student_id, student_nip, student_full_name,
    student_is_resign, student_is_deleted, student_phone,
    classes_class_id,
    student_input_date, student_last_update');
    $this->db->select('classes.class_name, class_level');
    $this->db->join('classes', 'classes.class_id = students.classes_class_id', 'left');
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
      $this->db->where('students.student_id', $params['id']);
    }
    $this->db->where('student_is_deleted', FALSE);

    if (isset($params['limit'])) {
      if (!isset($params['offset'])) {
        $params['offset'] = NULL;
      }

      $this->db->limit($params['limit'], $params['offset']);
    }

    if (isset($params['class_id'])) {
      $this->db->where('classes_class_id', $params['class_id']);
    } 

    if (isset($params['order_by'])) {
      $this->db->order_by($params['order_by'], 'desc');
    } else {
      $this->db->order_by('student_last_update', 'desc');
    }

    $this->db->select('students.student_id, student_nip, student_full_name,
    student_is_resign, student_is_deleted
    classes_class_id, student_phone,
    student_input_date, student_last_update');
    $this->db->select('classes.class_name, class_level');
    $this->db->join('classes', 'classes.class_id = students.classes_class_id', 'left');
    $res = $this->db->get('students');

    if (isset($params['id'])) {
      return $res->row_array();
    } else {
      return $res->result_array();
    }
  }

  // Add and update to database
  function add($data = array()) {

    if (isset($data['student_id'])) {
      $this->db->set('student_id', $data['student_id']);
    }

    if (isset($data['student_nip'])) {
      $this->db->set('student_nip', $data['student_nip']);
    }

    if (isset($data['student_full_name'])) {
      $this->db->set('student_full_name', $data['student_full_name']);
    }

    if (isset($data['student_phone'])) {
      $this->db->set('student_phone', $data['student_phone']);
    }

    if (isset($data['student_is_resign'])) {
      $this->db->set('student_is_resign', $data['student_is_resign']);
    }

    if (isset($data['student_is_deleted'])) {
      $this->db->set('student_is_deleted', $data['student_is_deleted']);
    }

    if (isset($data['student_input_date'])) {
      $this->db->set('student_input_date', $data['student_input_date']);
    }

    if (isset($data['student_last_update'])) {
      $this->db->set('student_last_update', $data['student_last_update']);
    }
    if (isset($data['classes_class_id'])) {
      $this->db->set('classes_class_id', $data['classes_class_id']);
    }

    if (isset($data['student_id'])) {
      $this->db->where('student_id', $data['student_id']);
      $this->db->update('students');
      $id = $data['student_id'];
    } else {
      $this->db->insert('students');
      $id = $this->db->insert_id();
    }

    $status = $this->db->affected_rows();
    return ($status == 0) ? FALSE : $id;
  }

  // Delete to database
  function delete($id) {
    $this->db->set('student_is_deleted', 1);
    $this->db->where('student_id', $id);
    $this->db->update('students');
  }

}
