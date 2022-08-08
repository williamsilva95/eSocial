@extends('main')

@section('content')
    <div class="container mt-4">
        <br/>
        <div class="card">
            <div class="card-header text-right">
                <div class="row">
                    <div class="col-md-6 text-left">
                        <a href="{{url('/dominio')}}" class="btn btn-primary btn-sm" role="button">Voltar</a>
                        <button onClick="inserir();" class="btn btn-success btn-sm" role="button" data-toggle="modal">Adicionar</button>
                    </div>
                    <div class="col-md-6">
                        <form class="form-inline my-lg-0 d-flex justify-content-end" action="{{url('pesquisar')}}" method="post">
                            {{csrf_field()}}
                            <input class="form-control mr-sm-2 form-control-sm" type="search" placeholder="Search" aria-label="Search" name="texto">
                            <button class="btn btn-success btn-sm" type="submit">Search</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="row row-cols-1 row-cols-md-3 g-4">
                    <table class="table col-md-12">
                        <thead>
                        <tr>
                            <th scope="col" class="text-center">#</th>
                            <th scope="col" class="text-center">Domínio</th>
                            <th scope="col" class="text-center">Ações</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($dominio as $value)
                            <tr>
                                <th scope="row" class="text-center">{{$value->id}}</th>
                                <td class="text-center">{{$value->nome}}{{$value->tld}}</td>
                                <td class="text-center">
                                    <button onClick="visualizar({{$value->id}})" class="btn btn-success btn-sm" role="button">Vizualizar</button>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts-footer')
    <script type="text/javascript" src="{{ asset('js/app/dominio.js') }}"></script>
@endsection
