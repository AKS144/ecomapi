<?php
namespace App\Exceptions;

use Symfony\Component\HttpFoundation\Response;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

trait ExceptionTrait
{
    /*step 1
    //this is used alone without public function isModel($e) and public function isHttp($e)
    public function apiException($request,$e)
    {
        if($e instanceof ModelNotFoundException){
              return response()->json([
                    'errors' => 'Product Model not Found'
             ],Response::HTTP_NOT_FOUND);
        }

        //Incorrect route
       if($e instanceof NotFoundHttpException){
             return response()->json([
                 'errors' => 'Incorrect Route Request'
             ],Response::HTTP_NOT_FOUND);
        }
    }   */

    //step 2
    /*
    public function apiException($request,$e,$exception)
    {
        if($this->isModel($e)){
              return response()->json([
                    'errors' => 'Product Model not Found'
             ],Response::HTTP_NOT_FOUND);
        }

        //Incorrect route
       if($this->isHttp($e)){
             return response()->json([
                 'errors' => 'Incorrect Route Request'
             ],Response::HTTP_NOT_FOUND);
        }

        return parent::render($request, $exception);//no need of this but above
                                                    //two don't works then normal
                                                    //exception will be passed above
    }

    public function isModel($e)
    {
        return $e instanceof ModelNotFoundException;
    }

    public function isHttp($e)
    {
        return $e instanceof NotFoundHttpException;
    }
    */

    //step 3
    public function apiException($request,$e)
    {
        if($this->isModel($e)){
            return $this->ModelResponse($e);

        }

        //for incorrect route
       if($this->isHttp($e)){
           return $this->HttpResponse($e);

        }
        //return parent::render($request, $exception);//no need of this but above
                                                    //two don't works then normal
                                                    //exception will be passed
        return parent::render($request, $e);//used $exception will not return
                                            //json disable in Header->Accept-application/json
    }

    protected function isModel($e)
    {
        return $e instanceof ModelNotFoundException;
    }

    protected function isHttp($e)
    {
        return $e instanceof NotFoundHttpException;
    }

    protected function ModelResponse($e)
    {
        return response()->json([
            'errors' => 'Product Model not Found'
     ],Response::HTTP_NOT_FOUND);

    }

    protected function HttpResponse($e)
    {
        return response()->json([
            'errors' => 'Incorrect Route Request'
        ],Response::HTTP_NOT_FOUND);
    }
}

?>
