<?php
    use Dompdf\Dompdf;
    use Dompdf\Options;
    require '../../dompdf/vendor/autoload.php';

    $options = new Options();
    $options->set('chroot', realpath(''));
    $dom = new Dompdf($options);
    $dom->loadHtml('<img src="../../img/motor/1056060597---1882424112.jpeg" alt="daa">');
    $dom->set_option('isRemoteEnabled', TRUE);

    $dom->setPaper('A4', 'portrat');
    $dom->render();
    $dom->stream("OWOWOO", array("Attachment" => false));
?>