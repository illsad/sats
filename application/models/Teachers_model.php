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
class Teachers_model extends CI_Model {

    function __construct() {
        parent::__construct();
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
