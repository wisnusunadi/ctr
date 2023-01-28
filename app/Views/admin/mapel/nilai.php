<?= $this->extend('partial/master') ?>
<?= $this->section('content') ?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"></h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/admin">Dashboard</a></li>
                        <li class="breadcrumb-item "><a href="/mapel">Mata Pelajaran</a></li>
                        <li class="breadcrumb-item active">Nilai</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-4 col-md-12">
                    <h5>Info</h5>
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-12 col-md-4 align-center">
                                    <div id="profileImage" class="center margin-all"></div>
                                </div>
                                <div class="col-lg-12 col-md-8 labelinfo">
                                    <div class="margin-all">
                                        <h5><b><?= $detail->nama_mapel ?></b></h5>
                                    </div>

                                    <div class="margin-all"><a class="text-muted margin-side">Pengajar
                                            :</a><b><?= $detail->nama_guru ?></b></div>
                                    <div class="margin-all"><a class="text-muted margin-side">Kelas
                                            :</a><b><?= $detail->kelas ?></b></div>
                                    <div class="margin-all"><a class="text-muted margin-side">Jumlah Murid
                                            :</a><b>10</b></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8 col-md-12">
                    <h5>Murid</h5>
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table align-center" id="showtable" style="width: 100%;">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama</th>
                                            <th>Nilai</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<?= $this->endSection() ?>