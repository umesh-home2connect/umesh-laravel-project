<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Libraries;
class PriceLibrary
{
public function getPrices() {
    return ['bronze' => 50, 'silver' => 100, 'gold' => 150];
  }   
}