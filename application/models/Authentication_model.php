<?php

class authentication_model extends CI_Model {

    public function login($params) {
        $username = $params->username;
        $password = $params->password;
        $sql = $this->db->select('*')->from('tb_akun')
                ->where('username', $username)
                ->where('password', $password);
        $query = $this->db->get();
        $count = $query->num_rows();
        $rows = $query->row();
        if ($query == TRUE) {
            if ($count < 1) {
                $response = FAIL_STATUS;
                $data = array("response" => $response, "results" => $this->db->last_query());
            } else {
                if ($rows != "") {
                    $response = OK_STATUS;
                    $data = array("response" => $response, "results" => $rows);
                } else {
                    $response = FAIL_STATUS;
                    $data = array("response" => $response, "results" => $rows);
                }
            }
        } else {
            $response = FAIL_STATUS;
            $data = array("response" => $response, "results" => $rows);
        }
        return $data;
    }

}
