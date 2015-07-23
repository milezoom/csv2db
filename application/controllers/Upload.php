<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Upload extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
    }
    public function index()
    {
        $this->load->database();
        $this->load->view('uploads', array(
            'error' => ' ',
            'dbname' => $this->db->database,
            'tablename' => 'imported'
        ));
    }
    public function do_upload()
    {
        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'csv';

        $this->load->library('upload', $config);
        $this->load->database();

        if (!$this->upload->do_upload()) {
            $data = array(
                'error' => $this->upload->display_errors(),
                'dbname' => $this->db->database,
                'tablename' => 'imported'
            );
            $this->load->view('uploads', $data);
        } else {
            $filedata = $this->upload->data();
            $this::saveToDB($filedata['full_path']);
            $this->load->view('success');
        }
    }
    private function saveToDB($path)
    {
        $this->load->database();
        $counter = 1;
        if (($handle = fopen($path, 'r')) !== false) {
            while (($data = fgetcsv($handle, 0, ',')) !== false) {
                if ($counter > 1) {
                    $date = str_replace('/','-',$data[0]);
                    $row = array(
                        'date' => date('Y-m-d', strtotime($date)),
                        'category' => $data[1],
                        'target' => $data[2],
                    );
                    $this->db->insert('imported', $row);
                }
                ++$counter;
            }
            fclose($handle);
        }
        unlink($path);
    }
    public function download_example()
    {
        $this->load->helper('download');
        force_download('./uploads/ex_document.csv', NULL);
    }
}
