<?php 
defined("BASEPATH") OR exit('No direct script allowrd');

class Authentification {
    public function __construct() {
        $this->CI =& get_instance();

        $this->CI->load->model('User_model', 'database');
    }

    public function auth($param) {
        $user = $param['user'];
        $pass = $param['password'];

        $query = "SELECT name, email, id 
                        FROM user";
        $result = $this->CI->database->get_all_data('master', $query);

        if ($result->num_rows() > 0) {
            foreach ($result->result() as $row) {
                $name[] = $row->name;
                $id[] = $row->id;
            }

            $key = array_search($user, $name);
            $userId = $id[$key];
            $search = $this->CI->database->get_all_data('master', "SELECT name, email, password, role FROM user WHERE id = $userId")->row_array();

            $passDb = $search['password'];
            $role = $search['role'];
            if ($pass == $passDb) {
                //set session 
                $param['user'] = $user;
                $param['is_active'] = true;
                $param['role'] = $role;
                
                //set session
                $this->CI->sess->set_session($param);

                $this->CI->set_view();
            }
        }

        return $search;
    }
}
?>