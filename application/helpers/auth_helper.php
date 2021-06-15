<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

if (!function_exists('master_auth')) {
    /**
    * @param param->array
    * @param database
    * @param default_database
    */
    function master_auth($param) {
        //get password on db 
        /**
         * field param 
         * user, password, query, database, database_db
         */
        $user       = $param['user'];
        $password   = $param['password'];
        $query      = $param['query'];
        $database   = $param['database'];
        $default_db = $param['default_db'];

        $CI =& get_instance();

        //load database 
        if ($default_db == $database) {
            $result = $CI->db->query($query);

            if ($result->num_rows() > 0) {
                foreach ($result->result() as $row) {
                    $pass = $row->password;
                    $role = $row->role;

                    if ($pass == md5($password)) {
                        //define role 
                        $authoriz = $CI->db->query("SELECT name, access
                                                            FROM authorization
                                                            WHERE role = $role")->row_array();

                        switch ($$authoriz) {
                            case '1':
                                $auth = 'Admin';
                                break;

                            case '2':
                                $auth = 'User';
                            
                            default:
                                $auth = 'User';
                                break;
                        }

                        //set session
                        $sess['user'] = $user;
                        $sess['is_active'] = true;
                        $sess['role'] = $role;

                        $CI->sess->set_session($sess);

                        return true;
                    } else {
                        $message = 'password salah';

                        return $message;
                    }
                }
            } else {
                $message = 'user salah';

                return $message;
            }
        }
    }
}
 
 
?>