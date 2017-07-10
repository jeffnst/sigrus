<?php

include 'Admin.php';

class pengurus_tpq extends admin
{
  public function __construct()
  {
    parent::__construct();
    parent::checkauth();
    $this->data['active_page'] = "tpq";
  }



  //Data on Page
  public function data()
  {
    $this->data['title_page'] = "Kategori Pengurus TPQ";
    $dest_table_as = 'tb_kategori_pengurus_tpq as p';
    $select_values = array('*');
    $params = new stdClass();
    $params->dest_table_as = $dest_table_as;
    $params->select_values = $select_values;
    $get = $this->data_model->get($params);
    if ($get['results'] != "") {
      foreach ($get['results'] as $each) {
        $datas['id'] = $each->id;
        $datas['nama'] = $each->nama;
        $datas['link'] = base_url() . 'admin/pengurus_tpq/detail/' . $each->id;
        $record[] = $datas;
      }
      if (isset($record)) {
        $this->data['record'] = $record;
      } else {
        $this->data['record'] = '';
      }
    }
    $this->data['record'] = $record;
    $this->data['data_table'] = true;
    parent::display('admin/pengurus_tpq/data', 'admin/pengurus_tpq/function',true);
  }

  public function detail()
  {
    $parameter = $this->uri->segment(4);
    $params = new stdClass();
    $params->dest_table_as = 'tb_kategori_pengurus_tpq';
    $params->select_values = array('*');
    $where = array("where_column" => 'id', "where_value" => $parameter);
    $params->where_tables = array($where);
    $get_data_pengurus_tpq = $this->data_model->get($params);
    if ($get_data_pengurus_tpq["results"][0] != "") {
      $this->data['detail'] = $get_data_pengurus_tpq["results"][0];
      $this->data['title_page'] = "Detail Kategori Pengurus TPQ";
      parent::display('admin/pengurus_tpq/detail','admin/pengurus_tpq/function');
    } else {
      redirect('/admin/404');
    }
  }


  public function add()
  {
    $this->data['title_page'] = "Tambah Data Kategori Pengurus TPQ";
    parent::display('admin/pengurus_tpq/add','admin/pengurus_tpq/function');
  }

  //Data Processing

  public function add_submit()
  {
      $nama = $this->input->post("nama");
      $params_data = array( "nama" => $nama);
      $dest_table = 'tb_kategori_pengurus_tpq';
      $add = $this->data_model->add($params_data, $dest_table);

      if ($add['response'] == OK_STATUS ) {
        $data = array("link" => base_url() . 'admin/pengurus_tpq/detail/' . $add['data']);
        $result = get_success($data);
      } else {
        $result = response_fail();
      }
      echo json_encode($result);
    }


    public function update_submit()
    {
      $id = $this->input->post("id");
      $nama = $this->input->post("nama");

      //Update Data
      $params_data = new stdClass();
      $params_data->new_data = array(
        "nama" => $nama);
        $where = array("where_column" => 'id', "where_value" => $id);
        $params_data->where_tables = array($where);
        $params_data->table_update = 'tb_kategori_pengurus_tpq';
        $update = $this->data_model->update($params_data);


        if ($update['response'] == OK_STATUS ) {
          $params = new stdClass();
          $params->response = OK_STATUS;
          $params->message = OK_MESSAGE;
          $params->data = array('link' => base_url() . 'admin/pengurus_tpq/detail/' . $id);
          $result = response_custom($params);
        } else {
          $result = response_fail();
        }
        echo json_encode($result);
      }


      public function delete_submit()
      {
        $id = $this->input->post('id');

        $params_delete = new stdClass();
        $where1 = array("where_column" => 'id_kategori_pengurus_tpq', "where_value" => $id);
        $params_delete->where_tables = array($where1);
        $params_delete->table = 'tb_pengurus_tpq';
        $delete = $this->data_model->delete($params_delete);

        $params_delete = new stdClass();
        $where1 = array("where_column" => 'id', "where_value" => $id);
        $params_delete->where_tables = array($where1);
        $params_delete->table = 'tb_kategori_pengurus_tpq';
        $delete = $this->data_model->delete($params_delete);

        if ($delete['response'] == OK_STATUS) {
          $data = array("link" => base_url() . 'admin/pengurus_tpq/data');
          $result = get_success($data);
        } else {
          $result = response_fail();
        }
        echo json_encode($result);
      }

      public function change_password() {
        $old_pass = $this->input->post("old_pass");
        $new_pass = $this->input->post("new_pass");
        $id_pengurus_tpq = $this->input->post("id_pengurus_tpq");
        $dest_table_as = 'tb_akun as u';
        $select_values = array('u.password');
        $params = new stdClass();
        $params->dest_table_as = $dest_table_as;
        $params->select_values = $select_values;
        $where1 = array("where_column" => 'u.level', "where_value" => "T");
        $where2 = array("where_column" => 'u.id_level', "where_value" => $id_pengurus_tpq);
        $params->where_tables = array($where1,$where2);
        $get = $this->data_model->get($params);
        if ($get['response'] == OK_STATUS) {
          if ($old_pass != $get['results'][0]->password) {
            $response_data = array("response" => FAIL_STATUS, "message" => "Password lama tidak sesuai");
          } else {
            $params_data = new stdClass();
            $params_data->new_data = array("password" => $new_pass);
            $params_data->table_update = 'tb_akun';
            $where1 = array("where_column" => 'level', "where_value" => "T");
            $where2 = array("where_column" => 'id_level', "where_value" => $id_pengurus_tpq);
            $params_data->where_tables = array($where1,$where2);
            $update = $this->data_model->update($params_data);
            if ($update["response"] == OK_STATUS) {
              $response_data = array("response" => OK_STATUS, "message" => "Password sudah diganti");
            }
          }
        }
        echo json_encode($response_data);
      }
    }
