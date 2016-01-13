<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace App\Helpers;
use App\Helpers\Contracts\FileUploadContract as FileUploadContract;
class FileUploadPath implements FileUploadContract
{
    public function create_directory_image_upload($uploadPath){
       $year = date("Y");
        $month = date("m");
        $day = date("d");

        if (!file_exists("$uploadPath$year")) { //create year folder      
            mkdir("$uploadPath$year");
            $this->change_mod("$uploadPath$year");
        }

        if (!file_exists("$uploadPath$year/$month")) {  //create month folder
            mkdir("$uploadPath$year/$month");
            $this->change_mod("$uploadPath$year/$month");
        }

        if (!file_exists("$uploadPath$year/$month/$day")) { //create day folder
            mkdir("$uploadPath$year/$month/$day");
            $this->change_mod("$uploadPath$year/$month/$day");
        }

        return $uploadPath . "$year/$month/$day/";
   }
   
       function change_mod($filename) {
        if (file_exists($filename)) {

            chmod($filename, 0777);
            return true;
        }
    }
   
   
}
