<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use App\File;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $file = File::orderBy('id', 'DESC')->get();
        
        return view('home')->with('files', $file);
    }


    public function error() {
        return back();
    }

    public function publish(Request $request)
    {
        $request->validate([
            'msg' => 'required',
            'file' => 'required',
        ]);

        $file = new File;
        $file->msg = $request->input('msg');
        $file->name = $request->file->getClientOriginalName();
        $file->tamanho = $request->file->getClientSize();
        $file->tipo = $request->file->extension();
        $file->caminho = '/assets/files/'.$request->file->storeAs('', str_slug($file->name).'.'.$file->tipo, 'upl_files');
        $file->user_id = Auth::user()->id; 
        $file->save();
        return back()->with('menssagem', 'Upload realizado com sucesso');
    }

    public function my_publish(){

    }
}
