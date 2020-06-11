<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>TaskList</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Raleway', sans-serif;
                font-weight: 100;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        @extends('layouts.app')

        @section('content')
            @if( Auth::check() )

                <h1>{{ $user->name }}さんのタスク一覧</h1>
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
    </body>
</html>
