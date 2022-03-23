<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ConclusionComments;

class CommentResultController extends Controller
{
    public function conclusion(){
        $list = ConclusionComments::all();
        return view('commentBank.conclusion', compact('list'));
    }
}


/*
    class CommentConclusionController extends Controller
    {
        /**
         * Display a listing of the resource.
         *
         * @return \Illuminate\Http\Response
         *****************
        public function index()
        {
            $data['comment'] = ConclusionComments::orderBy('id','desc')->paginate(5);
    
            return view('comment-bank',$data);
        }
        
    
        /**
         * Store a newly created resource in storage.
         *
         * @param  \Illuminate\Http\Request  $request
         * @return \Illuminate\Http\Response
         *********************
        public function store(Request $request)
        {

            $comment   =   ConclusionComments::updateOrCreate(
                        [
                            'id' => $request->id
                        ],
                        [
                            'comment' => $request->comment,
                        ]);
        
            return response()->json(['success' => true]);
        }
        
        
        /**
         * Show the form for editing the specified resource.
         *
         * @param  \App\Product  $product
         * @return \Illuminate\Http\Response
         ****************
        public function edit(Request $request)
        {   

            $where = array('id' => $request->id);
            $comment  = ConclusionComments::where($where)->first();
    
            return response()->json($comment);
        }
    
    
        /**
         * Remove the specified resource from storage.
         *
         * @param  \App\Product  $product
         * @return \Illuminate\Http\Response
         *****************
        public function destroy(Request $request)
        {
            $comment = ConclusionComments::where('id',$request->id)->delete();
    
            return response()->json(['success' => true]);
        }
    }
*/