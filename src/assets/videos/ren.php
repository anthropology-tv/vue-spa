<?php

if ($handle = opendir('.')) {
    while (false !== ($fileName = readdir($handle))) {
        $newName = md5($fileName) . '.mp4';
        echo '{"hash":"'.$newName.'", "url": "'.$fileName.'"}';
        rename($fileName, $newName);
        if ($handleThumbs = opendir('../thumbs/')) {
            while (false !== ($fileNameThumbs = readdir($handleThumbs))) {
                $newName = '../thumbs/' .  md5($fileName) . '.webp';
                rename('../thumbs/' .  $fileNameThumbs, $newName);
            }
        }
    }
    closedir($handle);
}
?>
