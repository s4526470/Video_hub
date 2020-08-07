<?php defined('BASEPATH') OR exit('No direct script access allowed');


class Video extends CI_Model {
    function __construct() {
        // Set table name
        $this->table = 'videos';
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

}