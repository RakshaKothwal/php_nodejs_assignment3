<?php

$directory = 'uploads/';


if (is_dir($directory)) {
    if ($dir_handle = opendir($directory)) {
        echo "Files in '$directory':<br><br>";

    
        while (($file = readdir($dir_handle)) !== false) {
            if ($file != "." && $file != "..") {
                echo "File: $file<br>";
            }
        }

        
        closedir($dir_handle);
    } else {
        echo "Unable to open the directory.";
    }
} else {
    echo "Directory does not exist.";
}
?>
