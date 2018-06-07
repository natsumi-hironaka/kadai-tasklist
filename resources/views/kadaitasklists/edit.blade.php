@extends('layouts.app')

@section('content')

<h1>id: {{ $kadaitasklist->id }} EDIT POST</h1>

<div class="row">
        <div class="col-xs-12 col-sm-offset-2 col-sm-8 col-md-offset-2 col-md-8 col-lg-offset-3 col-lg-6">

    {!! Form::model($kadaitasklist, ['route' => ['kadaitasklists.update', $kadaitasklist->id], 'method' => 'put']) !!}

                <div class="form-group">
                    {!! Form::label('status', 'STATUS:') !!}
                    {!! Form::text('status', null, ['class' => 'form-control']) !!}
                </div>
        
                <div class="form-group">
                    {!! Form::label('content', 'TASK:') !!}
                    {!! Form::text('content', null, ['class' => 'form-control']) !!}
                </div>
                
    {!! Form::submit('Edit', ['class' => 'btn btn-success btn-s']) !!}
     

    {!! Form::close() !!}

        </div>
    </div>    

@endsection