@php
  $periods = [
    'three' => '3日',
    'week' => '週間',
    'month' => '月間'
  ];
@endphp 
<div>
  <p>{{ $time }}</p>
  データを更新しました
  <br>
  @foreach ($periods as $periodKey => $periodValue) 
    <h1>新規{{ $periodValue}}ランキング</h1>
    @if(empty($newRankTitles[$periodKey]))
    <p>新規の週間ランキングはありませんでした</p>
    @else
    <ul>
      @foreach ($newRankTitles[$periodKey] as $index => $titles)
      <li>{{ $titles }}</li>
      @endforeach
    </ul>
    @endif
    <br>
  @endforeach
</div>