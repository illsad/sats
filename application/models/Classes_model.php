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

    function __construct() {
        parent::__construct();
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
            class_years, class_is_deleted, user_user_id, 
            user.user_full_name, 
            class_input_date, class_last_update');
        $this->db->join('user', 'user.user_id = classes.user_user_id', 'left');
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

        if (isset($data['teacher_name'])) {
            $this->db->set('teacher_name', $data['teacher_name']);
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
