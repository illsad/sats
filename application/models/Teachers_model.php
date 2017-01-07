<?php

if (!defined('BASEPATH'))
exit('No direct script access allowed');

/**
* Teachers Model Class
*
* @package     SYSCMS
* @subpackage  Models
* @category    Models
* @author      Sistiandy Syahbana nugraha <sistiandy.web.id>
*/
class Teachers_model extends CI_Model {

  var $table = 'teachers';
  var $all_column = array('teachers.teacher_id', 'teacher_nip', 'teacher_name',
  'user_user_id',
  'teacher_input_date', 'teacher_last_update'); //set all column field database
  var $order = array('teacher_last_update' => 'desc'); // default order

  function __construct() {
    parent::__construct();
  }

  private function _get_datatables_query() {

    $this->db->from($this->table);
    $this->db->where('teacher_is_deleted', FALSE);

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

    $this->db->select('teachers.teacher_id, teacher_nip, teacher_name,
    user_user_id,
    teacher_input_date, teacher_last_update');
    $this->db->select('user.user_full_name');
    $this->db->join('user', 'user.user_id = teachers.user_user_id', 'left');
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
      $this->db->where('teachers.teacher_id', $params['id']);
    }
    $this->db->where('teacher_is_deleted', FALSE);

    if (isset($params['limit'])) {
      if (!isset($params['offset'])) {
        $params['offset'] = NULL;
      }

      $this->db->limit($params['limit'], $params['offset']);
    }

    if (isset($params['order_by'])) {
      $this->db->order_by($params['order_by'], 'desc');
    } else {
      $this->db->order_by('teacher_last_update', 'desc');
    }

    $this->db->select('teachers.teacher_id, teacher_nip, teacher_name,
    user_user_id,
    teacher_input_date, teacher_last_update');
    $this->db->select('user.user_full_name');
    $this->db->join('user', 'user.user_id = teachers.user_user_id', 'left');
    $res = $this->db->get('teachers');

    if (isset($params['id'])) {
      return $res->row_array();
    } else {
      return $res->result_array();
    }
  }

  // Add and update to database
  function add($data = array()) {

    if (isset($data['teacher_id'])) {
      $this->db->set('teacher_id', $data['teacher_id']);
    }

    if (isset($data['teacher_nip'])) {
      $this->db->set('teacher_nip', $data['teacher_nip']);
    }

    if (isset($data['teacher_name'])) {
      $this->db->set('teacher_name', $data['teacher_name']);
    }

    if (isset($data['teacher_is_deleted'])) {
      $this->db->set('teacher_is_deleted', $data['teacher_is_deleted']);
    }

    if (isset($data['teacher_input_date'])) {
      $this->db->set('teacher_input_date', $data['teacher_input_date']);
    }

    if (isset($data['teacher_last_update'])) {
      $this->db->set('teacher_last_update', $data['teacher_last_update']);
    }
    if (isset($data['user_user_id'])) {
      $this->db->set('user_user_id', $data['user_user_id']);
    }

    if (isset($data['teacher_id'])) {
      $this->db->where('teacher_id', $data['teacher_id']);
      $this->db->update('teachers');
      $id = $data['teacher_id'];
    } else {
      $this->db->insert('teachers');
      $id = $this->db->insert_id();
    }

    $status = $this->db->affected_rows();
    return ($status == 0) ? FALSE : $id;
  }

  // Delete to database
  function delete($id) {
    $this->db->set('teacher_is_deleted', 1);
    $this->db->where('teacher_id', $id);
    $this->db->update('teachers');
  }

}
