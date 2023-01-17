<?php
error_reporting(false);
header('Content-Type: image/jpeg');
if(!empty($_GET['url'])){
    if(strpos($_GET['url'],"http://") !== false or strpos($_GET['url'],"https://") !== false){
        header('Content-type: image/png');
        $mi = $_GET['url'];
        $captchas = rand(111111,999999);
        $cas = substr($captchas, 0, 7);
        $r="http://image.thum.io/get/width/2100/crop/16000/".$mi."/?".$cas;
        $link = $r;
        $ch = curl_init($link);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        $data = curl_exec($ch);
        $path = parse_url($link, PHP_URL_PATH);
        $filename = basename($path);
        copy($link, "$filename.png");
        $png_image = imagecreatefrompng("$filename.png");
        imagepng($png_image);
        imagedestroy($png_image);
        unlink("$filename.png");
    }else{
        header('Content-Type: application/json;charset=utf-8');
        echo json_encode(array_merge(['ok'=> false,'channel'=> "@sidepath",'writer'=> "@meysam_s71",'results'=>"Where Is Fucking HTTP Or HTTPS !?"]), 448);
    }
}else{
    header('Content-Type: application/json;charset=utf-8');
    echo json_encode(array_merge(['ok'=> false,'channel'=> "@sidepath",'writer'=> "@meysam_s71",'results'=>"Where Is Fucking URL !?"]), 448);
}