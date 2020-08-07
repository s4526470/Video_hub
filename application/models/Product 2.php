<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Product extends CI_Model{
    function __construct() {
        $this->proTable   = 'products';
//        $this->transTable = 'payments';
        $this->transTable = 'payment';
    }

    /*
     * Fetch products data from the database
     * @param id returns a single record if specified, otherwise all records
     */
    public function getRows($id = ''){
        $this->db->select('*');
        $this->db->from($this->proTable);
        $this->db->where('status', '1');
        if($id){
            $this->db->where('id', $id);
            $query  = $this->db->get();
            $result = $query->row_array();
        }else{
            $this->db->order_by('name', 'asc');
            $query  = $this->db->get();
            $result = $query->result_array();
        }

        // return fetched data
        return !empty($result)?$result:false;
    }

    public function insert($data = array()){
        $insert = $this->db->insert($this->transTable,$data);
        return $insert?true:false;
    }

    public function getUserInvoice($user_id){
        $this->db->select('*');
        $this->db->from($this->transTable);
        $this->db->where('user_id', $user_id);
        $this->db->order_by('payment_id', 'desc');
        $query  = $this->db->get();
        $result = $query->row_array();
        return $result;
    }
}