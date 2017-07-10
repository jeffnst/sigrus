<?php

include 'Admin.php';

class siswa extends admin {

    public function __construct() {
        parent::__construct();
        parent::checkauth();
        $params_view = new stdClass();
        $this->data['active_page'] = "siswa";
        $this->load->model('data_model');
    }

    public function display($view_location) {
        $this->load->view('admin/siswa/include', $this->data);
        $this->load->view($view_location);
        $this->load->view('admin/include/footer_menu');
    }

    public function get_tpq() {
        $params_tpq = new stdClass();
        $params_tpq->dest_table_as = 'tb_tpq as tpq';
        $params_tpq->select_values = array('tpq.id as id', 'tpq.nama as nama', 'tpq.wilayah as wilayah');
        $tpq = $this->data_model->get($params_tpq);
        return $tpq;
    }

    public function get_kat_pgrs() {
        $params_kat_pgrs = new stdClass();
        $params_kat_pgrs->dest_table_as = 'tb_kategori_pengurus_tpq';
        $params_kat_pgrs->select_values = array('*');
        $get_kat_pgrs = $this->data_model->get($params_kat_pgrs);
        return $get_kat_pgrs;
    }

    //Data on Page
    public function data() {
        $this->data['title_page'] = "Data Siswa";
        $dest_table_as = 'tb_siswa as s';
        $select_values = array('s.*,t.nama as nama_tpq, t.wilayah');
        $join_data1 = array("join_with" => 'tb_tpq as t', "join_on" => 's.id_tpq = t.id', "join_type" => '');
        $join_tables = array($join_data1);
        $params = new stdClass();
        $params->dest_table_as = $dest_table_as;
        $params->select_values = $select_values;
        $params->join_tables = $join_tables;
        $get = $this->data_model->get($params);
        // print_r($get);exit();
        if ($get['results'] != "") {
            $this->data['record'] = $get['results'];
        } else {
            $this->data['record'] = [];
        }

        $this->data['data_table'] = true;
        $this->display('admin/siswa/data');
    }

    public function detail() {
        $parameter = $this->uri->segment(4);
        $params = new stdClass();
        $params->dest_table_as = 'tb_siswa as s';
        $params->select_values = array('s.*');
        $join1 = array("join_with" => 'tb_tpq as t', "join_on" => 's.id_tpq = t.id', "join_type" => '');
        $params->join_tables = array($join1);
        $params->where_tables = array(array("where_column" => 's.link', "where_value" => $parameter));
        $get = $this->data_model->get($params);
        if ($get["results"][0] != "") {
            $get_tpq = $this->get_tpq();
            $this->data['title_page'] = "Detail Siswa";
            $image = $get['results'][0]->foto;
            $get["results"][0]->foto_old = $get['results'][0]->foto;
            $image_dir = IMAGE_PATH . 'tpq/' . $get['results'][0]->id_tpq . '/siswa/' . $get['results'][0]->foto;
            $check_thumb = check_if_empty($image, $image_dir);
            $get["results"][0]->foto = BASE_URL . $check_thumb;
            if ($get["results"][0]->kategori != "") {
                $params_pdkn = new stdClass();
                $params_pdkn->dest_table_as = 'tb_siswa_pendidikan as sp';
                $params_pdkn->select_values = array('sp.jenjang,sp.tingkat,sp.keterangan');
                $params_pdkn->where_tables = array(array("where_column" => 'sp.id_siswa', "where_value" => $get["results"][0]->id));
                $get_pdkn = $this->data_model->get($params_pdkn);
            }
            $this->data['detail'] = array("data_siswa" => $get["results"], "data_tpq" => $get_tpq["results"], "data_pdkn" => $get_pdkn["results"][0]);
            $this->display('admin/siswa/detail');            
        } else {
            redirect('/admin/404');
        }
    }

    public function add() {
        $tpq = $this->get_tpq();
        if ($tpq['response'] == OK_STATUS) {
            $this->data['tpq'] = $tpq['results'];
        } else {
            $this->data['tpq'] = "";
        }
        $this->data['title_page'] = "Tambah Data Siswa";
        $view_location = 'admin/siswa/add';
        $this->display($view_location);
    }

    //Data Processing

