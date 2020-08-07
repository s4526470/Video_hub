<?php defined('BASEPATH') OR exit('No direct script access allowed');


class Comments extends CI_Model{
    function __construct() {
        // Set table name
        $this->table = 'comments';
    }

    /*
     * Insert file data into the database
     * @param array the data for inserting into the table
     */
    public function insert($data = array()){
        $insert = $this->db->insert($this->table,$data);
        return $insert?true:false;
    }

    public function getRow($video_id){
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('video_id', $video_id);
        $query = $this->db->get();
        $result = $query->result_array();
        return !empty($result)?$result:false;
    }
}
