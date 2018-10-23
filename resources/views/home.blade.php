@extends('layouts.logado')

@section('content')
<br />
<br />
<div class="main">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">


                    <div class="card-header">Publicar</div>
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

                            <button style="margin-right: 10px;" class="btn btn-outline-secondary" type="submit" id="button-addon2">Publicar</button>
                        </div>
                    </form>
                </div>



                <br />



                <div class="card">
                    <div class="card-body">
                        @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                        @endif
                        
                        <?php foreach ($files as $file) : ?>
                        
                        <div class="card">
                                <div class="card-header">
                                    <?= "Publicado por: <i style='color: CornflowerBlue;'>" . $file->usuario() . "</i>" ?>
                                </div>
                            <table>
                                <tr>
                                    <td>
                                    <div class="container">
                                        <br />
                                        <?= $file->msg ?>
                                    </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <hr />
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <center>
                                            <?= $file->caminho ?>
                                        </center>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <br />
                        <?php endforeach ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection