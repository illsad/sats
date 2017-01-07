<?php

if (!defined('BASEPATH'))
exit('No direct script access allowed');

/**
* Classes Model Class
*
* @package     SYSCMS
* @subpackage  Models
* @category    Models
* @author      Sistiandy Syahbana nugraha <sistiandy.web.id>
*/
class Classes_model extends CI_Model {

  var $table = 'classes';
  var $all_column = array('classes.class_id', 'class_name', 'class_level', 'teachers.teacher_name',
  'class_years', 'class_is_deleted', 'classes.user_user_id', 'classes.teachers_teacher_id',
  'class_input_date', 'class_last_update'); //set all column field database
  var $order = array('class_last_update' => 'desc'); // default order

  function __construct() {
    parent::__construct();
  }

  private function _get_datatables_query() {

    $this->db->from($this->table);
    $this->db->where('class_is_deleted', FALSE);

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
        $this->db->join('user', 'user.user_id = classes.user_user_id', 'left');
        $this->db->join('teachers', 'teachers.teacher_id = classes.teachers_teacher_id', 'left');
  }

  function get_datatables() {
    $this->_get_datatables_query();
    if ($_POST['length'] != -1)
    $this->db->limit($_POST['length'], $_POST['start']);

    $this->db->select('classes.class_id, class_name, class_level, teacher_name,
    class_years, class_is_deleted, classes.user_user_id, classes.teachers_teacher_id,
    user.user_full_name,
    class_input_date, class_last_update');
    $this->db->select('teachers.teacher_name');

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
      $this->db->where('classes.class_id', $params['id']);
    }
    $this->db->where('class_is_deleted', FALSE);

    if (isset($params['limit'])) {
      if (!isset($params['offset'])) {
        $params['offset'] = NULL;
      }

      $this->db->limit($params['limit'], $params['offset']);
    }

    if (isset($params['order_by'])) {
      $this->db->order_by($params['order_by'], 'desc');
    } else {
      $this->db->order_by('class_last_update', 'desc');
    }

    $this->db->select('classes.class_id, class_name, class_level, teacher_name,
    class_years, class_is_deleted, classes.user_user_id, classes.teachers_teacher_id,
    user.user_full_name, 
    class_input_date, class_last_update');
    $this->db->select('teachers.teacher_name');
    $this->db->join('user', 'user.user_id = classes.user_user_id', 'left');
    $this->db->join('teachers', 'teachers.teacher_id = classes.teachers_teacher_id', 'left');

    $res = $this->db->get('classes');

    if (isset($params['id'])) {
      return $res->row_array();
    } else {
      return $res->result_array();
    }
  }

  // Add and update to database
  function add($data = array()) {

    if (isset($data['class_id'])) {
      $this->db->set('class_id', $data['class_id']);
    }

    if (isset($data['class_name'])) {
      $this->db->set('class_name', $data['class_name']);
    }

    if (isset($data['class_level'])) {
      $this->db->set('class_level', $data['class_level']);
    }

    if (isset($data['teachers_teacher_id'])) {
      $this->db->set('teachers_teacher_id', $data['teachers_teacher_id']);
    }

    if (isset($data['class_years'])) {
      $this->db->set('class_years', $data['class_years']);
    }

    if (isset($data['class_is_deleted'])) {
      $this->db->set('class_is_deleted', $data['class_is_deleted']);
    }

    if (isset($data['user_user_id'])) {
      $this->db->set('user_user_id', $data['user_user_id']);
    }

    if (isset($data['class_input_date'])) {
      $this->db->set('class_input_date', $data['class_input_date']);
    }

    if (isset($data['class_last_update'])) {
      $this->db->set('class_last_update', $data['class_last_update']);
    }

    if (isset($data['category_id'])) {
      $this->db->set('class_category_category_id', $data['category_id']);
    }

    if (isset($data['class_id'])) {
      $this->db->where('class_id', $data['class_id']);
      $this->db->update('classes');
      $id = $data['class_id'];
    } else {
      $this->db->insert('classes');
      $id = $this->db->insert_id();
    }

    $status = $this->db->affected_rows();
    return ($status == 0) ? FALSE : $id;
  }

  // Delete to database
  function delete($id) {
    $this->db->set('class_is_deleted', 1);
    $this->db->where('class_id', $id);
    $this->db->update('classes');
  }

}
