<?php defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Model{
    function __construct() {
        // Set table name
        $this->table = 'users';
    }

    /*
     * Fetch user data from the database
     * @param array filter data based on the passed parameters
     */
    function getRows($params = array()){
        $this->db->select('*');
        $this->db->from($this->table);

        if(array_key_exists("conditions", $params)){
            foreach($params['conditions'] as $key => $val){
                $this->db->where($key, $val);
            }
        }

        if(array_key_exists("returnType",$params) && $params['returnType'] == 'count'){
            $result = $this->db->count_all_results();
        }else{
            if(array_key_exists("id", $params) || $params['returnType'] == 'single'){
                if(!empty($params['id'])){
                    $this->db->where('id', $params['id']);
                }
                $query = $this->db->get();
                $result = $query->row_array();
            }
            else{
                $this->db->order_by('id', 'desc');
                if(array_key_exists("start",$params) && array_key_exists("limit",$params)){
                    $this->db->limit($params['limit'],$params['start']);
                }elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){
                    $this->db->limit($params['limit']);
                }

                $query = $this->db->get();
                $result = ($query->num_rows() > 0)?$query->result_array():FALSE;
            }
        }

        // Return fetched data
        return $result;
    }

    /*
     * Insert user data into the database
     * @param $data data to be inserted
     */
    public function insert($data = array()) {
        if(!empty($data)){
            // Add created and modified date if not included
            if(!array_key_exists("created", $data)){
                $data['created'] = date("Y-m-d H:i:s");
            }
            if(!array_key_exists("modified", $data)){
                $data['modified'] = date("Y-m-d H:i:s");
            }

            // Insert member data
            $insert = $this->db->insert($this->table, $data);

            // Return the status
            return $insert?$this->db->insert_id():false;
        }
        return false;
    }

    public function gainRow($params = array()){
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('id',$params['id']);
        $query=$this->db->get();
        $result = $query->row_array();
        return $result;
    }

    public function update($data = array()) {
        if(!empty($data)){
            // Add created and modified date if not included
            if(!array_key_exists("created", $data)){
                $data['created'] = date("Y-m-d H:i:s");
            }
            if(!array_key_exists("modified", $data)){
                $data['modified'] = date("Y-m-d H:i:s");
            }

            $this->db->select('*');
            $this->db->from($this->table);
            $this->db->where('id !=',$data['id']);
            $this->db->where('email', $data['email']);
            $query = $this->db->get();
            $result = $query->num_rows();
            if($result >= 1){
                return false;
            }else{
                // Update member data
                $this->db->where('id', $data['id']);
                $update = $this->db->update($this->table, $data);

                // Return the status
                return $update?true:false;
            }

        }
        return false;
    }

    public function checkSecret($params = array()){
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('email',$params['email']);
        $this->db->where('first_secret_question',$params['first_question']);
        $this->db->where('second_secret_question', $params['second_question']);
        $query = $this->db->get();

        $result = ($query->num_rows() > 0)?$query->row_array():FALSE;
        return $result;
    }
}