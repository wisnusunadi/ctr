<html>

<head>

</head>

<body>
    <h3>Laporan Nilai</h3>
    <table class="table align-center" id="showtable" border="1" style="width: 100%; border-collapse: collapse;">
        <thead>
            <tr>
                <th>No Induk</th>
                <th>Nama</th>
                <th width="5%">Kelas</th>
                <th width="30%">Tgl Lahir</th>
                <th>Jenis Kelamin</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td> <?= $murid['no_induk'] ?></td>
                <td><?= $murid['nama'] ?></td>
                <td><?= $murid['kelas'] ?></td>
                <td><?= $murid['tgl_lahir'] ?></td>
                <td><?= $murid['jenis'] == 'p' ? 'Perempuan' : 'Laki laki' ?></td>
            </tr>
        </tbody>
    </table>
    <br>
    <table class="table align-center" id="showtable" border="1" style="width: 100%; border-collapse: collapse;">
        <thead>
            <tr>
                <th width="2%">No</th>
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

</body>

</html>