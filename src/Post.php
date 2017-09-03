<?php

if (isset( $_POST['id']) && isset($_POST['client']) && isset($_POST['request'])) {
    echo $id.' '.$client.' '.$request;
    var_dump($_POST);
    print_r(json_encode($_POST));
    
    $fp = fopen("myPost.txt","wb");
    fwrite($fp, json_encode($_POST));
    fclose($fp);
}
else {
    var_dump($_POST);
    print_r(json_encode($_POST));
    $fp = fopen("myPost.txt","wb");
    fwrite($fp, json_encode($_POST));
    fclose($fp);
    echo 'Var POST is not set!.';
}

?>