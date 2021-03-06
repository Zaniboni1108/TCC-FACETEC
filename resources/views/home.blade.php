@extends('layouts.logado')

@section('content')
<br />
<br />

@extends('fragmentos.aside')

@section('nome-pagina')

<?php if($nome_pagina == "PERFIL"): ?>
<h3>{{$nome_pagina}}</h3>
<img src='foto_perfil/padrao.png' style="width: 120px; border: 3px solid gray; border-radius: 5px;"><br />
<?= "<span style='color: CornflowerBlue;'>" . Auth::user()->name . "</span>"?>
<?php else: ?>
<h3>{{$nome_pagina}}</h3>
<?php endif?>

@endsection

<div class="main">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">

                    <div class="card-header">PUBLICAR

                        <div style=" float: right;">
                            <form action="/home">
                                <select class="btn btn-outline-primary" name="filtro">
                                    <Option value="todos">TODOS</Option>
                                    <Option value="3°IPIA">3°IPIA</Option>
                                    <Option value="2°MA">2°MA</Option>
                                    <Option value="2°IA">2°IA</Option>
                                    <Option value="1°ADM">1°ADM</Option>
                                </select>
                                <input type="submit" class="btn btn-outline-primary" value="FILTRAR" />
                            </form>
                        </div>

                    </div>


                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif
                    <form action="/publish" method="POST" enctype="multipart/form-data">
                        {{csrf_field()}}
                        <textarea style="border: none; height: 80px;" name="msg" class="form-control" aria-label="With textarea"
                            placeholder="Sua menssagem..."></textarea>
                        <hr />
                        <div class="input-group mb-3">
                            <input style="border: none;" type="file" name="file" id="file" class="form-control"
                                placeholder="Recipient's username" aria-label="Recipient's username" aria-describedby="button-addon2">
                            <button style="margin-right: 10px;" class="btn btn-outline-primary" type="submit" id="button-addon2">Publicar</button>
                        </div>

                        <div style="margin-right: 10px; float: right;">
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
                        </div>
                    </form>
                </div>

                <br />

                @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
                @endif

                <?php foreach ($files as $file) : ?>
                <div class="card">
                    <div class="card-header">
                    @if ($file->user_id == Auth()->User()->id)
                        <ul class="navbar-nav ml-auto">
                            <li class="nav-item dropdown">
                                <a style="color: white; font-size: 20px;" id="navbarDropdown" class="nav-link dropdown-toggle"
                                    href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                                    v-pre>
                                    <span style=" float: right; color:gray; margin-top: -30px; font-size: 30px;">...</span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <form action='/publish_delete/<?= $file->id?>'>
                                        <button type="submit" class='btn btn-light' style="width: 100%;">Apagar</button>
                                    </form>

                                    <form action='/editar/<?= $file->id?>'>
                                        <button type="submit" class='btn btn-light' style="width: 100%;">Editar</button>
                                    </form>
                                </div>
                            </li>
                        </ul>
                        @endif
                        <?= "<span style='color: CornflowerBlue;'>" . $file->usuario() . "</span>" ?>
                        <br />
                        Categoria:
                        <?= $file->categoria ?>.
                        <br />
                        <hr>
                        <?= $file->msg ?>
                    </div>
                    <table>
                        <tr>
                            <td>
                                <center>
                                    <?php echo "<a target='_blank' href='" . url('storage/' . $file->caminho) ."'><img src='" . url('storage/' . $file->caminho) . "' style='width:100%;' alt='" . $file->caminho . "'></a>" ?>
                                </center>
                            </td>
                        </tr>
                    </table>
                    <div class="card-header" style="border-radius: 20px;">
                        <?php echo "<a style='color: black;' class='btn btn-light' target='_blank' href='" . url('storage/' . $file->caminho) ."'>Baixar</a>" ?>
                    </div>
                </div>
                <br />
                <?php endforeach ?>
            </div>
        </div>
    </div>
</div>
@endsection