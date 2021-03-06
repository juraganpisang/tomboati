<body>
    <header class="page-header page-header-dark bg-gradient-primary-to-secondary pb-10">
        <div class="container">
            <div class="page-header-content pt-4">
                <div class="row align-items-center justify-content-between">
                    <div class="col-auto mt-4">
                        <h1 class="page-header-title">
                        <div class="page-header-icon"><i data-feather="activity"></i></div>
                        <?= $title; ?>
                        </h1>
                        Daftar Paket
                    </div>
                </div>
            </div>
        </div>
    </header>
    <div class="container mt-n10">
        <div class="card mb-4">
            <div class="card-header">
                <?= $this->session->flashdata('message'); ?>
                <a href="<?= base_url('Umroh/tambahPaket/'.$tipe); ?>" class='btn btn-primary btn-sm' type='submit'><i class="fa fa-plus mr-1"></i>Tambah Paket</a>
                <a href="<?= base_url('Maskapai'); ?>" class='btn btn-success btn-sm' type='submit'><i class="fa fa-cog mr-1"></i>Kelola Maskapai</a>
            </div>
            <div class="card-body">
                <div class="datatable">
                    <?php
                    $template = array('table_open' => '<table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">');
                        $this->table->set_template($template);
                        $this->table->set_heading('No', 'Status', 'Nama Paket', 'Maskapai', 'Durasi Paket', 'Kuota', 'Aksi');
                        $no = 1;
                        foreach ($paket as $row) {
                        if($row->ISSHOW == 1){
                        $verfikasi = '<button title="Non-Aktifkan Paket" type="button" class="btn btn-danger" data-toggle="modal" data-target="#nonAktifPaketModal'.$row->IDPAKET.'"><i class="fa fa-times-circle"></i>
                        </button>'; 
                        $status = '<span class="badge badge-pill badge-success">Aktif</span>';
                        }else{
                        $verfikasi = '<button title="Aktifkan Paket" type="button" class="btn btn-primary" data-toggle="modal" data-target="#aktifPaketModal'.$row->IDPAKET.'"><i class="fa fa-check"></i>
                        </button>';
                        $status = '<span class="badge badge-pill badge-danger">Non-Aktif</span>';
                        }
                        $this->table->add_row(
                        $no++,
                        $status,
                        $row->NAMAPAKET,
                        $row->NAMAMASKAPAI,
                        $row->DURASIPAKET .' hari',
                        $row->KUOTA .' orang',
                        $verfikasi.
                        '<button title="Detail Paket" type="button" class="btn btn-primary ml-1" data-toggle="modal" data-target="#detailPaketModal'.$row->IDPAKET.'"><i class="fa fa-ellipsis-h"></i>
                        </button><br>
                        <a title="Edit Paket" href="'.  base_url("Umroh/editPaket/".$row->IDPAKET).'" type="button" class="btn btn-warning mt-1"><i class="fa fa-edit"></i>
                        </a>
                        <button title="Hapus Paket" type="button" class="btn btn-danger mt-1" data-toggle="modal" data-target="#hapusPaketModal'.$row->IDPAKET.'"><i class="fa fa-trash"></i>
                        </button>'
                        );
                        ?>
                        <!-- Modal Detail -->
                        <div class="modal fade" id="detailPaketModal<?= $row->IDPAKET?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Detail <?= $row->NAMAPAKET; ?> </h5>
                                        <?php if($row->ISSHOW == 1){
                                        ?>
                                        <span class="badge badge-pill badge-success ml-1">Aktif</span>
                                        <?php
                                        }else{
                                        ?>
                                        <span class="badge badge-pill badge-danger ml-1">Non-Aktif</span>
                                        <?php
                                        }
                                        ?>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col">
                                                <div class="form-group">
                                                    <label for="namaPaket">Nama Paket Umroh <?= $tipe; ?></label>
                                                    <h5><?= $row->NAMAPAKET; ?></h5>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <label for="kuota">Kuota</label>
                                                    <h5><?= $row->KUOTA; ?> orang</h5>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="maskapai">Maskapai</label>
                                            <h5><?= $row->NAMAMASKAPAI; ?></h5>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <div class="form-group">
                                                    <label for="durasiPaket">Durasi Paket</label>
                                                    <h5><?= $row->DURASIPAKET; ?> hari</h5>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <label for="tanggalKeberangkatan">Tanggal Keberangkatan</label>
                                                    <h5><?= $row->TANGGALKEBERANGKATAN; ?></h5>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <div class="form-group">
                                                    <label for="penerbangan">Penerbangan</label>
                                                    <h5><?= $row->PENERBANGAN; ?></h5>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <label for="ratingHotel">Rating Hotel</label>
                                                    <h5><?= $row->RATINGHOTEL; ?></h5>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <div class="form-group">
                                                    <label for="namaHotelPertama">Nama Hotel Pertama</label>
                                                    <h5><?= $row->NAMAHOTELA; ?></h5>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <label for="namaHotelKedua">Nama Hotel Kedua</label>
                                                    <h5><?= $row->NAMAHOTELB; ?></h5>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <div class="form-group">
                                                    <label for="alamatHotelPertama">Alamat Hotel Pertama</label>
                                                    <h5><?= $row->TEMPATHOTELA; ?></h5>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <label for="alamatHotelKedua">Alamat Hotel Kedua</label>
                                                    <h5><?= $row->TEMPATHOTELB; ?></h5>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <div class="form-group">
                                                    <label for="doubleSheet">Harga Double Sheet</label>
                                                    <h5>Rp. <?= $row->DOUBLESHEET; ?></h5>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <label for="tripleSheet">Harga Triple Sheet</label>
                                                    <h5>Rp. <?= $row->TRIPLESHEET; ?></h5>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <label for="quadSheet">Harga Quad Sheet</label>
                                                    <h5>Rp. <?= $row->QUADSHEET; ?></h5>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="biayaSudahTermasuk">Biaya Sudah Termasuk</label>
                                            <h5><?= $row->BIAYASUDAHTERMASUK; ?></h5>
                                        </div>
                                        <div class="form-group">
                                            <label for="biayaBelumTermasuk">Biaya Belum Termasuk</label>
                                            <h5><?= $row->BIAYABELUMTERMASUK; ?></h5>
                                        </div>
                                        <h5>Gambar Paket</h5>
                                        <div class="form-group">
                                            <img src="<?= $row->IMAGEPAKET;?>" width="200px">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <?php if($row->ISSHOW == 1){
                                            ?>
                                            <a href="<?= base_url('Umroh/aksiNonAktifPaket/'.$row->IDPAKET) ?>" type="button" class="btn btn-danger"><i class="fa fa-check mr-1"></i>Non-Aktifkan</a>
                                        <?php
                                        }else{
                                        ?>                                  
                                            <a href="<?= base_url('Umroh/aksiAktifPaket/'.$row->IDPAKET) ?>" type="button" class="btn btn-success"><i class="fa fa-check mr-1"></i>Aktifkan</a>
                                        <?php
                                        }
                                        ?>
                                        <a href="<?= base_url('Umroh/editPaket/'.$row->IDPAKET) ?> " type="button" class="btn btn-warning"><i class="fa fa-edit mr-1"></i> Edit</a>
                                        <button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-times mr-1"></i> Tutup</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Modal Hapus -->
                        <div class="modal fade" id="hapusPaketModal<?= $row->IDPAKET; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Hapus <?= $title ?></h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <h5>Apakah anda yakin akan menghapus <b> <?= $row->NAMAPAKET ?> ? </b></h5>
                                    </div>
                                    <div class="modal-footer">
                                        <a href="<?= base_url('Umroh/aksiHapusPaket/'.$row->IDPAKET) ?>" type="button" class="btn btn-danger"><i class="fa fa-trash mr-1"></i>Hapus</a>
                                        <button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-times mr-1"></i>Tutup</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Modal Aktif -->
                        <div class="modal fade" id="aktifPaketModal<?= $row->IDPAKET; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Aktifkan Paket <?= $title ?></h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <h5>Apakah anda yakin akan mengaktifkan <b> <?= $row->NAMAPAKET ?> ?</b></h5>
                                    </div>
                                    <div class="modal-footer">
                                        <a href="<?= base_url('Umroh/aksiAktifPaket/'.$row->IDPAKET) ?>" type="button" class="btn btn-success"><i class="fa fa-check mr-1"></i>Aktifkan</a>
                                        <button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-times mr-1"></i>Tutup</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Modal Non-Aktif -->
                        <div class="modal fade" id="nonAktifPaketModal<?= $row->IDPAKET; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Cabut Verifikasi <?= $title ?></h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <h5>Apakah anda yakin akan menonaktifkan <b> <?= $row->NAMAPAKET ?> ?</b></h5>
                                    </div>
                                    <div class="modal-footer">
                                        <a href="<?= base_url('Umroh/aksiNonAktifPaket/'.$row->IDPAKET) ?>" type="button" class="btn btn-danger"><i class="fa fa-check mr-1"></i>Non-Aktifkan</a>
                                        <button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-times mr-1"></i>Tutup</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                        }
                        echo $this->table->generate();
                        ?>
                    </div>
                </div>
            </div>
        </div>
</body>
<script>
    Pusher.logToConsole = true;

    var pusher = new Pusher('ee692ab95bb9aeaa1dcc', {
      cluster: 'ap1',
      forceTLS: true
    });

    var channel = pusher.subscribe('my-channel');
    channel.bind('my-event', function(response) {
        xhr=$.ajax({    
                method: 'POST',
                url: "<?php echo base_url()?>/Notifikasi/listNotifikasi",
                success : function(response){
                    $('.list-notifikasi').html(response);
                }
            })
    });

    $('.list-notifikasi').on('click','.notifikasi', function(e) {
        console.log("Clicked");
    });
    
</script>