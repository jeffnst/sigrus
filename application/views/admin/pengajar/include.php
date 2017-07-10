<html>

    <?php
    $this->load->view('admin/include/head');
    $this->load->view('admin/include/function');
    $this->load->view('admin/include/modal');
    $this->load->view('admin/include/top_menu');
    $this->load->view('admin/include/sidebar_menu');
    $this->load->view('admin/pengajar/function');
    $this->load->view('admin/pengajar/modal');
    ?>

    <link href="<?= BACKEND_STATIC_FILES ?>plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />
    <script src="<?= BACKEND_STATIC_FILES ?>plugins/bootstrap-select/js/bootstrap-select.js"></script>        
    <script src="<?= BACKEND_STATIC_FILES ?>plugins/momentjs/moment.js"></script>        
    <link href="<?= BACKEND_STATIC_FILES ?>plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css" rel="stylesheet" />
    <script src="<?= BACKEND_STATIC_FILES ?>plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js"></script>        

    <!--CHECK DATA TABLE INCLUDE IN FOOTER-->