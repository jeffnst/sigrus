<?php

include 'Admin.php';

class tpq extends admin
{
  public function __construct()
  {
    parent::__construct();
    parent::checkauth();
    $this->data['active_page'] = "tpq";
  }

  public function get_pc()
  {
    $params_pc = new stdClass();
    $params_pc->dest_table_as = 'tb_pc as pc';
    $params_pc->select_values = array('pc.id as id', 'pc.nama as nama');
    $pc = $this->data_model->get($params_pc);
    return $pc;
  }

  public function get_kat_pgrs()
  {
    $params_kat_pgrs = new stdClass();
    $params_kat_pgrs->dest_table_as = 'tb_kategori_pengurus_tpq';
    $params_kat_pgrs->select_values = array('*');
    $get_kat_pgrs = $this->data_model->get($params_kat_pgrs);
    return $get_kat_pgrs;
  }

  //Data on Page
  public function data()
  {
    $this->data['title_page'] = "Data TPQ";
    $dest_table_as = 'tb_tpq as tpq';
    $select_values = array('tpq.id', 'tpq.nama', 'tpq.kontak', 'tpq.alamat', 'tpq.email', 'pc.nama as nama_pc', 'tpq.link', 'tpq.wilayah');
    $join_data = array("join_with" => 'tb_pc as pc', "join_on" => 'tpq.id_pc = pc.id', "join_type" => '');
    $join_tables = array($join_data);
    $params = new stdClass();
    $params->dest_table_as = $dest_table_as;
    $params->select_values = $select_values;
    $params->join_tables = $join_tables;
    $get = $this->data_model->get($params);
    if ($get['results'] != "") {
      foreach ($get['results'] as $each) {
        $datas['id'] = $each->id;
        $datas['nama'] = $each->nama;
        $datas['kontak'] = $each->kontak;
        $datas['alamat'] = $each->alamat;
        $datas['wilayah'] = $each->wilayah;
        $datas['email'] = $each->email;
        $datas['nama_pc'] = $each->nama_pc;
        $datas['link'] = base_url() . 'admin/tpq/detail/' . $each->link;
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
    parent::display('admin/tpq/data', '',true);
  }

  public function detail()
  {
    $parameter = $this->uri->segment(4);
    $params = new stdClass();
    $params->dest_table_as = 'tb_tpq as tpq';
    $params->select_values = array('tpq.id as id_tpq', 'tpq.nama', 'tpq.kontak', 'tpq.alamat', 'tpq.email', 'pc.nama as nama_pc', 'tpq.link', 'tpq.logo', 'tpq.cover', 'tpq.id_pc', 'tpq.wilayah');
    $join = array("join_with" => 'tb_pc as pc', "join_on" => 'tpq.id_pc = pc.id', "join_type" => '');
    $params->join_tables = array($join);
    $where = array("where_column" => 'tpq.link', "where_value" => $parameter);
    $params->where_tables = array($where);
    $get_data_tpq = $this->data_model->get($params);
    // print_r($get_data_tpq);exit();
    if ($get_data_tpq["results"][0] != "") {
      $get_kat_pgrs = $this->get_kat_pgrs();
      $get_pc = $this->get_pc();
      $params_pgrs = new stdClass();
      $params_pgrs->dest_table_as = 'tb_kategori_pengurus_tpq as kat_pgrs_tpq';
      $params_pgrs->select_values = array('kat_pgrs_tpq.id as id_kat_pgrs', 'kat_pgrs_tpq.nama as nama_kat_pgrs', 'pgrs_tpq.nama as nama_pgrs');
      $join1 = array("join_with" => 'tb_pengurus_tpq as pgrs_tpq', "join_on" => 'pgrs_tpq.id_kategori_pengurus_tpq = kat_pgrs_tpq.id', "join_type" => 'LEFT OUTER');
      $where1 = array("where_column" => 'pgrs_tpq.id_tpq', "where_value" => $get_data_tpq['results'][0]->id_tpq);
      $where2 = array("where_column" => 'pgrs_tpq.id', "where_value" => NULL);
      $params_pgrs->join_tables = array($join1);
      $params_pgrs->where_tables = array($where1);
      $params_pgrs->or_where_tables = array($where2);
      $get_pgrs = $this->data_model->get($params_pgrs);      
      $this->data['title_page'] = "Detail TPQ";
      $logo = $get_data_tpq['results'][0]->logo;
      $cover = $get_data_tpq['results'][0]->cover;
      $id_tpq = $get_data_tpq['results'][0]->id_tpq;
      $dir_logo = BACKEND_IMAGE_UPLOAD_FOLDER . 'tpq/' . $id_tpq . '/logo/' . $logo;
      $dir_cover = BACKEND_IMAGE_UPLOAD_FOLDER . 'tpq/' . $id_tpq . '/cover/' . $cover;
      $logo_dir_check = check_if_empty($logo, $dir_logo);
      if($logo_dir_check == NO_IMG_NAME){
        $logo = NO_IMG_URL;
      } else {
        $logo = BASE_URL . $dir_logo;
      }
      $cover_dir_check = check_if_empty($cover, $dir_cover);
      if($cover_dir_check == NO_IMG_NAME){
        $cover = NO_IMG_URL;
      } else {
        $cover = BASE_URL . $dir_cover;
      }
      $get_data_tpq['results'][0]->logo_old = $get_data_tpq['results'][0]->logo;
      $get_data_tpq['results'][0]->cover_old = $get_data_tpq['results'][0]->cover;
      $get_data_tpq['results'][0]->logo = $logo;
      $get_data_tpq['results'][0]->cover = $cover;
      $this->data['detail'] = array("data_tpq" => $get_data_tpq["results"], "pc" => $get_pc["results"], "kat_pgrs" => $get_kat_pgrs["results"], "pgrs" => $get_pgrs['results']);
      parent::display('admin/tpq/detail','admin/tpq/function');
    } else {
      redirect('/admin/404');
    }
  }


  public function add()
  {
    $pc = $this->get_pc();
    if ($pc['response'] == OK_STATUS) {
      $this->data['kat_pc'] = $pc['results'];
    } else {
      $this->data['kat_pc'] = "";
    }
    $pgrs = $this->get_kat_pgrs();
    if ($pgrs['response'] == OK_STATUS) {
      $this->data['kat_pgrs_tpq'] = $pgrs['results'];
    } else {
      $this->data['kat_pgrs_tpq'] = "";
    }
    $this->data['title_page'] = "Tambah Data TPQ";
    parent::display('admin/tpq/add','admin/tpq/function');
  }

  //Data Processing

  public function add_submit()
  {
    $nama = $this->input->post("nama");
    $pc = $this->input->post("pc");
    $kontak = $this->input->post("kontak");
    $alamat = $this->input->post("alamat");
    $wilayah = $this->input->post("wilayah");
    $email = $this->input->post("email");
    $password = $this->input->post("password");
    $pengurus = json_decode($this->input->post("pengurus"));
    $link = strtolower(preg_replace("/[^a-zA-Z0-9]/", "", $nama));

    $params_check = new stdClass();
    $params_check->dest_table_as = 'tb_tpq as tpq';
    $params_check->select_values = array('tpq.email');
    $where_data = array("where_column" => 'tpq.email', "where_value" => $email);
    $params_check->where_tables = array($where_data);
    $check = $this->data_model->get($params_check);

    //CHECK NAME
    $params_check = new stdClass();
    $params_check->dest_table_as = 'tb_tpq as tpq';
    $params_check->select_values = array('tpq.link', 'tpq.id');
    $where_data = array("where_column" => 'tpq.link', "where_value" => $link);
    $params_check->where_tables = array($where_data);
    $check = $this->data_model->get($params_check);
    if (!empty($check['results'])) {
      $params = new stdClass();
      $params->response = FAIL_STATUS;
      $params->message = "Nama sudah digunakan !";
      $params->data = "";
      $result = response_custom($params);
      echo json_encode($result);
      exit();
    }


    // CHECK EMAIL
    $params_check = new stdClass();
    $params_check->dest_table_as = 'tb_tpq as tpq';
    $params_check->select_values = array('tpq.email', 'tpq.id');
    $where_data = array("where_column" => 'tpq.email', "where_value" => $email);
    $params_check->where_tables = array($where_data);
    $check = $this->data_model->get($params_check);
    if (!empty($check['results'])) {
      $params = new stdClass();
      $params->response = FAIL_STATUS;
      $params->message = "Email sudah digunakan !";
      $params->data = "";
      $result = response_custom($params);
      echo json_encode($result);
      exit();
    }

    $params_data = array(
      "nama" => $nama, "id_pc" => $pc, "link" => $link,
      "email" => $email, "kontak" => $kontak, "alamat" => $alamat, "wilayah" => $wilayah, "dibuat_oleh" => "admin");
      $dest_table = 'tb_tpq';
      $add_tpq = $this->data_model->add($params_data, $dest_table);
      $tpq_id = $add_tpq["data"];
      $params_account = array("username" => $email, "password" => $password, "level" => 'T', "id_level" => $tpq_id);
      $dest_table_account = 'tb_akun';
      $add_account = $this->data_model->add($params_account, $dest_table_account);

      if (isset($pengurus)) {
        if ($pengurus != "") {
          foreach ($pengurus as $each) {
            $params_pengurus_tpq = array("id_tpq" => $tpq_id, "id_kategori_pengurus_tpq" => $each->id, "nama" => $each->nama);
            $dest_table_pengurus_tpq = 'tb_pengurus_tpq';
            $add_pengurus_tpq = $this->data_model->add($params_pengurus_tpq, $dest_table_pengurus_tpq);
          }
        }
      }

      $create_dir = mkdir("assets/images/backend/tpq/" . $tpq_id);
      $create_logo_dir = mkdir("assets/images/backend/tpq/" . $tpq_id . "/logo");
      $create_cover_dir = mkdir("assets/images/backend/tpq/" . $tpq_id . "/cover");
      $create_pengajar_dir = mkdir("assets/images/backend/tpq/" . $tpq_id . "/pengajar");
      $create_siswa_dir = mkdir("assets/images/backend/tpq/" . $tpq_id . "/siswa");
      $create_gallery_dir = mkdir("assets/images/backend/tpq/" . $tpq_id . "/gallery");
      $tpq_dir = "assets/images/backend/tpq/" . $tpq_id.'/';

      if (isset($_FILES["logo"])) {
        if ($_FILES["logo"] != "") {
          $upload_logo = image_upload(array($_FILES["logo"]), $tpq_dir . "logo/");
          $image_logo_name = $upload_logo->data[0];
        } else {
          $image_logo_name = "";
        }
      } else {
        $image_logo_name = "";
      }
      if (isset($_FILES["cover"])) {
        if ($_FILES["cover"] != "") {
          $upload_cover = image_upload(array($_FILES["cover"]), $tpq_dir. "cover/");
          $image_cover_name = $upload_cover->data[0];
        } else {
          $image_cover_name = "";
        }
      } else {
        $image_cover_name = "";
      }

      $params_update = new stdClass();
      $params_update->new_data = array("logo" => $image_logo_name, "cover" => $image_cover_name);
      $params_update->table_update = 'tb_tpq';
      $where = array("where_column" => 'id', "where_value" => $tpq_id);
      $params_update->where_tables = array($where);
      $update_logo_cover = $this->data_model->update($params_update);
      if ($add_tpq['response'] == OK_STATUS and $add_account['response'] == OK_STATUS) {
        $data = array("link" => base_url() . 'admin/tpq/detail/' . $link);
        $result = get_success($data);
      } else {
        $result = response_fail();
      }
      echo json_encode($result);
    }


    public function update_submit()
    {
      $idtpq = $this->input->post("id");
      $nama = $this->input->post("nama");
      $pc = $this->input->post("pc");
      $kontak = $this->input->post("kontak");
      $alamat = $this->input->post("alamat");
      $wilayah = $this->input->post("wilayah");
      $email = $this->input->post("email");
      $password = $this->input->post("password");
      $old_logo = $this->input->post("old_logo");
      $old_cover = $this->input->post("old_cover");
      $pengurus = json_decode($this->input->post("pengurus"));
      $link = strtolower(preg_replace("/[^a-zA-Z0-9]/", "", $nama));
      //CHECK NAME
      $params_check = new stdClass();
      $params_check->dest_table_as = 'tb_tpq as tpq';
      $params_check->select_values = array('tpq.link', 'tpq.id');
      $where_data = array("where_column" => 'tpq.link', "where_value" => $link);
      $params_check->where_tables = array($where_data);
      $check = $this->data_model->get($params_check);
      if (!empty($check['results'])) {
        if ($check['results'][0]->id != $idtpq) {
          $params = new stdClass();
          $params->response = FAIL_STATUS;
          $params->message = "Nama sudah digunakan !";
          $params->data = "";
          $result = response_custom($params);
          echo json_encode($result);
          exit();
        }
      }

      // CHECK EMAIL
      $params_check = new stdClass();
      $params_check->dest_table_as = 'tb_tpq as tpq';
      $params_check->select_values = array('tpq.email', 'tpq.id');
      $where_data = array("where_column" => 'tpq.email', "where_value" => $email);
      $params_check->where_tables = array($where_data);
      $check = $this->data_model->get($params_check);
      if (!empty($check['results'])) {
        if ($check['results'][0]->id != $idtpq) {
          $params = new stdClass();
          $params->response = FAIL_STATUS;
          $params->message = "Email sudah digunakan !";
          $params->data = "";
          $result = response_custom($params);
          echo json_encode($result);
          exit();
        }
      }

      //Update Data
      $params_data = new stdClass();
      $params_data->new_data = array(
        "nama" => $nama, "id_pc" => $pc, "link" => $link,
        "email" => $email, "kontak" => $kontak, "alamat" => $alamat, "wilayah" => $wilayah, "dibuat_oleh" => "admin");
        $where = array("where_column" => 'id', "where_value" => $idtpq);
        $params_data->where_tables = array($where);
        $params_data->table_update = 'tb_tpq';
        $update_tpq = $this->data_model->update($params_data);

        $params_account = new stdClass();
        if ($password != '') {
          $params_account->new_data = array("username" => $email, "password" => $password);
        } else {
          $params_account->new_data = array("username" => $email);
        }
        $where = array("where_column" => 'id_level', "where_value" => $idtpq);
        $params_account->where_tables = array($where);
        $params_account->table_update = 'tb_akun';
        $update_account = $this->data_model->update($params_account);

        if (isset($pengurus)) {
          if ($pengurus != "") {
            foreach ($pengurus as $each) {
              $params_pengurus_tpq = new stdClass();
              $params_pengurus_tpq->new_data = array("nama" => $each->nama);
              $where1 = array("where_column" => 'id_tpq', "where_value" => $idtpq);
              $where2 = array("where_column" => 'id_kategori_pengurus_tpq', "where_value" => $each->id);
              $params_pengurus_tpq->where_tables = array($where1, $where2);
              $params_pengurus_tpq->table_update = 'tb_pengurus_tpq';
              $update_pengurus_tpq = $this->data_model->update($params_pengurus_tpq);
            }
          }
        }
        $tpq_dir = "assets/images/backend/tpq/" . $idtpq.'/';
        $error = [];
        if (isset($_FILES["logo"])) {
          if (!empty($_FILES["logo"]["name"])) {
            $upload_logo = image_upload(array($_FILES["logo"]), $tpq_dir . "logo/");
            if ($upload_logo->response == OK_STATUS) {
              $image_logo_name = $upload_logo->data[0];
              if ($old_logo != "") {
                $remove_old = unlink($tpq_dir .'logo/' . $old_logo);
              }
            } else {
              if ($upload_logo->data['error']) {
                foreach ($upload_logo->data['error'] as $er) {
                  array_push($error, $er);
                }
              }
              $image_logo_name = $old_logo;
            }
          } else {
            $image_logo_name = $old_logo;
          }
        } else {
          $image_logo_name = $old_logo;
        }
        if (isset($_FILES["cover"])) {
          if (!empty($_FILES["cover"]["name"])) {
            $upload_cover = image_upload(array($_FILES["cover"]), $tpq_dir . "cover/");
            if ($upload_cover->response == OK_STATUS) {
              $image_cover_name = $upload_cover->data[0];
              if ($old_cover != "") {
                $remove_old = unlink($tpq_dir. 'cover/' . $old_cover);
              }
            } else {
              if ($upload_cover->data['error']) {
                foreach ($upload_cover->data['error'] as $er) {
                  array_push($error, $er);
                }
              }
              $image_cover_name = $old_cover;
            }
          } else {
            $image_cover_name = $old_cover;
          }
        } else {
          $image_cover_name = $old_cover;
        }

        $params_update = new stdClass();
        $params_update->new_data = array("logo" => $image_logo_name, "cover" => $image_cover_name);
        $where = array("where_column" => 'id', "where_value" => $idtpq);
        $params_update->where_tables = array($where);
        $params_update->table_update = 'tb_tpq';
        $update_logo_cover = $this->data_model->update($params_update);
        if ($update_tpq['response'] == OK_STATUS ) {
          $params = new stdClass();
          if ($error) {
            $params->response = FAIL_STATUS;
            $params->message = "Peringatan";
            $params->data = array('link' => base_url() . 'admin/tpq/detail/' . $link,'error' => $error);
          } else {
            $params->response = OK_STATUS;
            $params->message = OK_MESSAGE;
            $params->data = array('link' => base_url() . 'admin/tpq/detail/' . $link);
          }
          $result = response_custom($params);
        } else {
          $result = response_fail();
        }
        echo json_encode($result);
      }

      public function delete_submit()
      {
        $id = $this->uri->segment(4);
        $params_delete = new stdClass();
        $where1 = array("where_column" => 'id', "where_value" => $id);
        $params_delete->where_tables = array($where1);
        $params_delete->table = 'tb_tpq';
        $delete = $this->data_model->delete($params_delete);

        $params_delete_akun = new stdClass();
        $params_delete_akun->table = 'tb_akun';
        $where1 = array("where_column" => 'level', "where_value" => 'T');
        $where2 = array("where_column" => 'id_level', "where_value" => $id);
        $params_delete_akun->where_tables = array($where1, $where2);
        $delete_akun = $this->data_model->delete($params_delete_akun);

        if ($delete['response'] == OK_STATUS) {
          $result = response_success();
        } else {
          $result = response_fail();
        }
        echo json_encode($result);
      }

      public function change_password() {
        $old_pass = $this->input->post("old_pass");
        $new_pass = $this->input->post("new_pass");
        $id_tpq = $this->input->post("id_tpq");
        $dest_table_as = 'tb_akun as u';
        $select_values = array('u.password');
        $params = new stdClass();
        $params->dest_table_as = $dest_table_as;
        $params->select_values = $select_values;
        $where1 = array("where_column" => 'u.level', "where_value" => "T");
        $where2 = array("where_column" => 'u.id_level', "where_value" => $id_tpq);
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
            $where2 = array("where_column" => 'id_level', "where_value" => $id_tpq);
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
