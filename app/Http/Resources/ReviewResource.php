<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;
use App\Model\Product;

class ReviewResource extends Resource
{
    public function toArray($request)
    {
        //return parent::toArray($request);
        return [      
            'id' =>  $this->id,          
            'customer' => $this->customer,
            'review' => $this->review,
            'star' => $this->star
        ];
    }
}   
