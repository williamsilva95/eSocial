@extends('main')

@section('content')
    <br><br>
    <div class="mt-5 row d-flex justify-content-center">
        <div class="col-md-5">
        <br/>
        <div class="card">
            <div class="card-header text-center">
                <h5> {{ (isset($dominio)) ? 'Editar' : 'Adicionar' }} Domínio</h5>
            </div>
            @if(isset($dominio))
                {!! Form::model($dominio, ['action' => ('DominioController@store'), 'id' => 'form-dominio']) !!}
            @else
                {!! Form::open(['action' => ('DominioController@store'), 'id' => 'form-dominio']) !!}
            @endif
            @if(session('erro'))
                <div class="alert alert-danger">
                    {{session('erro')}}
                </div>
            @endif
            @if(count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{$error}}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="card-body">
                {!! Form::hidden('id', null) !!}
                <div class="row d-flex justify-content-center">
                    <div class="col-md-9">
                        {!! Form::label('nome', 'Nome de Domínio', ['class' => 'required']) !!}
                        {!! Form::text('nome', isset($dominio) ? $dominio->nome : null, ['class' => 'form-control']) !!}
                    </div>
                    <div class="col-md-3">
                        {!! Form::label('tld', 'TLD', ['class' => 'required']) !!}
                        {!! Form::select('tld',
                            ['.com' => '.com',
                            '.com.br' => '.com.br',
                            '.org' => '.org',
                            '.gov' => '.gov',
                            '.net' => '.net',
                            '.xyz' => '.xyz',
                            '.name' => '.name',
                            '.biz' => '.biz',
                            '.site' => '.site',
                            '.info' => '.info',
                            '.club' => '.club',
                            '.tech' => '.tech',
                            '.online' => '.online',
                            '.edu' => '.edu',
                            '.jobs' => '.jobs']
                            ,isset($dominio) ? $dominio->tld : null, ['class' => 'form-control']) !!}
                    </div>
                </div>
                <br>
                <div class="row d-flex justify-content-center">
                    <a href="{{url('/dominio')}}" type="button" class="btn btn-primary btn-flat btn-sm mr-3">Cancelar </a>
                    <button type="submit" class="sendDisabled btn btn-success btn-sm btn-flat">Salvar</button>
                </div>
            </div>
        </div>
        {!! Form::close() !!}
        </div>
    </div>
@endsection
