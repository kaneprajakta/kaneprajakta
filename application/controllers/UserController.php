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
class UserController extends RestController {
	
	function __construct() {
        parent::__construct();
		$this->load->model('UserModel', 'cm');
    }

    function users_get() {
        $users = $this->cm->get_user_list();

        if ($users) {
            $this->response($users, 200);
        } else {
            $this->response(NULL, 404);
        }
    }

    function user_get() {
        if (!$this->get('id')) {
            $this->response(NULL, 400);
        }

        $user = $this->cm->get_user($this->get('id'));

        if ($user) {
            $this->response($user, 200); // 200 being the HTTP response code
        } else {
            $this->response(NULL, 404);
        }
    }

    function add_user_post() {
        $user_name = $this->post('u_name');
        $user_email = $this->post('u_email');
        
        $result = $this->cm->add_user($user_name, $user_email);

        if ($result === FALSE) {
            $this->response(array('status' => 'failed'));
        } else {
            $this->response(array('status' => 'success'));
        }
    }

    function add_bulk_user_post() {
        $data = $this->post('user_data');
        $result = $this->cm->add_bulk_user($data);

        if ($result === FALSE) {
            $this->response(array('status' => 'failed'));
        } else {
            $this->response(array('status' => 'success'));
        }
    }
}