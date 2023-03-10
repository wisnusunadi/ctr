<?= $this->extend('partial/master') ?>
<?= $this->section('content') ?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Mata Pelajaran</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/admin">Dashboard</a></li>
                        <li class="breadcrumb-item active">Mata Pelajaran</li>
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
                <div class="col-8">
                    <div class="card">
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
                        <div class="card-header">
                            <div class="row">
                                <div class="col-6">
                                    <a type="button" class="btn btn-info" href="/mapel/create">
                                        <i class="fas fa-plus"></i>&nbsp;Tambah
                                    </a>
                                </div>
                                <div class="col-6">
                                    <form action="" method="get">
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control" placeholder="Ketik di sini" aria-describedby="button-addon2" name="keyword">
                                            <div class="input-group-append">
                                                <button class="btn btn-outline-secondary" type="submit" id="button-addon2">Cari</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                            </div>


                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th width="1%">No</th>
                                        <th>ID Mapel</th>
                                        <th>Nama Pelajaran</th>
                                        <th>Kelas</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1 + (5 * ($currPage - 1)); ?>
                                    <?php foreach ($mapel as $k) : ?>
                                        <tr>
                                            <td><?= $i++; ?></td>
                                            <td><?= $k['kode_mapel']; ?></td>
                                            <td><?= $k['nama_mapel']; ?></td>
                                            <td>Kelas <?= $k['kelas']; ?></td>
                                            <td>
                                                <a type="button" class="btn btn-warning <?= $k['nama_guru'] == NULL ? 'disabled' : '' ?>" href="/mapel/nilai/<?= $k['id']; ?>" disabled>
                                                    <i class="fas fa-eye"></i>&nbsp;Nilai
                                                </a>
                                                &nbsp;
                                                <a type="button" class="btn btn-info" href="/mapel/edit/<?= $k['id'] ?>">
                                                    <i class="fas fa-pencil-alt"></i>&nbsp;Edit
                                                </a>
                                                &nbsp;
                                                <form action="/mapel/delete/<?= $k['id']; ?>" class="d-inline" method="post">
                                                    <?= csrf_field() ?>
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Yakin di hapus ?')">
                                                        <i class="fas fa-trash"></i>&nbsp;Hapus
                                                    </button>
                                                </form>
                                            </td>
                                            <!--  -->
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                            </br>
                            <?= $pager->links('mapel', 'custom_pagination') ?>
                        </div>
                        <!-- /.card-body -->
                    </div>
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