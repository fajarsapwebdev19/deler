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

require '../../database_connect.php';
if(isset($_GET['id']))
{
    $id = mysqli_real_escape_string($con, $_GET['id']);

    $sql = mysqli_query($con, "SELECT * FROM transaksi_kredit tk JOIN motor m ON tk.id_motor = m.id JOIN user u ON tk.id_user = u.id_user JOIN personal_data pd ON u.personal_id = pd.id WHERE tk.id='$id'");

    $data = mysqli_fetch_object($sql);
}
?>
    <html>
    <head>
        <title>Invoice Kredit <?= $data->nama; ?> - <?= $data->nama_motor; ?> <?= ($data->tanggal_beli == NULL ? "" : date('d-m-Y', strtotime($data->tanggal_beli)))?></title>
    </head>
    <style>
        
        .header{
            font-family: Arial, Helvetica, sans-serif;
            font-size: 14px;
            font-weight: 800;
            padding-bottom: 20px;
        }

        img{
            margin-top: 26px; 
        }
        .kotak{
            background-color: #eaeaea;
            border: 1px solid #000;
            height: auto;
            padding: 20px;
            
        }

        .detail{
            height: 150px;
            padding-left: 30px;
        }

        .tenor-payment {
            background: #fff;
            margin-left: 38px;
            border: 1px solid #000;
            width: 90%;
            border-collapse: collapse;
            font-size: 16px;
            font-family: arial,sans-serif;
        }

        .tenor-payment,th{
            text-align: center;
            font-weight: 800;
        }

        .tenor-payment td {
            border: 1px solid #000;
        }

        .label{
            margin-top: 100px;
            margin-left: 30px;
        }

        .text-left{
            text-align: left;
        }

        .text-center{
            text-align: center;
        }

        .text-right{
            text-align: right;
        }

        .kotak-price{
            border: 1px solid #000;
            text-align: center;
            height: auto;
            font-size: 20px;
            width: 180px;
            font-weight: 800;
            padding: 5px;
        }
    </style>
    <body>
        
        <div class="kotak">
            <table class="header" border="0" width="100%">
                <tr>
                    <td rowspan="4">
                        <center>
                            <img src="<?= $base64; ?>" style="width: 80px;" alt="">
                        </center>
                    </td>
                </tr>
                <tr>
                    <td>Invoice Pembelian Sepeda Motor Bekas (Kredit)</td>
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
            <table class="detail" border="0" cellpadding="10">
                <tr>
                    <th width="10%" style="text-align:left;">Nama Pemilik</th>
                    <th width="2%">:</th>
                    <td style="text-align: left; "><?= $data->nama; ?></td>
                </tr>
                <tr>
                    <th width="15%" style="text-align:left;">NIK</th>
                    <th width="2%">:</th>
                    <td style="text-align: left; "><?= $data->nik; ?></td>
                </tr>
                <tr>
                    <th width="15%" style="text-align:left;">Tipe Motor</th>
                    <th width="2%">:</th>
                    <td style="text-align: left; "><?= $data->nama_motor; ?></td>
                </tr>
                <tr>
                    <th width="15%" style="text-align:left;">Tahun</th>
                    <th width="2%">:</th>
                    <td style="text-align: left; "><?= $data->tahun; ?></td>
                </tr>
                <tr>
                    <th width="15%" style="text-align:left;">Uang Muka</th>
                    <th width="2%">:</th>
                    <td style="text-align: left; "><?= ($data->uang_muka == NULL ? '' : "Rp. ".number_format($data->uang_muka, 0,',','.')); ?></td>
                </tr>
                <tr>
                    <th width="15%" style="text-align:left;">Tenor</th>
                    <th width="2%">:</th>
                    <td style="text-align: left; "><?= $data->tenor; ?> X</td>
                </tr>
                <tr>
                    <th width="15%" style="text-align:left;">Tanggal Pembelian</th>
                    <th width="2%">:</th>
                    <td style="text-align: left; "><?= ($data->tanggal_beli == NULL ? "" : date('d-m-Y', strtotime($data->tanggal_beli)))?></td>
                </tr>
                <tr>
                    <th width="15%" style="text-align:left;">Pembayaran</th>
                    <th width="2%">:</th>
                    <td style="text-align: left; "><?= $data->pembayaran; ?></td>
                </tr>
            </table>
            
            <table class="tenor-payment">
                <thead>
                    <tr>
                        <td>Pembayaran Ke</td>
                        <td>Uang Tenor</td>
                        <td>Tgl Bayar</td>
                        <td>Pembayaran Via</td>
                        <td>Status</td>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $tenor = mysqli_query($con, "SELECT * FROM pembayaran_tenor WHERE id_transaksi='$id'");
                        while($dt = mysqli_fetch_object($tenor))
                        {
                            ?>
                                <tr>
                                    <td><?= $dt->pembayaran_ke; ?></td>
                                    <td><?= ($dt->uang_tenor == NULL ? '' : "Rp. ".number_format($dt->uang_tenor, 0,',','.')); ?></td>
                                    <td><?= ($dt->tanggal_bayar == NULL ? '' : date('d-m-Y', strtotime($dt->tanggal_bayar))); ?></td>
                                    <td><?= $dt->pembayaran; ?></td>
                                    <td><?= $dt->status_bayar; ?></td>
                                </tr>
                            <?php
                        }
                    ?>
                </tbody>
            </table>

            <table class="label" border="0" width="90%">
                <tr>
                    <td>
                        <span class="kotak-price text-center">
                            <?= ($data->harga == NULL ? "" : "Rp. ".number_format($data->harga, 0,',','.')) ?>
                        </span>
                    </td>
                    <td style="text-align: center;">
                        <span class="kotak-price text-center">
                            <?= ($data->status_lunas == "Belum" ? 'Belum' : ''). "Lunas"; ?>
                        </span>
                    </td>
                </tr>
            </table>
            
        </div>
    </body>
</html>
<?php
$html = ob_get_contents();
$dom->loadHtml($html);
ob_end_clean();

$dom->setPaper('A4', 'portrat');
$dom->render();
$tanggal = $data->tanggal_beli == NULL ? '' : date('d-m-Y', strtotime($data->tanggal_beli));
$title = "Invoice Kredit {$data->nama} - {$data->nama_motor} {$tanggal}.pdf";
$dom->stream($title, array("Attachment" => false));
?>