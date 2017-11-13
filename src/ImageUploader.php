<?php
namespace incognito;


class ImageUploader
{
    private $fileHandler;
    private $uploadOk;
    private $target_dir;
    private $target_file;
    private $imageFileType;
    private $fileSize;

    private $uploaded;

    var $result;


    /**
     *
     * Takes $_FILES['form_field'] array as argument
     * where form_field is the form field name

     * @access private
     * @param  array  $file $_FILES['form_field']
     *    or   string $file Local filename
     */
    function  __construct($file)  {
        $this->uploadOk = 1;
        $this->uploaded = false;
        $this->fileHandler = $file;
        $this->target_dir = "uploads/";
        $this->target_file = basename($file["name"]);
        $this->imageFileType = pathinfo($this->target_file,PATHINFO_EXTENSION);
        $this->fileSize = $this->fileHandler["size"];
        $this->upload($file);
    }

    function getTargetFile(){
        return $this->target_file;
    }

    function isUploaded(){
        if ($this->uploaded){
            return true;
        }
        else {
            return false;
        }
    }

    function upload($file) {
        $uniqueSaveName = time().uniqid(rand());
        $target_file = pathinfo($this->target_file,PATHINFO_FILENAME).$uniqueSaveName.'.'.pathinfo($this->target_file,PATHINFO_EXTENSION);
        $this->target_file = $target_file;

        // Check if image file is a actual image or fake image
        if(isset($file)) {
            $check = getimagesize($file["tmp_name"]);
            if($check !== false) {
                $this->result = "File is an image - " . $check["mime"] . ".";
                $this->uploadOk = 1;
            } else {
                $this->result = "File is not an image.";
                $this->uploadOk = 0;
            }
        }

        // Check if file already exists
        if (file_exists($this->target_file)) {
            $this->result = "Sorry, file already exists.";
            $this->uploadOk = 0;
        }
        // Check file size
        if ($this->fileSize > 500000) {
            $this->result = "Sorry, your file is too large.";
            $this->uploadOk = 0;
        }

        // Allow certain file formats
        if($this->imageFileType != "jpg" && $this->imageFileType != "png" && $this->imageFileType != "jpeg") {
            $this->result = "Sorry, only JPG, JPEG & PNG files are allowed.";
            $this->uploadOk = 0;
        }

        // Check if $uploadOk is set to 0 by an error
        if ($this->uploadOk == 0) {
            $this->result = "Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($this->fileHandler["tmp_name"], $this->target_dir.$this->target_file)) {
                $this->result = "The file ". basename($this->fileHandler["name"]). " has been uploaded.";
                $this->result = '<img src="uploads/'.$this->fileHandler["name"].'"/>';
                $this->uploaded = true;
            } else {
                $this->result = "Sorry, there was an error uploading your file.";
            }
        }

        return $this->result;
    }
}