    public function add_submit() {
        $nama = $this->input->post("nama");
        $kelamin = $this->input->post("kelamin");
        $tmp_lhr = $this->input->post("tmp_lahir");
        $tgl_lhr = $this->input->post("tgl_lahir");
        $pkwn = $this->input->post("pkwn");
        $tpq = $this->input->post("tpq");
        $kontak = $this->input->post("kontak");
        $alamat = $this->input->post("alamat");
        $link = str_replace('.', '', $nama);
        $link = str_replace("'", '', $link);
        $link = str_replace('"', '', $link);
        $link = str_replace('-', '', $link);
        $link = str_replace(' ', '', $link);
        $link = strtolower($link);
        $link_fix = substr($link, 0, 10);
//        //CHECK NAME
        $params_check = new stdClass();
        $params_check->dest_table_as = 'tb_siswa as p';
        $params_check->select_values = array('p.link', 'p.id');
        $where_data = array("where_column" => 'p.link', "where_value" => $link_fix);
        $params_check->where_tables = array($where_data);
        $check = $this->data_model->get($params_check);
        if (!empty($check['results'])) {
            if ($check['results'][0]->id != $id) {
                $link_fix = substr($link, 0, 11);
            }
        }

        $params_data = array(
            "nama" => $nama,
            "id_tpq" => $tpq,
            "link" => $link,
            "kontak" => $kontak,
            "alamat" => $alamat,
            "pkwn" => $pkwn,
            "kelamin" => $kelamin,
            "tmp_lahir" => $tmp_lhr,
            "tgl_lahir" => $tgl_lhr,
            "aktif" => 'A',
            "tgl_buat" => date("Y-m-d"),
            "dibuat_oleh" => "admin");
        $dest_table = 'tb_siswa';
        $add = $this->data_model->add($params_data, $dest_table);
        $id = $add['data'];

        if (isset($_FILES["foto"])) {
            if ($_FILES["foto"] != "") {
                $upload = image_upload($_FILES["foto"], '1', "assets/images/backend/tpq/" . $tpq . "/siswa/");
                $image_name = $upload[0];
            } else {
                $image_name = "";
            }
        } else {
            $image_name = "";
        }

        $params_update = new stdClass();
        $params_update->new_data = array("foto" => $image_name);
        $params_update->table_update = 'tb_siswa';
        $where = array("where_column" => 'id', "where_value" => $id);
        $params_update->where_tables = array($where);
        $update = $this->data_model->update($params_update);
        if ($add['response'] == OK_STATUS) {
            $data = array("link" => base_url() . 'admin/siswa/detail/' . $link);
            $result = get_success($data);
        } else {
            $result = response_fail();
        }

        echo json_encode($result);
    }

