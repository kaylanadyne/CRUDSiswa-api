<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Siswa;
use App\Helpers\formatAPI;
use Exception;

class siswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Siswa::all();

        if($data){
            return formatAPI::createAPI(200,'Success',$data);
        }else{
            return formatAPI::createAPI(400,'Failed');
        }
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
        try{
            $siswa = Siswa::create($request->all());
            
            $data = Siswa::where('id_siswa', '=',$siswa->id_siswa)->get();

            if($data){
                return formatAPI::createAPI(200,'success', $data);
            }else{
                return formatAPI::createAPI(400,'failed');
            }

        }catch(Exception $error){
            return formatAPI::createAPI(400,'failed', $error);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id_siswa)
    {
        try{
            $data = Siswa::where('id_siswa', '=', $id_siswa)->first();

            if($data){
                return formatAPI::createAPI(200,'success', $data);
            }else{
                return formatAPI::createAPI(400,'failed');
            }
        }catch(Exception $error){
            return formatAPI::createAPI(400,'failed', $error);
        }
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
    public function update(Request $request, $id_siswa)
    {
        try{
            $siswa = Siswa::findorfail($id_siswa);
            $siswa->update($request->all());

            $data = Siswa::where('id_siswa','=',$siswa->id_siswa)->get();
            if($data){
                return formatAPI::createAPI(200,'Success',$data);
            }else{
                return formatAPI::createAPI(400,'Failed');
            }
        }catch(Exception $error){
            return formatAPI::createAPI(400,'Failed',$error);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_siswa)
    {
        try{
            $siswa = Siswa::findorfail($id_siswa);
            $data = $siswa->delete();
            if($data){
                return formatAPI::createAPI(200,'Success',$data);
            }else{
                return formatAPI::createAPI(400,'Failed');
            }
        }catch(Exception $error){
            return formatAPI::createAPI(400,'Failed',$error);
        }
    }
}
