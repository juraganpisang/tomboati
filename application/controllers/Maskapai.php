<?php
class Maskapai extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('form');
        $this->load->helper('url');
        $this->load->helper('file');
        $this->load->library('table');
        $this->load->library('upload');
        
    }

    public function index()
    {
        $dataMaskapai = $this->MMaskapai->getMaskapai();

        // echo $this->db->last_query();
        //parse
        $data = array(
            'title' => 'Maskapai | Tombo Ati',
            'maskapai' => $dataMaskapai);

        $this->template->load('template/template', 'maskapai/VMaskapai', $data);
        $this->load->view("template/script.php");
    }

    public function tambahMaskapai()
    {
        $data = array('title' => 'Tambah Maskapai | Tombo Ati');
        $this->template->load('template/template', 'maskapai/VTambahMaskapai', $data);
        $this->load->view("template/script.php");
    }

    public function aksiTambahMaskapai(){

        $imageMaskapai = $this->upload_image();
        $data = array(
            'NAMAMASKAPAI' => $this->input->post('namaMaskapai'),
            'IMAGEMASKAPAI' => $imageMaskapai
        );
        // var_dump($data);

        $this->MMaskapai->saveMaskapai($data);

        //alert ketika sudah tersimpan
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> Maskapai berhasil ditambahkan! </div>');
        
        redirect('maskapai');
    }

    public function editMaskapai($idMaskapai)
    {
        $dataMaskapai = $this->MMaskapai->getSelectMaskapai($idMaskapai);

        $data = array(
            'title' => 'Edit Maskapai | Tombo Ati',
            'maskapai' => $dataMaskapai
        );

        $this->template->load('template/template', 'maskapai/VEditMaskapai', $data);
        $this->load->view("template/script.php");
    }

    public function aksiEditMaskapai($idMaskapai){
        
        //mendapatkan data yang diedit
        $dataMaskapai = $this->MMaskapai->getSelectMaskapai($idMaskapai);

        //melakukan pengecekan file
        if (empty($_FILES['imageMaskapai']['name'])){
            $imageMaskapai = $dataMaskapai[0]['IMAGEMASKAPAI'];
        }
        else{
            // delete_files($dataPaket[0]['IMAGEPAKET']); 
            // unlink($dataPaket[0]['IMAGEPAKET']);die;     
             $imageMaskapai = $this->upload_image()  ;
        }

        $data = array(
            'IDMASKAPAI' => $idMaskapai,
            'NAMAMASKAPAI' => $this->input->post('namaMaskapai'),
            'IMAGEMASKAPAI' => $imageMaskapai
        );
        // var_dump($data);

        $this->MMaskapai->updateMaskapai($data);

        //alert ketika sudah tersimpan
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> Maskapai berhasil diperbarui! </div>');

        redirect('maskapai');
    }

    public function aksiHapusMaskapai($idMaskapai)
    {
        //delete
        $this->MMaskapai->deleteMaskapai($idMaskapai);
        
        //alert ketika sudah terhapus
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> Maskapai berhasil dihapus! </div>');

        redirect('Maskapai');
    }

    function upload_image(){
        $config['upload_path'] = './images/maskapai/'; //path folder
        $config['allowed_types'] = 'gif|jpg|png|jpeg|bmp'; //type yang dapat diakses bisa anda sesuaikan
        $config['encrypt_name'] = TRUE; //Enkripsi nama yang terupload
 
        $this->upload->initialize($config);
        if(!empty($_FILES['imageMaskapai']['name'])){
 
            if ($this->upload->do_upload('imageMaskapai')){
                $gbr = $this->upload->data();
                //Compress Image
                $config['image_library']='gd2';
                $config['source_image']='./images/maskapai/'.$gbr['file_name'];
                $config['create_thumb']= FALSE;
                $config['maintain_ratio']= true;
                // $config['quality']= '100%';
                $config['width']= 600;
                // $config['height']= 400;
                $config['new_image']= './images/maskapai/'.$gbr['file_name'];
                $this->load->library('image_lib', $config);
                $this->image_lib->resize();
 
                $gambar=$gbr['file_name'];

                return base_url('images/maskapai/'.$gambar);
            }
                      
        }else{
            return base_url('images/maskapai/default.png');
        }         
    }
}