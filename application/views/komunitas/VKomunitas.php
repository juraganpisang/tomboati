<!DOCTYPE html>
<html lang="en">

<head>
</head>

<body>
    <header class="page-header page-header-dark bg-gradient-primary-to-secondary pb-10">
        <div class="container">
            <div class="page-header-content pt-4">
                <div class="row align-items-center justify-content-between">
                    <div class="col-auto mt-4">
                        <h1 class="page-header-title">
                            <div class="page-header-icon"><i data-feather="users"></i></div>
                            Komunitas
                        </h1>
                        <div class="page-header-subtitle">Daftar Komunitas</div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <div class="container mt-n10">
        <div class="card mb-4">
            <div class="card-header">
                <a href="<?= site_url('komunitas/tambahKomunitas'); ?>" class='btn btn-primary btn-sm' type='submit'>Tambah Komunitas</a>
            </div>
            <div class="card-body">
                <div class="datatable">
                    <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Judul News</th>
                                <th>Content News</th>
                                <th>Foto</th>
                                <th>Tanggal News</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>

                    </table>
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
</html>