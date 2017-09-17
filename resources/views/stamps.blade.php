@extends('layouts.app')

@section('content')

    <h1>所持すたンプ一覧</h1>

    @foreach($stamps as $rarity => $stampList)
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">★{{ $rarity }}</h3>
            </div>
            <div class="panel-body">
                <ul class="list-inline stampList">
        @foreach($stampList as $stampPath)
                    <li>
                        <img src="/stamp/{{ $stampPath }}/image" width="100" height="100" class="rarity{{ $rarity }}">
                    </li>
        @endforeach
                </ul>
            </div>
        </div>
    @endforeach
@endsection