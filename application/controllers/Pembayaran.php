<?php
class Pembayaran extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('form');
        $this->load->helper('url');
        $this->load->library('table');
        date_default_timezone_set('Asia/Jakarta');
        $this->load->model('MNotifikasi');
    }
    public function index()
    {
        //notifikasi
        $countMessage    = $this->MNotifikasi->countMessage();
        $dataNotifChat   = $this->MNotifikasi->dataNotifChat();

        $data = array(
            'title' => 'Pembayaran | Tombo Ati',
            'countMessage' => $countMessage,
            'dataNotifChat' => $dataNotifChat
        );
        $this->template->load('template/template', 'pembayaran/VPembayaran', $data);
        $this->load->view("template/script.php"); 
    }
}
