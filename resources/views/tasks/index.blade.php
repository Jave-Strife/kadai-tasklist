@extends('layouts.app')

@section('content')

    @if( Auth::check() )

        <h1>タスク一覧</h1>
            
        @if( count( $tasks ) > 0 )
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ステータス</th>
                        <th>タスク</th>
                        <th>登録日時</th>
                        <th>更新日時</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ( $tasks as $task )
                        <tr>
                            <td>{{ $task->status }}</td>
                            <td>{!! link_to_route('tasks.show', $task->content, ['id' => $task->id]) !!}</td>
                            <td>{{ $task->created_at }}</td>
                            <td>{{ $task->updated_at }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
        {!! link_to_route('tasks.create', '新規タスクの追加', [], ['class' => 'btn btn-primary']) !!}
    @else
        <div class="center jumbotron">
            <div class="text-center">
                <h1>Welcome to the TaskList</h1>
                {!! link_to_route('signup.get', 'Sign up now!', [], ['class' => 'btn btn-lg btn-primary']) !!}
            </div>
        </div>
    @endif
@endsection