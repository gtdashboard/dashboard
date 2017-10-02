<?php
    require '../db.php';
    //$p=$_SESSION['project'];
    $p='sp_104';
    $db_handle=new DBController($p);
    function ins_db($file_name)
    {
        echo '1.inside image setting';
        $date=$_POST['date_selected'];
        $query="insert into files(date_file,link_file) values('".$date."','".$file_name."')";
        echo $query;
        $p='sp_104';
        $db_handle=new DBController($p);
        $result=$db_handle->runUpdate($query);
        if($result)
        {
             echo "2.<alert>Inserted</alert>";
             header('Location:upload.php');
             
        }
        
    }
    $date=$_POST['date_selected'];
    //echo $date;
    $target_dir = "../uploads/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    if (file_exists($target_file)) {
        $ans="Sorry, file already exists.";
        echo "3.Sorry, file already exists.";
        header("Location:upload.php?ans=".$ans);
        $uploadOk = 0;
    }

    if ($_FILES["fileToUpload"]["size"] > 500000) {
        $ans="Sorry, your file is too large.";
        echo "4.Sorry, your file is too large.";
        header("Location:upload.php?ans=".$ans);
        $uploadOk = 0;
    }

    if ($uploadOk == 0) {
        $ans="Sorry, your file was not uploaded.";
        echo "5.Sorry, your file was not uploaded.";
        header("Location:upload.php?ans=".$ans);

    } 
    else 
    {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file))
        {
                echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
                ins_db($_FILES["fileToUpload"]["name"]);
        } 
        else 
        {
            $ans="Sorry, there was an error uploading your file.";
            header("Location:upload_signed.php?ans=".$ans);
            echo "6.Sorry, there was an error uploading your file.";
            header('Location:upload.php');
        }
    }
?>
