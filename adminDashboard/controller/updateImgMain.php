<?php

    if (isset($_FILES['file'])) {
        foreach ($_FILES['file'] as $key => $value) {
            echo $key . ': ' . $value . '<br>';
        }
    } else {
        echo 'No file uploaded.';
    }