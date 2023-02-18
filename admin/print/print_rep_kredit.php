<?php

use Dompdf\Dompdf;
use Dompdf\Options;

require '../../dompdf/vendor/autoload.php';
ob_start();
$path = '../../img/logo.png';
$type = pathinfo($path, PATHINFO_EXTENSION);
$data = file_get_contents($path);
$base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);

$options = new Options();
$options->set('chroot', realpath(''));
$dom = new Dompdf($options);
?>
<html>

<head>
    <title>Laporan Pembelian Cash</title>

    <style>
        body{
            font-family: Arial, Helvetica, sans-serif;
        }

        .header{
            font-family: Arial, Helvetica, sans-serif;
            font-size: 14px;
            font-weight: 800;
            padding-bottom: 20px;
        }
        img{
            margin-top: 32px;
        }

        .table-css {
            font-family: arial, sans-serif;
            font-size: 12px;
            border-collapse: collapse;
            width: 100%;
            border: 1px solid #ddd;
        }

        .table-css th{
            padding: 8px;
            border: 1px solid #ddd;
            background-color: #ddd;
            text-align: left;
        }

        .table-css td
         {
            
            text-align: left;
            padding: 8px;
        }

        .table-css tr:nth-child(even) {
            background-color: #dddddd;
        }
    </style>
</head>

<body>
    <table class="header" border="0" width="100%">
        <tr>
            <td rowspan="4">
                <center>
                    <img src="<?= $base64; ?>" style="width: 80px;" alt="">
                </center>
            </td>
        </tr>
        <tr>
            <td>Laporan Pembelian Sepeda Motor Bekas Secara Kredit</td>
        <tr>
            <td>WR MOTOR MAUK TANGERANG</td>
        <tr>
            <td>
                Alamat : Kp. Jatiwaringin RT 006 RW 001. Kel Jatiwaringin, Kec. Mauk, Kab Tangerang
            </td>
        </tr>
        </tr>
        </tr>
    </table>
    <table class="table-css">
        <thead>
            <tr>
                <th>Tanggal Pembelian</th>
                <th>Nama Pemilik</th>
                <th>Tipe Motor</th>
                <th>Harga</th>
                <th>Uang Muka</th>
                <th>Tenor</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php
                require '../../database_connect.php';

                $sql = mysqli_query($con, "SELECT tk.tanggal_beli, pd.nama, m.nama_motor,m.tahun,m.harga,tk.uang_muka,tk.tenor,tk.status_lunas FROM transaksi_kredit tk JOIN motor m ON tk.id_motor = m.id JOIN user u ON tk.id_user = u.id_user JOIN personal_data pd ON u.personal_id = pd.id WHERE tk.status='Terima' ORDER BY status_lunas DESC
                ");

                while($data = mysqli_fetch_object($sql))
                {
                    ?>
                        <tr>
                            <td><?= ($data->tanggal_beli == NULL ? '' : date('d-m-Y', strtotime($data->tanggal_beli)))?></td>
                            <td><?= $data->nama; ?></td>
                            <td><?= $data->nama_motor." ({$data->tahun})"; ?></td>
                            <td><?= ($data->harga == NULL ? '' : "Rp. ".number_format($data->harga, 0,',','.'))?></td>
                            <td><?= ($data->uang_muka == NULL ? '' : "Rp. ".number_format($data->uang_muka, 0,',','.'))?></td>
                            <td><?= $data->tenor." X"?></td>
                            <td><?= ($data->status_lunas == "Belum" ? 'Belum' : ''). " Lunas"?></td>
                        </tr>
                    <?php
                }
            ?>
        </tbody>
    </table>
</body>

</html>
<?php
$html = ob_get_contents();
$dom->loadHtml($html);
ob_end_clean();

$dom->setPaper('A4', 'portrat');
$dom->render();
$dom->stream("Laporan Pembelian Kredit.pdf", array("Attachment" => false));
?>