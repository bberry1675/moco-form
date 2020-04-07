<?php 

    // $body = json_decode($_POST['responses']);
    // echo json_encode($body[0]);
    require_once __DIR__ . '/vendor/autoload.php';

    $mpdf = new \Mpdf\Mpdf();
    $body = json_decode($_POST['responses']);

    for($count = 0; $count<count($body); $count++){
        if($count > 0){
            $mpdf->AddPage();
        }

        $mpdf->WriteHTML(file_get_contents('./pdf/header.html'));

        $mpdf->WriteHTML(json_encode($body[$count]));

        $mpdf->WriteHTML(file_get_contents('./pdf/footer.html'));

    }

    $mpdf->Output();
?>