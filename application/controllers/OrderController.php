<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require_once 'Format.php';
require_once 'RestController.php';

use chriskacerguis\RestServer\RestController;

/**
 * Description of RestGetController
 *
 * @author https://roytuts.com
 */
class OrderController extends RestController {
	
	function __construct() {
        parent::__construct();
		$this->load->model('OrderModel', 'cm');
    }

    function orders_get() {
        $orders = $this->cm->get_order_list();

        if ($users) {
            $this->response($orders, 200);
        } else {
            $this->response(NULL, 404);
        }
    }

    function order_get() {
        if (!$this->get('id')) {
            $this->response(NULL, 400);
        }

        $order = $this->cm->get_order($this->get('id'));

        if ($order) {
            $this->response($order, 200); 
        } else {
            $this->response(NULL, 404);
        }
    }

    function pickup_by_user_get() {
        if (!$this->get('id')) {
            $this->response(NULL, 400);
        }

        $order = $this->cm->get_pickup_by_user($this->get('id'));

        if ($order) {
            $this->response($order, 200); 
        } else {
            $this->response(NULL, 404);
        }
    }

    function pickup_by_date_get() {
        if (!$this->get('date')) {
            $this->response(NULL, 400);
        }

        $order = $this->cm->get_pickup_by_date($this->get('date'));

        if ($order) {
            $this->response($order, 200); 
        } else {
            $this->response(NULL, 404);
        }
    }


    function add_order_post() {
        $order_name = $this->post('o_pickup_date');
        $order_email = $this->post('o_fk_u_id');
        
        $result = $this->cm->add_order($order_name, $order_email);

        if ($result === FALSE) {
            $this->response(array('status' => 'failed'));
        } else {
            $this->response(array('status' => 'success'));
        }
    }

    function update_order_post(){
        $orderid = $this->post('o_id');
        $newdate = $this->post('o_pickup_date');
        $result =  $this->cm->update_order($orderid, $newdate);

        if ($result === FALSE) {
            $this->response(array('status' => 'failed'));
        } else {
            $this->response(array('status' => 'success'));
        }
    }

    function add_bulk_order_post() {
        $data = $this->post('order_data');
        $result = $this->cm->add_bulk_order($data);

        if ($result === FALSE) {
            $this->response(array('status' => 'failed'));
        } else {
            $this->response(array('status' => 'success'));
        }
    }

    function delete_order_delete() {
        $order_id = $this->post('order_id');
        $result = $this->cm->delete_order($order_id);

        if ($result === FALSE) {
            $this->response(array('status' => 'failed'));
        } else {
            $this->response(array('status' => 'success'));
        }
    }
}