<?php

class RyanMotor_model extends CI_Model
{
    public function getRyanMotor($nama = null)
    {
        if ($nama === null) {
            return $this->db->get('sewamotor')->result_array();
        } else {
            return $this->db->get_where('sewamotor', ['nama' => $nama])->result_array();
        }
    }

    public function deleteRyanMotor($nama)
    {
        $this->db->delete('sewamotor', ['nama' => $nama]);
        return $this->db->affected_rows();
    }

    public function createRyanMotor($data)
    {
        $this->db->insert('sewamotor', $data);
        return $this->db->affected_rows();
    }

    public function updateRyanMotor($data, $nama)
    {
        $this->db->update('sewamotor', $data, ['nama' => $nama]);
        return $this->db->affected_rows();
    }
}
