@extends('layouts.logado')

@section('content')

<div class="container" style="width: 60%">
    <div class="card">

        <div class="card-header" style="background: #6cb2eb; color: white;">EDITAR

        </div>


        @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
        @endif
        <form action="/perfil_edit2/{{ auth()->user()->id }}" method="POST" enctype="multipart/form-data">
            {{csrf_field()}}
           
            <input  type="text" value="{{ auth()->user()->name }}" name="name" id="name" class="form-control">
           
            <!--style="border: none; height: 80px; -->
            <hr />
            <table>
                <tr>
                    <td>
                        <center>
                            
                        </center>
                    </td>
                </tr>
            </table>

            <br />

            
            <button style="margin-right: 10px; float: right;" class="btn btn-outline-primary" type="submit" id="button-addon2">Editar</button>
            
            
            
           
        </form>
    </div>
</div>
@endsection