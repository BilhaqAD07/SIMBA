<?php
error_reporting(0);
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->helper('download');
        $this->load->library('pagination');
        $this->load->helper('cookie');
        $this->load->model('barang_model');
        $this->load->model('barangMasuk_model');
        $this->load->model('barangKeluar_model');
        $this->load->model('jenis_model');
      }

    public function barang_masuk_pdf()
    {
      $tglawal = $this->input->post('tglawal');
      $tglakhir = $this->input->post('tglakhir');
       $jenisFilter = $this->input->post('jenisFilter');
      if($tglawal != '' && $tglakhir != ''){
        $data['data'] = $this->barangMasuk_model->lapdata($tglawal, $tglakhir, $jenisFilter)->result();
      }
      else{
        $data['data'] = $this->barangMasuk_model->dataJoin()->result();
      }
      $data['jenis_barang'] = $this->jenis_model->data()->result(); 
      $data['tglawal'] = $tglawal;
      $data['tglakhir'] = $tglakhir;
       $data['jenisFilter'] = $jenisFilter;

      $data['judul'] = 'Laporan Barang Masuk';
      $mpdf = new \Mpdf\Mpdf();
      $html = $this->load->view('laporan/barang_masuk_pdf',$data,true);
      $mpdf->WriteHTML($html);
      $tgl = date('Ymd_his');
      $namaFile = 'Barang_masuk_'.$tgl.'.pdf';
      $mpdf->Output($namaFile, 'D');

    }

    public function barang_keluar_pdf()
    {
      $tglawal = $this->input->post('tglawal');
      $tglakhir = $this->input->post('tglakhir');
      $jenisFilter = $this->input->post('jenisFilter');
      if($tglawal != '' && $tglakhir != ''){
        $data['data'] = $this->barangKeluar_model->lapdata($tglawal, $tglakhir,$jenisFilter)->result();
      }
      else{
        $data['data'] = $this->barangKeluar_model->dataJoin()->result();
      }
      $data['jenis_barang'] = $this->jenis_model->data()->result(); 
      $data['tglawal'] = $tglawal;
      $data['tglakhir'] = $tglakhir;
      $data['jenisFilter'] = $jenisFilter;
      $data['judul'] = 'Laporan Barang Keluar';
      $mpdf = new \Mpdf\Mpdf();
      $html = $this->load->view('laporan/barang_keluar_pdf',$data,true);
      $mpdf->WriteHTML($html);
      $tgl = date('Ymd_his');
      $namaFile = 'Barang_keluar_'.$tgl.'.pdf';
      $mpdf->Output($namaFile, 'D');

    }


     public function barang_pdf()
    {
      $tglawal = $this->input->post('tglawal');
      $tglakhir = $this->input->post('tglakhir');
      $jenisFilter = $this->input->post('jenisFilter');
      if($tglawal != '' && $tglakhir != ''){
        $data['data'] = $this->barang_model->lapdata($tglawal, $tglakhir,$jenisFilter)->result();
      }
      else{
        $data['data'] = $this->barang_model->dataJoin()->result();
      }
      $data['jenis_barang'] = $this->jenis_model->data()->result(); 
      $data['tglawal'] = $tglawal;
      $data['tglakhir'] = $tglakhir;
      $data['jenisFilter'] = $jenisFilter;

      $data['judul'] = 'Laporan Stok Barang';
      $mpdf = new \Mpdf\Mpdf();
      $html = $this->load->view('laporan/barang_pdf',$data,true);
      $mpdf->WriteHTML($html);
      $tgl = date('Ymd_his');
      $namaFile = 'Barang_stok'.$tgl.'.pdf';
      $mpdf->Output($namaFile, 'D');

    }

    // Add this function to your Laporan controller
    public function barang_excel()
    {
        $tglawal2 = $this->input->post('tglawal2');
        $tglakhir2 = $this->input->post('tglakhir2');
        $jenisFilter2 = $this->input->post('jenisFilter2');

        if ($tglawal2 != '' && $tglakhir2 != '') {
            $data['data'] = $this->barang_model->lapdata($tglawal2, $tglakhir2, $jenisFilter2)->result();
        } else {
            $data['data'] = $this->barang_model->dataJoin()->result();
        }
        $data['jenis_barang'] = $this->jenis_model->data()->result(); 
        $data['tglawal2'] = $tglawal2;
        $data['tglakhir2'] = $tglakhir2;
        $data['jenisFilter2'] = $jenisFilter2;

        $this->load->view('laporan/barang_excel', $data);
    }

    public function barang_masuk_excel()
    {
         $tglawal2 = $this->input->post('tglawal2');
        $tglakhir2 = $this->input->post('tglakhir2');
        $jenisFilter2 = $this->input->post('jenisFilter2');

        if ($tglawal2 != '' && $tglakhir2 != '') {
            $data['data'] = $this->barangMasuk_model->lapdata($tglawal2, $tglakhir2, $jenisFilter2)->result();
        } else {
            $data['data'] = $this->barangMasuk_model->dataJoin()->result();
        }
        $data['jenis_barang'] = $this->jenis_model->data()->result(); 
        $data['tglawal2'] = $tglawal2;
        $data['tglakhir2'] = $tglakhir2;
        $data['jenisFilter2'] = $jenisFilter2;

        $this->load->view('laporan/barang_masuk_excel', $data);
    }

    public function barang_keluar_excel()
    {
         $tglawal2 = $this->input->post('tglawal2');
        $tglakhir2 = $this->input->post('tglakhir2');
        $jenisFilter2 = $this->input->post('jenisFilter2');

        if ($tglawal2 != '' && $tglakhir2 != '') {
            $data['data'] = $this->barangKeluar_model->lapdata($tglawal2, $tglakhir2, $jenisFilter2)->result();
        } else {
            $data['data'] = $this->barangKeluar_model->dataJoin()->result();
        }
        $data['jenis_barang'] = $this->jenis_model->data()->result(); 
        $data['tglawal2'] = $tglawal2;
        $data['tglakhir2'] = $tglakhir2;
        $data['jenisFilter2'] = $jenisFilter2;

        $this->load->view('laporan/barang_keluar_excel', $data);
    }






}