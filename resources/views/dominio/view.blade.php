@extends('main')

@section('content')
    <br><br>
    <div class="mt-5 row d-flex justify-content-center">
        <div class="col-md-5">
        <br/>
        <div class="card">
            <div class="card-header text-center">
                <h5> Domínio </h5>
            </div>

            <div class="card-body">
                {!! Form::hidden('id', null) !!}
                <div class="row d-flex justify-content-center">
                    <div class="col-md-9">
                        {!! Form::label('nome', 'Nome de Domínio', ['class' => 'required']) !!}
                        {!! Form::text('nome', isset($dominio) ? $dominio->nome : null, ['class' => 'form-control', 'disabled' => true]) !!}
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
                            ,isset($dominio) ? $dominio->tld : null, ['class' => 'form-control', 'disabled' => true]) !!}
                    </div>
                </div>
                <br>
                <div class="row d-flex justify-content-center">
                    <a href="{{url('/dominio')}}" type="button" class="btn btn-primary btn-flat btn-sm mr-3">Voltar </a>
                </div>
            </div>
        </div>
        {!! Form::close() !!}
        </div>
    </div>
@endsection
