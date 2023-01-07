<?php
/**
 * Created by PhpStorm.
 * User: sankester
 * Date: 11/05/2017
 * Time: 15:43
 */

if (!defined('BASEPATH')) exit('No direct script access allowed');

class Rangking extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('MKriteria');
        $this->load->model('MNilai');
        $this->load->model('MKaryawan');
        $this->load->model('MSAW');
    }

    public function index()
    {
        $karyawan = $this->MKaryawan->getAll();
        $data['karyawan'] = $karyawan;


        if($karyawan == null){
            redirect('user');
        }
        /**
         * Menghapus table SAW jika ada
         */
        $this->MSAW->dropTable();

        /**
         * $kriteria data dari table kriteria
         */
        $data['kriteria'] = $this->MKriteria->getAll();
        $kriteria = $this->MKriteria->getAll();

        /**
         * membuat table SAW berdasarkan data dari table kriteria
         * menginputkan semua data nilai
         */
        $data['tb_kriteria'] = $this->MSAW->createTable($kriteria);
        
        
        
        
        // $fields = array(
        //     'Karyawan VARCHAR(120) not null'
        // );

        // foreach ($kriteria as $item => $value) {
        //     $fields[] = $value->nama_kriteria.' DECIMAL(13,2) not null ';
        // }
        // $data['fields'] = $fields;

        // $nilai = $this->MNilai->getNilaiKaryawan();

        // $dataInput = array();
        // $no = 0;
        // foreach ($karyawan as $item => $itemKaryawan) {
        //     foreach ($nilai as $index => $itemNilai) {
        //         if ($itemKaryawan->nip == $itemNilai->nip) {
        //             $dataInput[$no]['karyawan'] = $itemKaryawan->nama_karyawan;
        //             $dataInput[$no][$itemNilai->nama_kriteria] = $itemNilai->nilai;
        //         }
        //     }
        //     $no++;
        // }
        // $data['fields'] = $dataInput;
        // // $data['fields'] = $nilai;

        /**
         * Ambil data dari table SAW untuk perhitungan awal
         */
        $data['table1'] = $this->initialTableSAW($karyawan);


        /**
         * mengambil sifat kriteria
         * @var $dataSifat array
         */
        $dataSifat = $this->getDataSifat();
        $data['dataSifat'] = $dataSifat;

        /**
         * Mengambil nilai maksimal dan minimal berdasarkan sifat
         */
        $dataValueMinMax = $this->getVlueMinMax($dataSifat);
        $data['dataValueMinMax'] = $dataValueMinMax;

        /**
         * Proses 1 ubah data berdasarkan sifat
         */

        $table2 = $this->getCountBySifat($dataSifat,$dataValueMinMax);
        $data['table2'] = $table2;

        /**
         * Hitung perkalian bobot dengan nilai kriteria
         */
        $bobot = $this->MKriteria->getBobotKriteria();
        // $this->page->setData('bobot', $bobot);
        $data['bobot'] = $bobot;
        $table3 = $this->getCountByBobot($bobot);
        $data['table3'] = $table3;

        // /**
        //  * Add kolom total dan rangking
        //  */
        $this->MSAW->addColumnTotalRangking();

        // /**
        //  * Menghitung nilai total
        //  */
        $this->countTotal();

        // /**
        //  * Mengambil data yang sudah di rangking
        //  */
        $tableFinal = $this->getDataRangking();
        $data['tableFinal'] = $tableFinal;
        // $this->page->setData('tableFinal', $tableFinal);

        /**
         * Menghapus table SAW
         */
        $this->MSAW->dropTable();

        $data['title'] = "HITUNG DATA";
        $data['username'] = $this->session->userdata('username');
        $data['role'] = $this->session->userdata('role');
		$this->load->view('templates/user_header', $data) ;
		$this->load->view('user/hitung') ;
		$this->load->view('templates/user_footer') ;
    }

    public function noData()
    {
        loadPage('saw/noData');
    }
    private function initialTableSAW($karyawan)
    {
        $nilai = $this->MNilai->getNilaiKaryawan();

        $dataInput = array();
        $no = 0;
        foreach ($karyawan as $item => $itemKaryawan) {
            foreach ($nilai as $index => $itemNilai) {
                if ($itemKaryawan->nip == $itemNilai->nip) {
                    $dataInput[$no]['karyawan'] = $itemKaryawan->nama_karyawan;
                    $dataInput[$no][$itemNilai->nama_kriteria] = $itemNilai->nilai;
                }
            }
            $no++;
        }

        foreach ($dataInput as $data => $item){
            $this->MSAW->insert($item);
        }
        return $this->MSAW->getAll();
    }

    private function getDataSifat()
    {
        $sawData = $this->MSAW->getAll();
        $dataSifat = array();
        foreach ($sawData as $item => $value) {
            foreach ($value as $x => $z) {
                if ($x == 'Karyawan') {
                    continue;
                }
                $dataSifat[$x] = $this->MSAW->getStatus($x);
            }
        }
        return $dataSifat;
    }

    private function getVlueMinMax($dataSifat)
    {
        $sawData = $this->MSAW->getAll();
        $dataValueMinMax = array();
        foreach ($sawData as $point => $value) {
            foreach ($value as $x => $z) {
                if ($x == 'Karyawan') {
                    continue;
                }
                foreach ($dataSifat as $item => $itemX) {
                    if ($x == $item) {

                        if ($x == $item && $itemX->jenis_kriteria == 'Benefit') {
                            if (!isset($dataValueMinMax['max' . $x])) {
                                $dataValueMinMax['kriteria'.$x] = $x;
                                $dataValueMinMax['max' . $x] = $z;
                                $dataValueMinMax['sifat' . $x] = 'Benefit';
                            } elseif ($z > $dataValueMinMax['max' . $x]) {
                                $dataValueMinMax['max' . $x] = $z;
                            }
                        } else {
                            if (!isset($dataValueMinMax['min' . $x])) {
                                $dataValueMinMax['kriteria'.$x] = $x;
                                $dataValueMinMax['min' . $x] = $z;
                                $dataValueMinMax['sifat' . $x] = 'Cost';
                            } elseif ($z < $dataValueMinMax['min' . $x]) {
                                $dataValueMinMax['min' . $x] = $z;
                            }
                        }
                    }
                }
            }
        }

        return $dataValueMinMax;
    }

    // private function getVlueMinMax($dataSifat)
    // {
    //     $sawData = $this->MSAW->getAll();
    //     $dataValueMinMax = array();
    //     foreach ($sawData as $point => $value) {
    //         foreach ($value as $x => $z) {
    //             if ($x == 'Karyawan') {
    //                 continue;
    //             }
    //             foreach ($dataSifat as $item => $itemX) {
    //                 if ($x == $item) {

    //                     if ($x == $item && $itemX->jenis_kriteria == 'Benefit') {
    //                         if (!isset($dataValueMinMax['max' . $x])) {
    //                             $dataValueMinMax['kriteria'.$x] = $x;
    //                             $dataValueMinMax['max' . $x] = $z;
    //                             $dataValueMinMax['sifat' . $x] = 'Benefit';
    //                         } elseif ($z > $dataValueMinMax['max' . $x]) {
    //                             $dataValueMinMax['max' . $x] = $z;
    //                         }
    //                     } else {
    //                         if (!isset($dataValueMinMax['min' . $x])) {
    //                             $dataValueMinMax['kriteria'.$x] = $x;
    //                             if ($z !== "0.00"){
    //                                 $dataValueMinMax['min' . $x] = $z;                                    
    //                             }
    //                             $dataValueMinMax['sifat' . $x] = 'Cost';
    //                         } elseif ($z < $dataValueMinMax['min' . $x] and $z !== "0.00") {
    //                             $dataValueMinMax['min' . $x] = $z;
    //                         }
    //                     }
    //                 }
    //             }
    //         }
    //     }

    //     return $dataValueMinMax;
    // }

    private function getCountBySifat($dataSifat, $dataValueMinMax)
    {
        $sawData = $this->MSAW->getAll();
        foreach ($sawData as $point => $value) {
            foreach ($value as $x => $z) {
                if ($x == 'Karyawan') {
                    continue;
                }
                foreach ($dataSifat as $item => $jenis_kriteria) {
                    if ($x == $item) {
                        if($jenis_kriteria->jenis_kriteria == 'Benefit'){

                            $newData = $z / $dataValueMinMax['max'.$x];
                            $dataUpdate = array(
                                $x => $newData
                            );
                            $where = array(

                                'Karyawan' => $value->Karyawan
                            );

                            $this->MSAW->update($dataUpdate, $where);
                        }else{
                            $newData = $dataValueMinMax['min'.$x] / $z ;
                            $dataUpdate = array(
                                $x => $newData
                            );
                            $where = array(

                                'Karyawan' => $value->Karyawan
                            );

                            $this->MSAW->update($dataUpdate, $where);
                        }
                    }
                }
            }
        }

        return $this->MSAW->getAll();
    }

    private function countTotal()
    {
        $sawData = $this->MSAW->getAll();

        foreach ($sawData as $item => $value) {
            $total = 0;
            foreach ($value as $item => $itemData) {
                if($item == 'Karyawan'){
                    continue;
                }elseif($item == 'Total'){
                    $dataUpdate = array(
                        'Total'=> $total
                    );

                    $where = array(
                        'Karyawan' => $value->Karyawan
                    );

                    $this->MSAW->update($dataUpdate, $where);
                }else{
                    $total = $total + $itemData;
                }
            }
        }
    }

    private function getCountByBobot($bobot)
    {

        $sawData = $this->MSAW->getAll();
        foreach ($sawData as $point => $value) {
            foreach ($value as $x => $z) {
                if ($x == 'Karyawan') {
                    continue;
                }
                foreach ($bobot as $item => $itemKriteria) {

                    if ($x == $itemKriteria->nama_kriteria) {

                        $sawData[$point]->$x =  $z * $itemKriteria->jumlah_bobot ;
                        $newData = $z * $itemKriteria->jumlah_bobot;
                        $dataUpdate = array(
                            $x => $newData
                        );
                        $where = array(
                            'Karyawan' => $value->Karyawan
                        );

                        $this->MSAW->update($dataUpdate, $where);

                    }
                }
            }
        }

        return $this->MSAW->getAll();
    }

    private function getDataRangking()
    {
        $sawData = $this->MSAW->getSortTotalByDesc();
        $no = 1;
        foreach ($sawData as $item => $value) {
            $dataUpdate = array(
                'Rangking' => $no
            );
            $where = array(
                'Karyawan' => $value->Karyawan
            );

            $this->MSAW->update($dataUpdate, $where);
            $no++;
        }
        return $this->MSAW->getAllAsc();
    }


}