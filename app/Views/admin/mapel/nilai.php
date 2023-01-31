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
                <div class="col-lg-5 col-md-12">
                    <div class="card">
                        <div class="card-header p-2">
                            <ul class="nav nav-pills">
                                <li class="nav-item"><a class="nav-link active" href="#belum" data-toggle="tab">Belum Dinilai</a></li>
                                <li class="nav-item"><a class="nav-link" href="#sudah" data-toggle="tab">Sudah Dinilai</a></li>

                            </ul>
                        </div><!-- /.card-header -->
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="active tab-pane" id="belum">
                                    <?php
                                    $session = session();
                                    ?>
                                    <?php if ($session->getFlashdata('gagal')) { ?>
                                        <div class="alert alert-danger alert-dismissible">
                                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                            <h5><i class="icon fas fa-ban"></i> Gagal</h5>
                                            <?php echo $session->getflashdata('gagal'); ?>
                                        </div>
                                    <?php } ?>
                                    <?php if ($session->getFlashdata('sukses')) { ?>
                                        <div class="alert alert-success alert-dismissible">
                                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                            <h5><i class="icon fas fa-check"></i> Berhasil</h5>
                                            <?php echo $session->getflashdata('sukses'); ?>
                                        </div>
                                    <?php } ?>
                                    <form action="/mapel/nilai/" method="post">
                                        <?= csrf_field() ?>
                                        <input type="hidden" class="form-control" id="inputEmail3" placeholder="Nilai" name="mapel_id" style="width: 50%;" value="<?= $detail->id_mapel  ?>">
                                        <input type="hidden" class="form-control" id="inputEmail3" placeholder="Nilai" name="kelas" style="width: 50%;" value="<?= $detail->kelas  ?>">
                                        <div class="card">
                                            <div class="card-body" style="overflow-y:scroll; height:400px;">
                                                <div class="table-responsive">
                                                    <table class="table align-center" id="showtable" style="width: 100%;">
                                                        <thead>
                                                            <tr>
                                                                <th>No</th>
                                                                <th width="50%">Nama</th>
                                                                <th>Nilai</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php if (count($murid_belum) > 0) { ?>
                                                                <?php
                                                                $i = 1;
                                                                ?>
                                                                <?php foreach ($murid_belum as $m) : ?>
                                                                    <tr>
                                                                        <td class="d-none"> <input type="hidden" class="form-control" id="inputEmail3" placeholder="Nilai" name="murid_id[]" style="width: 50%;" value="<?= $m->id ?>"></td>
                                                                        <td><?= $i++ ?></td>
                                                                        <td><?= $m->nama ?></td>
                                                                        <td> <input type="text" class="form-control" id="inputEmail3" placeholder="Nilai" name="nilai[]" style="width: 50%;" min="0" max="100">
                                                                        </td>
                                                                    </tr>
                                                                <?php endforeach; ?>
                                                            <?php } else { ?>
                                                                <tr>
                                                                    <td colspan="3" style="vertical-align : middle;text-align:center;"> Data Kosong</td>
                                                                </tr>
                                                            <?php } ?>

                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <div class="card-footer">
                                                <button type="submit" class="btn btn-info">Masukkan Nilai</button>
                                                <a type="submit" class="btn btn-default float-right" href="/mapel">Batal</a>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <!-- /.tab-pane -->
                                <div class="tab-pane" id="sudah">
                                    <div class="card">
                                        <div class="card-body" style="overflow-y:scroll; height:400px;">
                                            <div class="table-responsive">
                                                <table class="table align-center" id="showtable" style="width: 100%;">
                                                    <thead>
                                                        <tr>
                                                            <th>No</th>
                                                            <th width="50%">Nama</th>
                                                            <th>Nilai</th>
                                                            <th>Aksi</th>

                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php if (count($murid_done) > 0) { ?>
                                                            <?php
                                                            $i = 1;
                                                            ?>
                                                            <?php foreach ($murid_done as $q) : ?>
                                                                <tr>
                                                                    <td><?= $i++ ?></td>
                                                                    <td><?= $q->nama_murid ?></td>
                                                                    <td><?= $q->nilai ?></td>
                                                                    <td>
                                                                        <form action="/mapel/nilai/delete/<?= $q->id; ?>" class="d-inline" method="post">
                                                                            <?= csrf_field() ?>
                                                                            <input type="hidden" name="_method" value="DELETE">
                                                                            <button type="submit" class="btn btn-danger" onclick="return confirm('Yakin di hapus ?')">
                                                                                <i class="fas fa-trash"></i>&nbsp;Hapus
                                                                            </button>
                                                                        </form>
                                                                    </td>

                                                                </tr>
                                                            <?php endforeach; ?>
                                                        <?php } else { ?>
                                                            <tr>
                                                                <td colspan="3" style="vertical-align : middle;text-align:center;"> Data Kosong</td>
                                                            </tr>
                                                        <?php } ?>

                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.tab-pane -->


                                <!-- /.tab-pane -->
                            </div>
                            <!-- /.tab-content -->
                        </div><!-- /.card-body -->
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