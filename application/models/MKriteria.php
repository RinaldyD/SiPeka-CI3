<?php

/**
 * Created by PhpStorm.
 * User: sankester
 * Date: 11/05/2017
 * Time: 15:53
 */
class MKriteria extends CI_Model{

    public $kdKriteria;
    public $kriteria;
    public $sifat;
    public $bobot;

    public function __construct(){
        parent::__construct();
    }

    private function getData(){
        $data = array(
            'kriteria' => $this->kriteria,
            'sifat' => $this->sifat,
            'bobot' => $this->bobot
        );
        return $data;
    }

    public function getAll()
    {
        $this->db->select('kriteria.id AS `id`, kriteria.nama_kriteria, kriteria.jenis_kriteria AS `sifat`, bobot.jumlah_bobot AS `bobot`');
        $this->db->from('kriteria');
        $this->db->join('bobot', 'kriteria.id = bobot.id_kriteria','left');
        $query = $this->db->get();
        // $query = $this->db->get($this->getTable());
        if($query->num_rows() > 0){
            foreach ( $query->result() as $row) {
                $kriterias[] = $row;
            }
            return $kriterias;
        }
    }

    public function getById()
    {

        $this->db->from($this->getTable());
        $this->db->where('kdKriteria',$this->kdKriteria);
        $query = $this->db->get();

        return $query->row();
    }

    public function insert()
    {
        $this->db->insert($this->getTable(), $this->getData());
        return $this->db->insert_id();
    }

    public function update($where)
    {
        $this->db->update($this->getTable(), $this->getData(), $where);
        return $this->db->affected_rows();
    }

    public function delete($id)
    {
        $this->db->where('kdKriteria', $id);
        return $this->db->delete($this->getTable());
    }

    public function getLastID(){
        $this->db->select('kdKriteria');
        $this->db->order_by('kdKriteria', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get($this->getTable());
        return $query->row();
    }

    public function getBobotKriteria()
    {
        $query = $this->db->query('select kriteria.nama_kriteria, bobot.jumlah_bobot from kriteria LEFT JOIN bobot on kriteria.id = bobot.id_kriteria');
        if($query->num_rows() > 0){
            foreach ( $query->result() as $row) {
                $bobot[] = $row;
            }
            return $bobot;
        }
    }
}