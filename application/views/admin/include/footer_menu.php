</body>

<?php
if (isset($data_table)) {
    $this->load->view('static/table');
    ?>
    <script>
        $('.table1').css('font-size','13px')
        $('.table1').DataTable({
            dom: 'Bfrtip',
            buttons: [
                'copy', 'excel', 'pdf', 'print'
            ]
        });               
    </script>
    <?php
}
?>