    public function update_submit() {
        $id = $this->input->post("id");
        $nama = $this->input->post("nama");
        $kelamin = $this->input->post("kelamin");
        $kategori = $this->input->post("kategori");
        $tmp_lhr = $this->input->post("tmp_lahir");
        $tgl_lhr = $this->input->post("tgl_lahir");
        $pkwn = $this->input->post("pkwn");
        $sts = $this->input->post("sts");
        $tpq = $this->input->post("tpq");
        $old_tpq = $this->input->post("old_tpq");
        $kontak = $this->input->post("kontak");
        $alamat = $this->input->post("alamat");
        $old_foto = $this->input->post("old_foto");
        $link = str_replace('.', '', $nama);
        $link = str_replace("'", '', $link);
        $link = str_replace('"', '', $link);
        $link = str_replace('-', '', $link);
        $link = str_replace(' ', '', $link);
        $link_fix = strtolower($link);
        $link = substr($link_fix, 0, 10);
        $jenjang = $this->input->post("jenjang");
        $ket_jenjang = $this->input->post("ket_jenjang");
        $tingkat = $this->input->post("tingkat");
        $aktif = $this->input->post("aktif");
        //CHECK NAME
        $params_check = new stdClass();
        $params_check->dest_table_as = 'tb_siswa as p';
        $params_check->select_values = array('p.link', 'p.id');
        $where_data = array("where_column" => 'p.link', "where_value" => $link);
        $params_check->where_tables = array($where_data);
        $check = $this->data_model->get($params_check);
        if (!empty($check['results'])) {
            if ($check['results'][0]->id != $id) {
                $link = substr($link_fix, 0, 11);
            }
        }


        //Update Data
        $params_data = new stdClass();
        $params_data->new_data = array(
            "nama" => $nama,
            "id_tpq" => $tpq,
            "link" => $link,
            "kontak" => $kontak,
            "alamat" => $alamat,
            "kelamin" => $kelamin,
            "tmp_lahir" => $tmp_lhr,
            "tgl_lahir" => $tgl_lhr,
            "kategori" => $kategori,
            "pkwn" => $pkwn,
            "aktif" => $aktif,
            "tgl_ubah" => date("Y-m-d"),
            "diubah_oleh" => "admin");
        $where = array("where_column" => 'id', "where_value" => $id);
        $params_data->where_tables = array($where);
        $params_data->table_update = 'tb_siswa';
        $update_tpq = $this->data_model->update($params_data);
        //Update Pendidikan
        $params_pdkn = new stdClass();
        $params_pdkn->new_data = array(
            "id_siswa" => $id,
            "jenjang" => $jenjang,
            "tingkat" => $tingkat,
            "keterangan" => $ket_jenjang,
            "tgl_ubah" => date("Y-m-d"),
            "diubah_oleh" => "admin");
        $where = array("where_column" => 'id_siswa', "where_value" => $id);
        $params_pdkn->where_tables = array($where);
        $params_pdkn->table_update = 'tb_siswa_pendidikan';
        $params_pdkn->update_pdkn = $this->data_model->update($params_pdkn);        
        if (isset($_FILES["foto"])) {
            if (!empty($_FILES["foto"]["name"])) {
                $upload = image_upload($_FILES["foto"], '1', "assets/images/backend/tpq/" . $tpq . "/siswa/");
                if ($tpq != $old_tpq) {
                    $old_dir = './assets/images/backend/tpq/' . $old_tpq . '/siswa/' . $old_foto;
                    $remove = unlink($old_dir);
                } else {
                    $old_dir = './assets/images/backend/tpq/' . $tpq . '/siswa/' . $old_foto;
                    $remove = unlink($old_dir);
                }
                $image_name = $upload[0];
            } else {
                $image_name = $old_foto;
            }
        } else {
            if ($tpq != $old_tpq) {
                $old_dir = './assets/images/backend/tpq/' . $old_tpq . '/siswa/' . $old_foto;
                $new_dir = './assets/images/backend/tpq/' . $tpq . '/siswa/' . $old_foto;
                $remove = copy($old_dir, $new_dir);
                $remove = unlink($old_dir);
            }
            $image_name = $old_foto;
        }
        //Update foto 
        $params_update = new stdClass();
        $params_update->new_data = array("foto" => $image_name);
        $where = array("where_column" => 'id', "where_value" => $id);
        $params_update->where_tables = array($where);
        $params_update->table_update = 'tb_siswa';
        $update_logo_cover = $this->data_model->update($params_update);
        if ($update_tpq['response'] == OK_STATUS) {
            //            $result = response_success();
            $params = new stdClass();
            $params->response = OK_STATUS;
            $params->message = OK_MESSAGE;
            $params->data = array('link' => base_url() . 'admin/siswa/detail/' . $link);
            $result = response_custom($params);
        } else {
            $result = response_fail();
        }
        echo json_encode($result);
    }

    public function delete_submit() {
        $id = $this->uri->segment(4);
        $params_delete_siswa = new stdClass();
        $where1 = array("where_column" => 'id', "where_value" => $id);
        $params_delete_siswa->where_tables = array($where1);
        $params_delete_siswa->table = 'tb_siswa';
        $delete_siswa = $this->data_model->delete($params_delete_siswa);

        $params_delete_akun = new stdClass();
        $params_delete_akun->table = 'tb_akun';
        $where1 = array("where_column" => 'level', "where_value" => 'P');
        $where2 = array("where_column" => 'id_level', "where_value" => $id);
        $params_delete_akun->where_tables = array($where1, $where2);
        $delete_akun = $this->data_model->delete($params_delete_akun);

        if ($delete_siswa['response'] == OK_STATUS && $delete_akun['response'] == OK_STATUS) {
            $result = response_success();
        } else {
            $result = response_fail();
        }
        echo json_encode($result);
    }

}
