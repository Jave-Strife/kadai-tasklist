@extends('layouts.app')

@section('content')

    <h1>タスク一覧</h1>
    
    @if( count( $tasks ) > 0 )
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>タスク</th>
                    <th>登録日時</th>
                    <th>更新日時</th>
                </tr>
            </thead>
            <tbody>
                @foreach ( $tasks as $task )
                <tr>
                    <td>{!! link_to_route('tasks.show', $task->content, ['id' => $task->id]) !!}</td>
                    <td>{{ $task->created_at }}</td>
                    <td>{{ $task->updated_at }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    {!! link_to_route('tasks.create', '新規タスクの追加', [], ['class' => 'btn btn-primary']) !!}

@endsection