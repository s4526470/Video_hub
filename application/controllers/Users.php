<?php
// Show login page
class Users extends CI_Controller{
    function __construct() {
        parent::__construct();

        // Load form validation ibrary & user model
        $this->load->library('form_validation');
        $this->load->model('user');
        $this->load->model('video');
        $this->load->model('comments');

        // User login status
        $this->isUserLoggedIn = $this->session->userdata('isUserLoggedIn');
        $this->load->helper('captcha');
    }

    public function index(){
        $result = array();
        if($this->input->post('search')){
            $videoResult = $this->input->post('result');
            redirect('users/play_video/'.$videoResult);
        }
        $this->load->view('templates/header');
        $result['files'] = $this->video->getAll();
        $this->load->view('templates/videos', $result);
        $this->load->view('templates/footer');
    }

    public function address(){
        $this->load->view('company/location');
    }

    public function play_video($param){
        $result = array();
        $result['video'] = $this->video->getVideo($param);
        $result['message'] = '';
        if($this->isUserLoggedIn){
            $userId = $this->session->userdata('userId');
            $userName = $this->user->gainFirstName($userId);
            if($result['video'] == false){
                redirect('users/index');
            }else{
                if($this->input->post('subComment')){
                    $this->form_validation->set_rules('comment', 'comment', 'required|max_length[50]');
                    $this->form_validation->set_rules('g-recaptcha-response',
                        'recaptcha validation', 'required|callback_validate_captcha');
                    $this->form_validation->set_message('validate_captcha', 'Please check the the captcha form');
                    if($this->form_validation->run() == true){
                        $commentData = array(
                            'comment' => strip_tags($this->input->post('comment')),
                            'user_id' => $this->session->userdata('userId'),
                            'video_id' => $param,
                            'user_first_name' => $userName['first_name']
                        );
                        $result['message'] = '';
                        $this->comments->insert($commentData);
                    }else{
                        $result['message'] = 'Cannot submit the comment';
                    }
                }
                if($this->input->post('addFavourite')){
                    $favourite = array();
                    $favourite = $this->video->getVideoName($param);
                    $favourite_video = array(
                        'video_name' => $favourite[0]['video_name'],
                        'video_id' => $param,
                        'user_id' => $this->session->userdata('userId')
                    );
                    if($this->video->checkRepeat($favourite_video['video_id'], $favourite_video['user_id'])){
                        $this->video->addFavourite($favourite_video);
                    }
                }
                $result['comments'] = $this->comments->getRow($param);
                $this->load->view('video/play-video', $result);
            }
        }else{
            redirect('users/login');
        }
    }
    function validate_captcha() {
        $captcha = $this->input->post('g-recaptcha-response');
        $response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=6Lekq_********laQLRDg_5OvNDXnMzkYEfWi4j_&response=" . $captcha . "&remoteip=" . $_SERVER['REMOTE_ADDR']);
        if ($response . 'success' == false) {
            return FALSE;
        } else {
            return TRUE;
        }
    }

    public function favouriteVideo(){
        $data = array();
        if($this->isUserLoggedIn){
            $con = array(
                'id' => $this->session->userdata('userId')
            );
            $data['user'] = $this->user->getRows($con);
            $data['files'] = $this->video->getFavouriteVideo($con['id']);
            // Pass the user data and load view
            $this->load->view('users/favourite-video', $data);
            $this->load->view('users/footer');
        }else{
            redirect('users/login');
        }
    }

    public function autocompleteData(){
        $returnData = array();

        // Get videos data
        $conditions['searchTerm'] = $this->input->get('term');
        $conditions['conditions']['status'] = '1';
        $videoData = $this->video->getVideos($conditions);

        // Generate array
        if(!empty($videoData)){
            foreach ($videoData as $row){
                $data['id'] = $row['id'];
                $data['value'] = $row['video_name'];
                array_push($returnData, $data);
            }
        }

        // Return results as json encoded array
        echo json_encode($returnData);
        die;

    }

    public function account(){
        $data = array();
        if($this->isUserLoggedIn){
//            $con = array(
//                'id' => $this->session->userdata('userId')
//            );
//            $data['user'] = $this->user->getRows($con);
            $data['user'] = $this->user->getAccountInfo($this->session->userdata('userId'));
            // Pass the user data and load view
            $this->load->view('users/account', $data);
            $this->load->view('users/footer');
        }else{
            redirect('users/login');
        }
    }

