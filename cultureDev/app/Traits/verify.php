<?php
namespace App\Traits;


trait Verify{
    public function RsponseMessage($model , $name , $status){
    if (!$model) {
        return response()->json(['message' => $name.' not found'], 404);
    }
    return response()->json([
        'status' => $status,
        'message' => $name." Updated successfully!",
        (!$model)?$model=null:'article' => $model,
    ], 200);
   }
}
