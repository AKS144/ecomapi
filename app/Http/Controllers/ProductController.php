<?php

namespace App\Http\Controllers;

use App\Model\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

use App\Http\Requests\ProductRequest;
use App\Exceptions\ProductNotBelongsToUser;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Resources\Product\ProductResource;
use App\Http\Resources\Product\ProductCollection;


class ProductController extends Controller
{
    public function _construct()
    {
        $this->middleware('auth:api')->except('index','show');
    }

    public function index()
    {
        //return ProductResource::collection(Product::all());
        //return new ProductCollection(Product::all());//it will transform only one product
        return ProductCollection::collection(Product::paginate(20));
    }

    public function create()
    {
        //
    }


    public function store(ProductRequest $request)
    {
        $product = new Product; //model Product header at top it should be there
        $product->name = $request->name;
        $product->detail = $request->description;
        $product->stock = $request->stock;
        $product->price = $request->price;
        $product->discount = $request->discount;
        $product->save();

        return response(['data' => new ProductResource($product)],Response::HTTP_CREATED);

        //return $request->all();//checked for data in postman
    }


    public function show(Product $product)
    {
        return new ProductResource($product);

    }


    public function edit(Product $product)
    {
        //
    }

    public function update(Request $request, Product $product)
    {
        //return $request->all();
        $this->ProductUserCheck($product);
        $request['detail'] = $request->description;
        unset($request['description']);//for description and details from db

        $product->update($request->all());
        return response(['data' => new ProductResource($product)],Response::HTTP_CREATED);
    }


    public function destroy(Product $product)
    {
         $this->ProductUserCheck($product);
         $product->delete();
         return response(null,Response::HTTP_NO_CONTENT);

    }

    public function ProductUserCheck($product)
    {
        if(Auth::id() != $product->user_id)
        {
            throw new ProductNotBelongsToUser;
        }
    }
}
