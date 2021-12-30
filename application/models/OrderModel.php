<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of ContactModel
 *
 * @author https://roytuts.com
 */
class OrderModel extends CI_Model {

    private $Order = 'orders';

    function get_order_list() {
        $query = $this->db->get($this->Order);
        if ($query) {
            return $query->result();
        }
        return NULL;
    }

    function get_order($id) {
        $query = $this->db->get_where($this->Order, array("o_id" => $id));
        if ($query) {
            return $query->row();
        }
        return NULL;
    }

    function add_order($o_pickup_date, $user_id) {
        $data = array('o_pickup_date' => $o_pickup_date, 'o_fk_u_id' => $user_id);
        $this->db->insert($this->Order, $data);
    }

    function get_pickup_by_date($date){
        $sql = "select * from orders where o_pickup_date like ?";
        $query = $this->db->query($sql,$date."%");
        if ($query) {
            $res = $query->result();
            return $res;
        }
        return NULL;
    }

    function get_pickup_by_user($userid){
        $sql = "select * from orders where o_fk_u_id = ?";
        $query = $this->db->query($sql,$userid);
        if ($query) {
            return $query->result();
        }
        return NULL;
    }

    function update_order($orderid,$newdate){
        $sql = "update orders set o_pickup_date = ? where o_id = ?";
        $query = $this->db->query($sql,array($newdate,$orderid));
        if ($query) {
            return true;
        }
        return false;
    }

    function add_bulk_order($order_array) {
        $query = "insert into orders(o_pickup_date,o_fk_u_id) values ";
        
        $str = "";
        foreach($order_array as $key => $order){
            $str .= '("'.$order['pickup_date'].'","'.$order["u_id"].'"),';
        }
        
        $query = $this->db->query($query.trim($str,","));
        if ($query) {
            return true;
        }
        return false;
    }

    function delete_order($order_id) {
        $query = "delete from orders where o_id = ?";
        $query = $this->db->query($query,$order_id);
        if ($query) {
            return true;
        }
        return false;
    }
}