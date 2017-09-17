@extends('layouts.app')

@section('content')

    <h2>基本ルール</h2>

    <ul>
        <li>うどんマスに、うどんと同じ色のすたちゅーを連れていこう。<strong style="text-decoration: underline;">うどんが灰色の場合、連れていくのは何色でもいいよ。</strong></li>
        <li>左側パッド部分で各色のすたちゅーが動くよ。一度動くと壁か他のすたちゅーにぶつかるまで止まらないよ。</li>
        <li>中央に表示された手数を超えて移動は出来ないよ。途中で足りなくなってしまったら、もっと短いルートを探してみよう。</li>
    </ul>

    <h2>中央の手数の色について <span class="badge" style="color:#F88">NEW!!</span></h2>

    <ul>
        <li>中央の残り手数を示す数字が、黄色の時と、赤色の時があるよ。</li>
        <li>黄色は、その問題を自分がまだクリアした事が無い時だよ。クリア時にすたンプが<strong style="text-decoration: underline;">もらえる</strong>状態だよ。</li>
        <li>赤色は、その問題を自分が既にクリアした事がある時だよ。クリアしてもすたンプは<strong style="text-decoration: underline;">もらえない</strong>状態だよ。</li>
    </ul>

    <h2>操作の仕方</h2>

    <ul>
        <li>左側のパッドのボタンを押してもいいけど、<strong style="text-decoration: underline;">パッドの各色エリアにマウスカーソルを載せたまま、キーボードの [ASDW] や [←↓→↑] を押しても移動できるよ。</strong></li>
        <li>一手戻るはキーボードの「F」、全て戻るは「R」を押してもできるよ。</li>
    </ul>

    <h2>すたンプについて</h2>

    <ul>
        <li><strong style="text-decoration: underline;">一度もクリアしたことがないステージをクリアすると</strong>、ランダムでもらえるよ。</li>
        <li>すたンプには5段階のレアリティが設定されているよ。</li>
        <li>難しい問題をクリアした時ほど、珍しいものが出やすくなるよ。目指せコンプリート！！</li>
        <li>レアリティの付け方は、作者の独断と偏見と適当さなので余り気にしないでね。</li>
    </ul>

    <h2>データについて</h2>

    <ul>
        <li>プレイデータの紐付けはブラウザのCookieに保存しているよ。</li>
        <li>Cookieを削除した場合、それまでのプレイデータは消えてしまうので注意しよう。</li>
    </ul>


@endsection