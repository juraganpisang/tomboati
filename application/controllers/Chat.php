<?php
class Chat extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
        $this->load->helper('form');
        $this->load->helper('url');
        $this->load->model('MChat');
        $this->load->model('MNotifikasi');
        $this->load->library(array('upload', 'table'));
    }

    public function index()
    {
        $dataChat               = $this->MChat->getChat();
        $countMessage           = $this->MNotifikasi->countMessage();
        $dataNotifChat          = $this->MNotifikasi->dataNotifChat();
        $countMessageNotSeen    = $this->MChat->getMessageNotSeen();

        $data = array(
            'title'                 => 'Chat | Tombo Ati',
            'chat'                  => $dataChat,
            'countMessage'          => $countMessage,
            'dataNotifChat'         => $dataNotifChat,
            'countMessageNotSeen'   => $countMessageNotSeen
        );

        $this->template->load('template/template', 'chat/VChat', $data);
        $this->load->view("template/script.php");
    }

    public function detailChat($idChatRoom)
    {
        $detailDataChat = $this->MChat->getDetailChat($idChatRoom);
        $chatFrom       = $this->MChat->getChatFrom($idChatRoom);
        $countMessage   = $this->MNotifikasi->countMessage();
        $dataNotifChat   = $this->MNotifikasi->dataNotifChat();
        $isSeen      = 1;

        $data = array(
            'title'     => 'Detail Chat | Tombo Ati',
            'chat'      => $detailDataChat,
            'chatFrom'  => $chatFrom,
            'countMessage' => $countMessage,
            'dataNotifChat' => $dataNotifChat
        );
        
        $where = array(
            'ISSEEN' => $isSeen
        );

        $this->MChat->updateSeen($where, $idChatRoom);
        $this->template->load('template/template', 'chat/DetailChat', $data);
        $this->load->view("template/script.php");
    }

    public function detailChatNotif($idChatRoom)
    {
        $detailDataChat = $this->MChat->getDetailChat($idChatRoom);
        $chatFrom       = $this->MChat->getChatFrom($idChatRoom);
        
        $countMessage   = $this->MNotifikasi->countMessage();
        $dataNotifChat   = $this->MNotifikasi->dataNotifChat();

        $seenAt      = date('Y-m-d H:i:s');
        $isSeen      = 1;
        
        $data = array(
            'title'     => 'Detail Chat | Tombo Ati',
            'chat'      => $detailDataChat,
            'chatFrom'  => $chatFrom,
            'countMessage' => $countMessage,
            'dataNotifChat' => $dataNotifChat
        );

        $where = array(
            'SEENAT' => $seenAt,
            'ISSEEN' => $isSeen
        );

        $this->MChat->updateSeen($where, $idChatRoom);

        $this->template->load('template/template', 'chat/DetailChat', $data);
        redirect('Chat/detailChat/'.$idChatRoom);
    }

    public function adminKirimPesan(){
        $idChatRoom     = $this->input->post('idChatRoom');
        $message        = $this->input->post('message');
        $token          = $this->input->post('userToken');
        $filenameImg    = null;

        $createdAt      = date('Y-m-d H:i:s');

        $config = ['upload_path' => './images/chats/', 'allowed_types' => 'jpg|png|jpeg', 'max_size' => 1024];            
        $this->upload->initialize($config);

        if($this->upload->do_upload('img')){ 
            $dataUpload     = $this->upload->data();
            $filenameImg    = base_url('images/chats/' . $dataUpload['file_name']);
        }

        $data = array(
            'MESSAGE'       => $message,
            'CREATEDAT'     => $createdAt,
            'ID_CHAT_ROOM'  => $idChatRoom,
            'ISADMIN'       => 1,
            'IMG'           => $filenameImg
        );

        $dataKirim = array(
            'token'   => $token  
        );

        $this->MChat->adminKirimPesan($data);
        
        $this->load->view('notif', $dataKirim);
        redirect('Chat/detailChat/'.$idChatRoom);
    }
}
