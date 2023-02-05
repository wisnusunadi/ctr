<?= $this->extend('partial/master') ?>
<?= $this->section('content') ?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Dashboard</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item active">Dashboard</li>

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
                <div class="col-md-3">

                    <!-- Profile Image -->
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <div class="text-center">
                                <img class="profile-user-img img-fluid img-circle" src="<?= base_url('theme/dist/img/unknown.png') ?>" alt="User profile">
                            </div>
                            <h3 class="profile-username text-center"><?= $murid['nama'] ?></h3>

                            <p class="text-muted text-center">Kelas <?= $murid['kelas'] ?></p>

                            <ul class="list-group list-group-unbordered mb-3">
                                <li class="list-group-item">
                                    <b>No Induk</b> <a class="float-right"> <?= $murid['no_induk'] ?></a>
                                </li>
                                <li class="list-group-item">
                                    <b>Tgl Lahir</b> <a class="float-right"> <?= $murid['tgl_lahir'] ?></a>
                                </li>
                                <li class="list-group-item">
                                    <b>Jenis Kelamin</b> <a class="float-right"><?= $murid['jenis'] == 'p' ? 'Perempuan' : 'Laki laki' ?></a>
                                </li>
                            </ul>


                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->


                </div>
                <!-- /.col -->
                <div class="col-md-7">
                    <div class="card">

                        <div class="card-body">
                            <div class="tab-content">
                                <div class="active tab-pane" id="activity">
                                    <div class="card">
                                        <a type="button" class="btn btn-info" target="_blank" href="/murids/laporan/" style="width: 20%;">
                                            <i class="fa fa-file" aria-hidden="true"></i>
                                            &nbsp;Export
                                        </a>
                                        <div class="card-body" style="overflow-y:scroll; height:400px;">
                                            <div class="table-responsive">
                                                <table class="table align-center" id="showtable" style="width: 100%;">
                                                    <thead>
                                                        <tr>
                                                            <th>No</th>
                                                            <th>Kode</th>
                                                            <th width="50%">Mata Pelajaran</th>
                                                            <th>Nilai</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php $i = 1;
                                                        $total_nilai = 0; ?>
                                                        <?php foreach ($data_nilai as $b) : ?>
                                                            <tr>
                                                                <td><?= $i++; ?></td>
                                                                <td><?= $b->kode_mapel; ?></td>
                                                                <td><?= $b->nama_mapel; ?></td>
                                                                <td><?= $b->nilai; ?></td>
                                                            </tr>
                                                            <?php $total_nilai += intVal($b->nilai); ?>
                                                        <?php endforeach; ?>
                                                    </tbody>
                                                    <tfoot>
                                                        <tr>
                                                            <th scope="row" colspan="3">Rata Rata</th>
                                                            <td><b><?= $total_nilai / count($data_nilai); ?></b></td>
                                                        </tr>
                                                    </tfoot>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <!-- /.tab-content -->
                        </div><!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>

        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<?= $this->endSection() ?>