	public function login(){
        $this->load->library('encryption');
        if($this->isUserLoggedIn){
            redirect('users/account');
        }else{
            $data = array();

            // Get messages from the session
            if($this->session->userdata('success_msg')){
                $data['success_msg'] = $this->session->userdata('success_msg');
                $this->session->unset_userdata('success_msg');
            }
            if($this->session->userdata('error_msg')){
                $data['error_msg'] = $this->session->userdata('error_msg');
                $this->session->unset_userdata('error_msg');
            }

            // If login request submitted
            if($this->input->post('loginSubmit')){
                $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
                $this->form_validation->set_rules('password', 'password', 'required');
                if($this->form_validation->run() == true){
                    $con = array(
                        'returnType' => 'single',
                        'conditions' => array(
                            'email'=> $this->input->post('email'),
                            'password' => $this->input->post('password'),
                            'status' => 1
                        )
                    );
                    $email = $this->input->post('email');
                    $password = $this->input->post('password');
                    $checkLogin = $this->user->checkAccount($email, $password);
//                    $checkLogin = $this->user->getRows($con);
                    if($checkLogin){
                        $uemail = $this->input->post('email');
                        $upass = $this->input->post('password');
                        if($this->input->post("chkremember")){
                            $this->input->set_cookie('useremail', $uemail, 432000); /* Create 5 days cookie for store email */
                            $this->input->set_cookie('userpassword', $upass, 432000); /* Create 5 days cookie for password */
                        }else{
                            delete_cookie('useremail'); /* Delete email cookie */
                            delete_cookie('userpassword'); /* Delete password cookie */
                        }
                        $this->session->set_userdata('isUserLoggedIn', TRUE);       // important
                        $this->session->set_userdata('userId', $checkLogin['id']);  // important
                        redirect('users/account/');
                    }else{
                        $data['error_msg'] = 'Wrong email or password, please try again.';
                    }
                }else{
                    $data['error_msg'] = 'Please fill all the mandatory fields.';
                }
            }

            //Load view
            $this->load->view('users/login', $data);
        }

	}

    public function forget(){           // Can work Can work Can work Can work
        if($this->isUserLoggedIn){
            redirect('users/account');
        }else{
            $data = array();

            // Get messages from the session
            if($this->session->userdata('success_msg')){
                $data['success_msg'] = $this->session->userdata('success_msg');
                $this->session->unset_userdata('success_msg');
            }
            if($this->session->userdata('error_msg')){
                $data['error_msg'] = $this->session->userdata('error_msg');
                $this->session->unset_userdata('error_msg');
            }

            // If confirm request submitted
            if($this->input->post('confirm')){

                $this->form_validation->set_rules('email', 'Email', 'required|valid_email');

                if($this->form_validation->run() == true){
                    $con = array(
                        'email'=> $this->input->post('email'),
                        'first_question' => $this->input->post('first_question'),
                        'second_question' => $this->input->post('second_question')
                    );
                    $checkLogin = $this->user->checkSecret($con);
                    if($checkLogin){
                        $this->session->set_userdata('isUserLoggedIn', TRUE);
                        $this->session->set_userdata('userId', $checkLogin['id']);
                        redirect('users/account/');
                    }else{
                        $data['error_msg'] = 'Wrong email or secret answers, please try again.';
                    }
                }else{
                    $data['error_msg'] = 'Please fill all the mandatory fields.';
                }
            }

            //Load view
            $this->load->view('users/forget', $data);
        }
    }

