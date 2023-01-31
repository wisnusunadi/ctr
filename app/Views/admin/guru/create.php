<?= $this->extend('partial/master') ?>
<?= $this->section('content') ?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Guru</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/admin">Dashboard</a></li>
                        <li class="breadcrumb-item "><a href="/guru">Guru</a></li>
                        <li class="breadcrumb-item active">Tambah</li>
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
                <div class="col-6">
                    <!-- /.card-header -->
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
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">Tambah Guru</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->


                        <form class="form-horizontal" action="/guru" method="POST">
                            <?= csrf_field() ?>
                            <div class="card-body">
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Nomor Induk</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="inputEmail3" placeholder="ID Guru" name="no_induk">
                                    </div>

                                </div>
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Nama</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="inputEmail3" placeholder="Nama Guru" name="nama">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputPassword3" class="col-sm-2 col-form-label">Tgl Lahir</label>
                                    <div class="col-sm-10">
                                        <input type="date" class="form-control" id="inputPassword3" placeholder="Password" name="tgl_lahir">
                                    </div>
                                </div>
                                <!-- <div class="form-group row">
                                    <label for="inputPassword3" class="col-sm-2 col-form-label">Jenis Kelamin</label>
                                    <div class="col-sm-10">
                                        <input class="form-check-input" type="radio" name="radio1">
                                        <label class="form-check-label">Radio</label>
                                    </div>
                                </div> -->
                                <div class="form-group row">
                                    <div class="offset-sm-2 col-sm-10">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="jenis" value="l">
                                            <label class="form-check-label" for="exampleCheck2">Laki Laki</label>
                                        </div>
                                    </div>
                                    <div class="offset-sm-2 col-sm-10">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="jenis" value="p">
                                            <label class="form-check-label" for="exampleCheck2">Perempuan</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputPassword3" class="col-sm-2 col-form-label">Mata Pelajaran</label>
                                    <div class="col-sm-10">
                                        <select class="select2 form-control" id="inputPassword3" placeholder="Password" name="mata_pelajaran_id">
                                            <?php foreach ($mapel as $m) : ?>
                                                <option value="<?= $m['id'] ?>"><?= $m['nama'] ?> - Kelas <?= $m['kelas'] ?> </option>
                                            <?php endforeach ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" class="btn btn-info">Tambah</button>
                                <a type="submit" class="btn btn-default float-right" href="/guru">Batal</a>
                            </div>
                            <!-- /.card-footer -->
                        </form>
                    </div>
                    <!-- /.card-body -->
                    <!-- /.card -->
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<?= $this->endSection() ?>