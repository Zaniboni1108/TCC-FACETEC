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
        <form action="/publish" method="POST" enctype="multipart/form-data">
            {{csrf_field()}}
            <textarea style="border: none; height: 80px;" name="msg" class="form-control" aria-label="With textarea"
                placeholder="Sua menssagem...">{{$files->msg}}</textarea>
            <hr />
            <table>
                <tr>
                    <td>
                        <center>
                            <?php echo "<a target='_blank' href='" . url('storage/' . $files->caminho) ."'><img src='" . url('storage/' . $files->caminho) . "' style='width:100%;' alt='" . $files->caminho . "'></a>" ?>
                        </center>
                    </td>
                </tr>
            </table>

            <br />

            <form action='/publish_editar/<?= $files->id?>'>
                <button style="margin-right: 10px; float: right;" class="btn btn-outline-primary" type="submit" id="button-addon2">Editar</button>
            </form>
            
            
            <div style="margin-left: 10px; float: left;">
                ESCOLHER TIPO DE CONTEÚDO: &nbsp;

                @if(Auth::user()->role == 0 or Auth::user()->role == 2)
                <select class='btn btn-outline-primary' name='categoria'>
                    <Option value="nenhum">NENHUM</Option>
                    <Option value="prova">PROVA</Option>
                    <Option value="gabarito">GABARITO</Option>
                    <Option value="apostila">APOSTILA</Option>
                </select>
                @else
                <select class='btn btn-outline-primary' name='categoria'>
                    <Option value='nenhum'>NENHUM</Option>
                </select>
                @endif

                <select class="btn btn-outline-primary" name="turmas">
                    <Option value="nenhum">TURMA</Option>
                    <Option value="3°IPIA">3°IPIA</Option>
                    <Option value="2°MA">2°MA</Option>
                    <Option value="2°IA">2°IA</Option>
                    <Option value="1°ADM">1°ADM</Option>
                </select>
                <br />
                <br />
            </div>
        </form>
    </div>
</div>
@endsection