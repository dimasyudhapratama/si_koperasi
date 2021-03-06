<script>
    // function ambilUang(id){
        // if (window.confirm('Anda Yakin Untuk Mencairkan Uang?')){
        //     $.ajax({
    //         url: "<?php echo base_url() . 'index.php/simpanan_pokok/edit'; ?>",
    //         type: "POST",
    //         data: {
    //             id: id
    //         },
    //         success: function(ajaxData) {
    //             $("#modaledit").html(ajaxData);
    //             $("#modaledit").modal('show', {
    //                 backdrop: 'true'
    //             });
    //         }
    //     });
        // }else{
            // They clicked no
        // }
    // }
    function ambilUang(id) {
        $.ajax({
            url: "<?php echo base_url() . 'index.php/simpanan_pokok/ambilUang'; ?>",
            type: "POST",
            data: {
                id: id
            },
            success: function(ajaxData) {
                $("#modaledit").html(ajaxData);
                $("#modaledit").modal('show', {
                    backdrop: 'true'
                });
            }
        });
    }

    function manageAjax() {
        var no_anggota_field = $("#no_anggota").val()
        $.ajax({
            url: "<?php echo base_url() . 'index.php/simpanan_pokok/manageajaxgetdataanggota'; ?>",
            type: "POST",
            data: {
                id: no_anggota_field
            },
            success: function(ajaxData) {
                $('.data-ajax').html(ajaxData);
            }
        });
    }
</script>
<!-- BreadCumb -->

<!-- Content -->
<div class="container-fluid">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo base_url() . 'index.php/dashboard' ?>">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Simpanan Pokok</li>
        </ol>
    </nav>
    <!-- Simpanan Pokok -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data Simpanan Pokok</h6>
        </div>
        <div class="card-body">
            <?php
            echo $this->session->flashdata("input_success");
            echo $this->session->flashdata("input_failed");
            echo $this->session->flashdata("update_success");
            echo $this->session->flashdata("update_failed");
            echo $this->session->flashdata("delete_success");
            echo $this->session->flashdata("delete_failed");
            ?>
            <button class="btn btn-primary btn-sm float-right" data-toggle="modal" data-target="#myModal" style="margin-bottom:10px;"><i class="icofont-plus-circle"></i> Tambah</button>
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th class="text-center">No.</th>
                            <th class="text-center">No. Anggota</th>
                            <th class="text-center">Nama Anggota</th>
                            <th class="text-center">Tanggal</th>
                            <th class="text-center">Jumlah</th>
                            <th class="text-center">Status Dana</th>
                            <th class="text-center">Teller</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($simpanan_pokok as $s) {
                            ?>
                            <tr>
                                <td class="text-center"><?php echo $no++."."; ?></td>
                                <td><?php echo $s->no_anggota; ?></td>
                                <td><?php echo $s->nama; ?></td>
                                <td><?php echo $s->tanggal_pembayaran; ?></td>
                                <td class="text-right"><?php echo number_format($s->jumlah,0,',','.'); ?></td>
                                <td class="text-center">
                                    <?php
                                        if($s->status_dana == "Aktif"){
                                            echo "<span class='badge badge-primary'>Aktif</span>";
                                        }else if($s->status_dana == "Diambil"){
                                            echo "<span class='badge badge-danger'>Diambil</span>";
                                        }
                                    ?> 
                                </td>
                                <td><?php echo $s->nama_terang; ?></td>
                                <td style="text-align:center;">
                                    
                                    <button type="button" class="btn btn-sm btn-success" onclick="ambilUang(<?php echo $s->id_simpanan_pokok; ?>)" <?php if($s->status_dana == "Diambil"){echo "disabled";} ?>><i class="icofont-money"></i></button>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    

</div>
<!-- The Modal -->
<!-- Buat Form Tambahnya-->
<div class="modal" id="myModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <form name="tambah-pelanggan" method="POST" action="<?php echo base_url(); ?>index.php/Simpanan_pokok/add">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Tambah Simpanan Pokok</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <!-- Modal body -->
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group-inner">
                                <label for="">No. Anggota</label>
                                <select name="no_anggota" style="width: 100%" id="no_anggota" class="form-control select2_" onchange="manageAjax()" required>
                                    <option value="">--Pilih--</option>
                                    <?php foreach ($anggota as $a) { ?>
                                        <option value="<?php echo $a->no_anggota; ?>"><?php echo $a->no_anggota . ' - ' . $a->nama ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 data-ajax">

                        </div>
                        <div class="col-md-6">
                            <div class="form-group-inner">
                                <label for="" class="pull-left">Tanggal Bayar</label>
                                <input type="date" name="tanggal_pembayaran" class="form-control form-control-sm">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group-inner">
                                <label for="" class="pull-left">Jumlah</label>
                                <input type="number" name="jumlah" class="form-control form-control-sm">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="reset" class="btn btn-danger btn-sm">Reset</button>
                    <input type="submit" class="btn btn-primary btn-sm" value="Simpan" />
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal" id="modaledit">
    
</div>
<script>
    $(document).ready(function() {
        $('.select2_').select2({
            theme: 'bootstrap4',
        });
    });
</script>