<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Helpers;
use App\Helpers\Contracts\RocketShipContract as RocketShipContract;

class RocketShip implements RocketShipContract 
{
    public function blastOff() {
        return 'Hello Umesh Feel Awesome';
    }
}