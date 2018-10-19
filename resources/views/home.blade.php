@extends('layouts.logado')

@section('content')
<br />
<br />
<div class="main">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Feed</div>

                    <div class="card-body">
                        @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                        @endif

                        <form action="/publish" method="POST" enctype="multipart/form-data">

                            {{csrf_field()}}

                            <textarea name="msg" class="form-control" aria-label="With textarea" placeholder="Menssagem"></textarea>

                            <!--<input type="file" name="file" id="file">
                            <input type="submit" value="Publicar" />-->

                            <div class="input-group mb-3">
                                <input type="file" name="file" id="file" class="form-control" placeholder="Recipient's username" aria-label="Recipient's username"
                                    aria-describedby="button-addon2">
                                <div class="input-group-append">
                                    <button class="btn btn-outline-secondary" type="submit" id="button-addon2">Publicar</button>
                                </div>
                            </div>

                        </form>

                        <hr />

                        <br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection