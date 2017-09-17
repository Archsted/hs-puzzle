@extends('layouts.app')

@section('content')

    <h1>ランキング</h1>


    <div class="row">
        <div class="col-md-6">
            <h2>所持すたンプ数</h2>

            <table class="table table-hover table-striped">
                <thead>
                <tr>
                    <th>スタンプ数</th>
                    <th>名前</th>
                </tr>
                </thead>
                <tbody>
                @foreach($stampUsers as $stampUser)
                    <tr>
                        <td>{{ $stampUser['count'] }}</td>
                        <td>{{ $stampUser['name'] }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>

        </div>
        <div class="col-md-6">
            <h2>クリアステージ数</h2>

            <table class="table table-hover table-striped">
                <thead>
                <tr>
                    <th>クリア数</th>
                    <th>名前</th>
                </tr>
                </thead>
                <tbody>
                @foreach($historyUsers as $historyUser)
                    <tr>
                        <td>{{ $historyUser['count'] }}</td>
                        <td>{{ $historyUser['name'] }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>


@endsection