	public function registration(){
        $this->load->library('encryption');
        $data = $userData = array();
        $captchaError = '';
        // If registration request is submitted
        if($this->input->post('signupSubmit')){
            $this->form_validation->set_rules('first_name', 'First Name', 'required');
            $this->form_validation->set_rules('last_name', 'Last Name', 'required');
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email|callback_email_check');
            $this->form_validation->set_rules('password', 'password', 'required|min_length[6]|max_length[30]');
            $this->form_validation->set_rules('conf_password', 'confirm password', 'required|matches[password]');
            $inputCaptcha = $this->input->post('captcha');
            $sessCaptcha = $this->session->userdata('captchaCode');
            if($inputCaptcha === $sessCaptcha){
                $captchaError = '';
            }else{
                $captchaError = 'Captcha code does not matched.';
            }
            $password = strip_tags($this->input->post('password'));
            $userData = array(
                'first_name' => strip_tags($this->input->post('first_name')),
                'last_name' => strip_tags($this->input->post('last_name')),
                'email' => strip_tags($this->input->post('email')),
                'password' => $this->encryption->encrypt($password),
//                'password' => $password,
                'gender' => $this->input->post('gender'),
                'phone' => strip_tags($this->input->post('phone')),
                'first_secret_question' => strip_tags($this->input->post('first_question')),
                'second_secret_question' => strip_tags($this->input->post('second_question'))
            );

            if($this->form_validation->run() == true && $inputCaptcha === $sessCaptcha){
                $insert = $this->user->insert($userData);
                if($insert){
                    $this->session->set_userdata('success_msg', 'Your account registration has been successful. Please login to your account.');
                    redirect('users/login');
                }else{
                    $data['error_msg'] = $captchaError.' '.'Some problems occured, please try again.';
                }
            }else{
                $data['error_msg'] = $captchaError.' '.'Please fill all the mandatory fields.';
            }
        }

        // Posted data
        $data['user'] = $userData;
        // Captcha configuration
        $config = array(
            'img_path'      => 'captcha_images/',
            'img_url'       => base_url().'captcha_images/',
            'font_path'     => 'system/fonts/texb.ttf',
            'img_width'     => '160',
            'img_height'    => 50,
            'word_length'   => 4,
            'font_size'     => 18
        );
        $captcha = create_captcha($config);

        // Unset previous captcha and set new captcha word
        $this->session->unset_userdata('captchaCode');
        $this->session->set_userdata('captchaCode', $captcha['word']);
        // Pass captcha image to view
        $data['captchaImg'] = $captcha['image'];

        // Load view
        $this->load->view('users/registration', $data);
    }

    public function refresh(){
        // Captcha configuration
        $config = array(
            'img_path'      => 'captcha_images/',
            'img_url'       => base_url().'captcha_images/',
            'font_path'     => 'system/fonts/texb.ttf',
            'img_width'     => '160',
            'img_height'    => 50,
            'word_length'   => 4,
            'font_size'     => 18
        );
        $captcha = create_captcha($config);

        // Unset previous captcha and set new captcha word
        $this->session->unset_userdata('captchaCode');
        $this->session->set_userdata('captchaCode',$captcha['word']);

        // Display captcha image
        echo $captcha['image'];
    }

    // Existing email check during validation
    public function email_check($str){
        $con = array(
            'returnType' => 'count',
            'conditions' => array(
                'email' => $str
            )
        );
        $checkEmail = $this->user->getRows($con);
        if($checkEmail > 0){
            $this->form_validation->set_message('email_check', 'The given email already exists.');
            return FALSE;
        }else{
            return TRUE;
        }
    }

    public function updateProfile(){
        $this->load->library('encryption');
        if(!$this->isUserLoggedIn){
            redirect('users/login');
        }else{
            $data = $userData = array();

            // If edit request is submitted
            if($this->input->post('updateSubmit')){
                $this->form_validation->set_rules('first_name', 'First Name', 'required');
                $this->form_validation->set_rules('last_name', 'Last Name', 'required');
//                $this->form_validation->set_rules('email', 'Email', 'required|valid_email|callback_email_check');
                $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
                $this->form_validation->set_rules('password', 'password', 'required|min_length[6]|max_length[30]');
                $this->form_validation->set_rules('conf_password', 'confirm password', 'required|matches[password]');
                $password = strip_tags($this->input->post('password'));
                $userData = array(
                    'id' => $this->session->userdata('userId'),
                    'first_name' => strip_tags($this->input->post('first_name')),
                    'last_name' => strip_tags($this->input->post('last_name')),
                    'email' => strip_tags($this->input->post('email')),
                    'password' => $this->encryption->encrypt($password),
//                    'password' => strip_tags($this->input->post('password')),
                    'gender' => $this->input->post('gender'),
                    'phone' => strip_tags($this->input->post('phone'))
                );

                if($this->form_validation->run() == true){
                    $update = $this->user->update($userData);
                    if($update){
                        $this->session->set_userdata('success_msg',
                            'Your account registration has been successful. Please login to your account.');
                        redirect('users/account');
                    }else{
                        $data['error_msg'] = 'The email already exists, please try again.';
                    }
                }else{
                    $data['error_msg'] = 'Please fill all the mandatory fields.';
                }
            }
            $con = array(
                'id' => $this->session->userdata('userId')
            );
//            $data['user'] = $this->user->getRows($con);
//            $data['user'] = $this->user->gainRow($con);
            $data['user'] = $this->user->getAccountInfo($this->session->userdata('userId'));
            // load view
            $this->load->view('users/edit-account', $data);
        }
    }

    public function logout(){
        $this->session->unset_userdata('isUserLoggedIn');
        $this->session->unset_userdata('userId');
        $this->session->sess_destroy();
        redirect('users/index');
    }

}

