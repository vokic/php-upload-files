<?php

if (isset($_POST['submit'])) {
    $file = $_FILES['file'];
    
    $fileName = $_FILES['file']['name'];
    $fileTmpName = $_FILES['file']['tmp_name'];
    $fileSize = $_FILES['file']['size'];
    $fileError = $_FILES['file']['error'];
    $fileType = $_FILES['file']['type'];

    $fileExtension = explode('.', $fileName);
    $fileActuallExtension = strtolower(end($fileExtension));
    
    $allowed = array('jpg', 'jpeg', 'png', 'pdf');

    if (in_array($fileActuallExtension, $allowed)) {
        if ($fileError === 0) {
            if ($fileSize < 500000) {
                $fileNameNew = uniqid('', true).".".$fileActuallExtension;
                $fileDestination = 'uploads/'.$fileNameNew;
                move_uploaded_file($fileTmpName, $fileDestination);
                header("Location: success.php?uploacsuccess");
            } else {
                echo "File is too big";
            }
        } else {
        echo "There was an error uploading file."    ;
        }
    } else{
        echo "Not allowed file type.";
    }
}