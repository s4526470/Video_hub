<?php defined('BASEPATH') OR exit('No direct script access allowed');


class Video extends CI_Model {
    function __construct() {
        // Set table name
        $this->table = 'videos';
        $this->favtable = 'fav_video';
    }

    /*
     * Fetch files data from the database
     * @param id returns a single record if specified, otherwise all records
     */
    public function getRows($id = ''){
        $this->db->select('video_name');
        $this->db->from($this->table);
        if($id){
            $this->db->where('user_id',$id);
            $query = $this->db->get();
            $result = $query->result_array();
        }else{
            $this->db->where('user_id',$id);
            $query = $this->db->get();
            $result = $query->result_array();
        }
        return !empty($result)?$result:false;
    }

    /*
     * Insert file data into the database
     * @param array the data for inserting into the table
     */
    public function insert($data = array()){
        $insert = $this->db->insert_batch($this->table,$data);
        return $insert?true:false;
    }

    public function getAll(){
        $this->db->select('id');
        $this->db->select('video_name');
        $this->db->from($this->table);
        $query = $this->db->get();
        $result = $query->result_array();
        return !empty($result)?$result:false;
    }

    public function getVideos($params = array()){
        $this->db->select("*");
        $this->db->from($this->table);

        //fetch data by conditions
        if(array_key_exists("conditions",$params)){
            foreach ($params['conditions'] as $key => $value) {
                $this->db->where($key,$value);
            }
        }

        //search by terms
        if(!empty($params['searchTerm'])){
            $this->db->like('video_name', $params['searchTerm']);
        }

        $this->db->order_by('video_name', 'asc');

        if(array_key_exists("id",$params)){
            $this->db->where('id',$params['id']);
            $query = $this->db->get();
            $result = $query->row_array();
        }else{
            $query = $this->db->get();
            $result = ($query->num_rows() > 0)?$query->result_array():FALSE;
        }

        //return fetched data
        return $result;
    }

    public function getVideoName($video_id){
        $this->db->select('video_name');
        $this->db->from($this->table);
        $this->db->where('id', $video_id);
        $query = $this->db->get();
        $result = $query->result_array();
        return !empty($result)?$result:false;
    }

    public function getVideo($id){
        $this->db->select("*");
        $this->db->from($this->table);
        $this->db->where('id', $id);
        $query = $this->db->get();
        $result = $query->result_array();
        return !empty($result)?$result:false;
    }

    public function addFavourite($data = array()){
        $insert = $this->db->insert($this->favtable,$data);
        return $insert?true:false;
    }

    public function checkRepeat($video_id, $user_id){
        $this->db->select("*");
        $this->db->from($this->favtable);
        $this->db->where('video_id', $video_id);
        $this->db->where('user_id', $user_id);
        $query = $this->db->get();
        $result = ($query->num_rows() > 0)?FALSE:TRUE;
        return $result;
    }

    public function getFavouriteVideo($user_id){
        $this->db->select('video_name');
        $this->db->from($this->favtable);
        if($user_id){
            $this->db->where('user_id',$user_id);
            $query = $this->db->get();
            $result = $query->result_array();
        }else{
            $this->db->where('user_id',$user_id);
            $query = $this->db->get();
            $result = $query->result_array();
        }
        return !empty($result)?$result:false;
    }

    function fetch_data($limit, $start, $user_id){
        $this->db->select("*");
        $this->db->from("videos");
        $this->db->where("user_id", $user_id);
        $this->db->order_by("id", "DESC");
        $this->db->limit($limit, $start);
        $query = $this->db->get();
        return $query;
    }
}