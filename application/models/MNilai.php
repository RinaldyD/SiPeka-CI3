<?php

/**
 * Created by PhpStorm.
 * User: sankester
 * Date: 11/05/2017
 * Time: 15:53
 */
class MNilai extends CI_Model{

    public $kdUniversitas;
    public $kdKriteria;
    public $nilai;

    public function __construct(){
        parent::__construct();
    }

    private function getTable()
    {
        return 'nilai';
    }

    private function getData()
    {
        $data = array(
            'kdUniversitas' => $this->kdUniversitas,
            'kdKriteria' => $this->kdKriteria,
            'nilai' => $this->nilai
        );

        return $data;
    }

    public function insert()
    {
        $status = $this->db->insert($this->getTable(), $this->getData());
        return $status;
    }

    public function getNilaiByUniveristas($id)
    {
        $query = $this->db->query(
            'select u.kdUniversitas, u.universitas, k.kdKriteria, n.nilai from universitas u, nilai n, kriteria k, subkriteria sk where u.kdUniversitas = n.kdUniversitas AND k.kdKriteria = n.kdKriteria and k.kdKriteria = sk.kdKriteria and u.kdUniversitas = '.$id.' GROUP by n.nilai '
        );
        if($query->num_rows() > 0){
            foreach ($query->result() as $row) {
                $nilai[] = $row;
            }

            return $nilai;
        }
    }

    public function getNilaiKaryawan()
    {
        $query = $this->db->query(
            'SELECT karyawan.id, karyawan.nip, karyawan.nama_karyawan, kriteria.id, kriteria.nama_kriteria, nilai.nilai from karyawan LEFT JOIN nilai on karyawan.nip = nilai.nip LEFT JOIN kriteria on nilai.id_kriteria = kriteria.id'
        );
        if($query->num_rows() > 0){
            foreach ($query->result() as $row) {
                $nilai[] = $row;
            }

            return $nilai;
        }
    }

    public function update()
    {
        $data = array('nilai' => $this->nilai);
        $this->db->where('kdUniversitas', $this->kdUniversitas);
        $this->db->where('kdKriteria', $this->kdKriteria);
        $this->db->update($this->getTable(), $data);
        return $this->db->affected_rows();
    }

    public function delete($id)
    {
        $this->db->where('kdUniversitas', $id);
        return $this->db->delete($this->getTable());
    }
}