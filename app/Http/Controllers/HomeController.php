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
        $nome_pagina = "";
        $file = File::orderBy('id', 'DESC')->get();
        return view('home')->with('files', $file)->with('nome_pagina', $nome_pagina);
    }


    public function error() {
        return back();
    }

    public function publish(Request $request)
    {
        $request->validate([
            'msg' => 'required',
            'file' => 'required'
        ]);
        
        
        $file = new File;
        $file->msg = $request->input('msg');
        $file->name = $request->file->getClientOriginalName();
        $file->tamanho = $request->file->getClientSize();
        $file->tipo = $request->file->extension();
        $file->caminho = $request->file->storeAs('', str_slug($file->name).'.'.$file->tipo, 'public');
        $file->categoria = $request->categoria;
        $file->user_id = Auth::user()->id; 
        $file->save();

        
        return back()->with('menssagem', 'Upload realizado com sucesso');
    }

    public function profile(){
        $nome_pagina = "PERFIL";
        $file = File::orderBy('id', 'DESC')->where('user_id', Auth::user()->id)->get();
        return view('home')->with('files', $file)->with('nome_pagina', $nome_pagina);
    }

    public function provas(){
        $nome_pagina = "PROVAS";
        $file = File::orderBy('id', 'DESC')->where('categoria', 'prova')->get();
        return view('home')->with('files', $file)->with('nome_pagina', $nome_pagina);
    }

    public function gabaritos(){
        $nome_pagina = "GABARITOS";
        $file = File::orderBy('id', 'DESC')->where('categoria', 'gabarito')->get();
        return view('home')->with('files', $file)->with('nome_pagina', $nome_pagina);   
    }
}
