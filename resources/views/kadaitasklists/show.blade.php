@extends('layouts.app')

@section('content')

<h1>id = {{ $kadaitasklist->id }} のタスク詳細ページ</h1>

    <table class="table table-bordered">
        <tr>
            <th>id</th>
            <td>{{ $kadaitasklist->id }}</td>
        </tr>
        <tr>
            <th>ステータス</th>
            <td>{{ $kadaitasklist->status }}</td>
        </tr>
        <tr>
            <th>タスク</th>
            <td>{{ $kadaitasklist->content }}</td>
        </tr>
    </table>
    
    {!! link_to_route('kadaitasklists.edit', 'このタスクを編集', ['id' => $kadaitasklist->id], ['class' => 'btn btn-default']) !!}

    {!! Form::model($kadaitasklist, ['route' => ['kadaitasklists.destroy', $kadaitasklist->id], 'method' => 'delete']) !!}
        {!! Form::submit('削除', ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}

@endsection