<?php

class admin extends CI_Controller {

  function __construct() {
    parent::__construct();
    $this->load->library(array('curl', 'session'));
    $this->load->helper(array('form', 'url', 'jwt_helper', 'rest_response_helper', 'key_helper', 'image_process_helper', 'file'));
    $this->data = [];
    $this->load->model('data_model');
    $this->checkauth();
  }

  public function checkauth() {
    if ($this->session->userdata('web_token') == "") {
      redirect('login');
      exit();
    } else {
      $decode = JWT::decode($this->session->userdata('web_token'), SERVER_SECRET_KEY, JWT_ALGHORITMA);
      if ($decode->response != OK_STATUS) {
        redirect('login');
        exit;
      } else {
        if ($decode->data->role != "A") {
          redirect('login');
          exit;
        }
      }
    }
  }


  public function display($location, $function_location = NULL,$table = NULL ) {
    // $this->data ['menu'] = $this->menu ();
    // $this->data ['site'] = $this->site ();
    $this->load->view ( 'admin/include/head', $this->data );
    $this->load->view('static/files');
    $this->load->view ( 'admin/include/ajax' );
    if($table == TRUE){
      $this->load->view ( 'static/table' );
    }
    $this->load->view ( 'admin/include/function' );
    $this->load->view ( 'admin/include/modal' );
    $this->load->view ( 'admin/include/sidebar_menu' );
    $this->load->view ( 'admin/include/top_menu' );
    $this->load->view ( $location );
    if($function_location == TRUE){
      $this->load->view ( $function_location );
    }
    $this->load->view ( 'admin/include/footer_menu' );
  }

  public function dashboard() {
    $this->data['active_page'] = "dashboard";
    $this->data['title_page'] = "Dashboard";
    $this->display('admin/dashboard/index');
  }

  public function notfound() {
    $this->data['active_page'] = "notfound";
    $this->data['title_page'] = "Tidak ditemukan";
    $this->load->view('admin/404', $this->data);
  }

  public function menu() {
    $dashboard = array (
      "label" => "Dashboard",
      "link" => site_url () . 'admin/',
      "page_name" => "dashboard",
      "icon" => "mdi mdi-view-dashboard mdi-24px"
    );
    $setting = array (
      "label" => "Pengaturan",
      "link" => site_url () . 'admin/setting/',
      "page_name" => "setting",
      "icon" => "ti-settings"
    );

    $merchant = array (
      "label" => "Merchant",
      "link" => site_url () . 'admin/merchant/',
      "page_name" => "merchant",
      "icon" => "fa fa-users 1x"
    );

    $product_category = array (
      "label" => "Kategori Produk",
      "link" => site_url () . 'admin/product_category/',
      "page_name" => "product_category",
      "icon" => "fa fa-cube 1x"
    );

    $products = array (
      "label" => "Produk",
      "link" => site_url () . 'admin/product/',
      "page_name" => "product",
      "icon" => "fa fa-cubes 1x"
    );

    $socmed = array (
      "label" => "Sosial Media",
      "link" => site_url () . 'admin/socmed/',
      "page_name" => "socmed",
      "icon" => "fa fa-share-alt 1x"
    );

    $merchant_promo = array (
      "label" => "Merchant Promo",
      "link" => site_url () . 'admin/merchant_promo/',
      "page_name" => "merchant_promo",
      "icon" => "fa fa-tags 1x"
    );

    $gallery = array (
      "label" => "Galeri Kegiatan",
      "link" => site_url () . 'admin/gallery/',
      "page_name" => "gallery",
      "icon" => "fa fa-picture-o 1x"
    );

    $slider = array (
      "label" => "Slider",
      "link" => site_url () . 'admin/slider/',
      "page_name" => "slider",
      "icon" => "fa fa-desktop 1x"
    );

    $testimoni = array (
      "label" => "Testimoni",
      "link" => site_url () . 'admin/testimoni/',
      "page_name" => "testimoni",
      "icon" => "fa fa-commenting-o 1x"
    );

    $array = [
      $dashboard,
      $merchant,
      $merchant_promo,
      $product_category,
      $products,
      $gallery,
      $testimoni,
      $slider,
      $socmed,
      $setting ,
    ];

    return $array;
  }

}
