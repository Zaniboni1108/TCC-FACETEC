<?php

namespace App\Http\Controllers;

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
        return view('home');
    }


    public function error() {

        return view('auth/error');

    }

    public function publish(Request $request)
    {
        $request->validate([
            'msg' => 'required',
            'file' => 'required',
        ]);

        $file = new File;
        $file->msg = $request->input('msg');
        $file->tamanho = $request->file->getClientSize();
        $file->tipo = $request->file->extension();
        $file->caminho = '/assets/files/'.$request->file->storeAs('', str_slug($file->msg).'.'.$file->tipo, 'upl_files');
        $file->save();

        return back()->with('menssagem', 'Upload realizado com sucesso');
    }
}
