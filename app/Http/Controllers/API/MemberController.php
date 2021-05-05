<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id_user=Auth::user()->id;
        $member =Member::all();
        $return['page']=1;
        $return['per_page']=3;
        $return['total']=count($member);
        $return['total_pages']=3;
        $return['data']=$member;
        return response()->json($return);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $return['success']=false;
        $return['id']=0;
        $return['message']="ERR";
        $validatedData =$request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required',
            'avatar' => 'required',
          ]);
        $member=Member::create($validatedData);
        if($member){
            $return['success']=true;
            $return['id']=$member->id;
            $return['message']="Data Saved";
        }
        return response()->json($return);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $return['success']=false;
        $return['id']=0;
        $return['message']="ERR";
        $validatedData =$request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required',
            'avatar' => 'required',
          ]);
        $member=Member::findid($id);
        $member->update($validatedData);
        if($member){
            $return['success']=true;
            $return['id']=$member->id;
            $return['message']="Data Saved";
        }
        return response()->json($return);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
