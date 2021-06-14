<?php 
defined('BASEPATH') OR exit('No direct script allowed');

class User_model extends CI_Model {
    public function get_all_data($database, $query) {
        $default = 'master';
        if ($database == $default) {
            $result = $this->db->query($query);

            $this->db->close();
        } else {
            $db = $this->load->database($database, TRUE);
            $result = $db->query($query);
            $db->close();
        }

        return $result;
    }
}

?>