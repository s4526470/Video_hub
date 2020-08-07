<?php


class Upload extends CI_Controller{
    function __construct() {
        parent::__construct();

        // Load form validation ibrary & user model
        $this->load->library('form_validation');
        $this->load->model('user');
        $this->load->model('video');

        // User login status
        $this->isUserLoggedIn = $this->session->userdata('isUserLoggedIn');

        $this->load->helper(array('form', 'url'));
    }

    public function index()
    {
        $result = array();
        $data = array();
        $errorUploadType = $statusMsg = '';
        if($this->isUserLoggedIn){
            $con = array(
                'id' => $this->session->userdata('userId')
            );
            $data['user'] = $this->user->getRows($con);

            // If file upload form submitted
            if($this->input->post('fileSubmit')){

                // If files are selected to upload
                if(!empty($_FILES['files']['name']) && count(array_filter($_FILES['files']['name'])) > 0){
                    $filesCount = count($_FILES['files']['name']);
                    for($i = 0; $i < $filesCount; $i++){
                        $_FILES['file']['name']     = $_FILES['files']['name'][$i];
                        $_FILES['file']['type']     = $_FILES['files']['type'][$i];
                        $_FILES['file']['tmp_name'] = $_FILES['files']['tmp_name'][$i];
                        $_FILES['file']['error']     = $_FILES['files']['error'][$i];
                        $_FILES['file']['size']     = $_FILES['files']['size'][$i];

                        // File upload configuration
                        $config['upload_path']          = './uploads/';
                        $config['allowed_types']        = 'avi|mp4|3gp|rmvb|wmv';
                        $config['max_size']             = 0;
                        $this->load->library('upload', $config);
                        $this->upload->initialize($config);

                        // Upload file to server
                        if($this->upload->do_upload('file')){
                            $fileData = $this->upload->data();
                            $uploadData[$i]['video_name'] = $fileData['file_name'];
                            $uploadData[$i]['user_id'] = $con['id'];
                        }else{
                            $errorUploadType .= $_FILES['file']['name'].' | ';
                            print_r($this->upload->display_errors());
                        }
                    }

                    $errorUploadType = !empty($errorUploadType)?'<br/>File Type Error: '.trim($errorUploadType, ' | '):'';
                    if(!empty($uploadData)){
                        // Insert files data into the database
                        $insert = $this->video->insert($uploadData);

                        // Upload status message
                        $statusMsg = $insert?'Files uploaded successfully!'.$errorUploadType:'Some problem occurred, please try again.';
                    }else{
                        $statusMsg = "Sorry, there was an error uploading your file.".$errorUploadType;

                    }
                }else{
                    $statusMsg = 'Please select video files to upload.';
                }
            }
            // Pass the user data and load view
            $this->load->view('users/uploaded_video', $data);
            $result['statusMsg'] = $statusMsg;
            $result['files'] = $this->video->getRows($con['id']);
            $this->load->view('upload_form', $result);
            $this->load->view('users/footer');
        }else{
            redirect('users/login');
        }
    }

     public function fetch(){
         $output = '';
         $data = $this->video->fetch_data($this->input->post('limit'), $this->input->post('start'), $this->session->userdata('userId'));
         if($data->num_rows() > 0)
         {
             foreach($data->result() as $row)
             {
                 $header = '<div class="post_data" style="width:360px; display:inline-block; margin-bottom: 30px;">';
                 $par = '<p>'.$row->video_name.'</p>';
                 $video_header = '<video class="item" style="list-style: none;" width="360" height="200" controls>';
                 $url = base_url('uploads/'.$row->video_name);
                 $source = "<source src='$url' type='video/mp4'>";
                 $video_footer = "</video>";
                 $footer = '</div>';
                 $output .= ($header . $par . $video_header . $source . $video_footer . $footer);
             }
         }
         echo $output;
     }
}