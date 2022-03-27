<div>
  <p>{{ $time }}</p>
  データを更新しました
  <br>
  <h1>新規週間ランキング</h1>
  @if(empty($new_week_rank_titles))
    <p>新規の週間ランキングはありませんでした</p>
  @else
    <ul>
      @foreach ($new_week_rank_titles as $index => $week_title)
        <li>{{ $week_title }}</li>
      @endforeach
    </ul>
  @endif
</div>