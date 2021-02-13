<?php

namespace App\Http\Controllers;

use App\Model\Review;
use Illuminate\Http\Request;
use App\Model\Product;//added error
use App\Http\Requests\ReviewRequest;
use App\Http\Resources\ReviewResource;//added
use Symfony\Component\HttpFoundation\Response;


class ReviewController extends Controller
{
   
    public function index(Product $product)
    {   
        //return $product;//this addded to show review for particular product
        //return Review::all();// working shows all product review but needed only particular product 
        
        
        //return $product->review;//goto Product model relationships prints same structure of database so transform needed
                                    //shows all review for selected product 
        return ReviewResource::collection($product->review);//collection of all review of same product
    }
  
    public function create()
    {
        //
    }

    public function store(ReviewRequest $request,Product $product)//ReviewRequest added
    {
        //return $product;//just to check for all produt with review return
        $review = new Review($request->all());//Review model
        $product->review()->save($review);//made error reviews() instead of review() in Product model
        return response(['data' => new ReviewResource($review)],Response::HTTP_CREATED);
    }

    public function show(ReviewRequest $review)
    {
        //
    }

    public function edit(Review $review)
    {
        //
    }

    public function update(Request $request, Product $product, Review $review)//Request takes new data and old data take Review model refer video 20 3:45
    {
        //return $review;
        $review->update($request->all());
        return response(['data' => new ReviewResource($review)],Response::HTTP_CREATED);

    }

    public function destroy(Product $product,Review $review)
    {
        $review->delete();
        return response(null,Response::HTTP_NO_CONTENT);
    }
}
