<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of ContactModel
 *
 * @author https://roytuts.com
 */
class UserModel extends CI_Model {

    private $User = 'users';

    function get_user_list() {
        $query = $this->db->get($this->User);
        if ($query) {
            return $query->result();
        }
        return NULL;
    }

    function get_user($id) {
        $query = $this->db->get_where($this->User, array("u_id" => $id));
        if ($query) {
            return $query->row();
        }
        return NULL;
    }

    function add_user($user_name, $user_email) {
        $data = array('u_name' => $user_name, 'u_email' => $user_email);
        $this->db->insert($this->User, $data);
    }

    function add_bulk_user($user_array) {
        $query = "insert into users(u_name,u_email) values ";
        
        $str = "";
        foreach($user_array as $key => $user){
            $str .= '("'.$user['u_name'].'","'.$user["u_email"].'"),';
        }
        
        echo $query = $this->db->query($query.trim($str,","));
        if ($query) {
            return true;
        }
        return false;
    }
}