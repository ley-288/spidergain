<?php

namespace App\Http\Controllers\Frontend\Comuni;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\App\Comuni;

class ComuniController extends Controller
{
    public function getComuni(Request $request){
        
         if(!$request->ajax()){
             abort(400);
         }
        $search = urldecode($request->search);
        
        
        if($search){
            $comuni = Comuni::where('nome','LIKE',$search.'%')->orderBy('capoluogo_provincia', 'DESC')->select('id','nome')->get();
            return response()->json($comuni);
        }else{
            abort(400);
        }
        
    }
}
