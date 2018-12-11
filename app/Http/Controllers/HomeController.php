<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\User;
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

    public function index(Request $request)
    {
        $nome_pagina = "INÍCIO";
        $filtro = $request->filtro;
        
        if($filtro == "" or $filtro == "todos"){
            $file = File::orderBy('id', 'DESC')->get();
            return view('home')->with('files', $file)->with('nome_pagina', $nome_pagina);
        }

        $file = File::orderBy('id', 'DESC')->where('turmas', $filtro)->get();
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
        $file->turmas = $request->turmas;
        $file->user_id = Auth::user()->id;
        $file->save();

        
        return back()->with('messagem', 'Upload realizado com sucesso');
    }

    public function publish_delete(Request $request)
    {
        $id = $request->id;
        $files = File::find($id);
        $files->delete();

        return back()->with('messagem', 'Deletado com sucesso');
    }



    public function edit_perfil(Request $request)
    {   
        return view('editar_perfil');
    }

    public function edit_perfil2(Request $request)
    {
        $id = $request->id;
        $user = User::find($id);
        $user->name = $request->name;
        $user->update();
        return redirect()->action('HomeController@profile');
    }



    public function editar(Request $request)
    {
        $id = $request->id;
        $files = File::find($id);

        return view('editar')->with('files', $files);
    }

    public function publish_editar(Request $request)
    {   
        $id = $request->id;
        $files = File::find($id);
        $files->msg = $request->input("msg");
        $files->categoria = $request->categoria;
        $files->turmas = $request->turmas;
        $files->update();
        return back()->with('messagem', 'Editado com sucesso');
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

    public function apostila(){
        $nome_pagina = "APOSTILAS";
        $file = File::orderBy('id', 'DESC')->where('categoria', 'apostila')->get();
        return view('home')->with('files', $file)->with('nome_pagina', $nome_pagina);   
    }
}
