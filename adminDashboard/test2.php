<?php

    if (isset($_FILES['file2'])) {
        foreach ($_FILES['file2'] as $key => $value) {
            echo $key . ': ' . $value . '<br>';
        }
    } else {
        echo 'No file uploaded.';
    }