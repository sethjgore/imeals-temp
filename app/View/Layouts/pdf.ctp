<?php
    header('Content-Disposition: attachment; filename="statements'.date("n-d-Y").'.pdf"');
    echo $content_for_layout;
?>