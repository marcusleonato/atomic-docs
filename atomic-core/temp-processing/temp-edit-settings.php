<?php
require '../temp-functions/functions.php';


require "../fllat.php";

$settings = new Fllat("settings", "../../atomic-db");


$compDir = $_POST["compDir"];
$compExt = $_POST["compExt"];
$stylesExt = $_POST["stylesExt"];
$stylesDir = $_POST["stylesDir"];

$old_compDir = $_POST["old_compDir"];
$old_compExt = $_POST["old_compExt"];
$old_stylesExt = $_POST["old_stylesExt"];
$old_stylesDir = $_POST["old_stylesDir"];



$errors         = array();
$data           = array();



if ($_POST['compDir'] == "" || $_POST['compExt'] == "" || $_POST['stylesExt'] == "" || $_POST['stylesDir'] == "" ){
    $errors['name'] = 'Input is required.';
}


if ( ! empty($errors)) {
    $data['success'] = false;
    $data['errors']  = $errors;
} else {







    dbUpdateSettings($settings, $compDir, $compExt, $stylesExt, $stylesDir);
    editStylesComment($old_stylesDir, $old_stylesExt, $stylesExt, $stylesDir);
    editStyleExt($old_stylesDir, $old_stylesExt, $stylesExt);
    renameStyleDirSettings($old_stylesDir, $stylesDir);
    changeRootStylesExt($stylesDir, $old_stylesExt, $stylesExt);




    editCompComment($old_compDir, $old_compExt, $compExt, $compDir);
    editCompExt($old_compDir, $old_compExt, $compExt);
    renameCompDirSettings($old_compDir, $compDir);








    //change component dir name

    //change markup file exts




    /*$path = "../../less";
    $dir = new DirectoryIterator($path);

    foreach ($dir as $fileinfo) {
        if ($fileinfo->isDir() && !$fileinfo->isDot()) {


            $dirs = $fileinfo->getFilename();


            foreach (glob("../../$old_stylesDir/$dirs/*.scss") as $filename) {

                $newname = basename($filename, ".scss").".less";

                rename($filename, '../../less/'.$dirs.'/'.$newname);

            }
        }
    }*/







    $data['success'] = true;
    $data['message'] = 'Success!';
}


echo json_encode($data);

