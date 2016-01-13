<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace App\Helpers\Contracts;

Interface FileUploadContract
    {
     public function create_directory_image_upload($uploadPath);
    }