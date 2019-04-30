@extends ('common.user')
@section ('content')

<h2 class="brand-header">日報一覧</h2>
<div class="main-wrap">
  <div class="btn-wrapper daily-report">
    {!! Form::open(['route' => ['daily.index'], 'method' => 'get']) !!} 
      @if (isset($inputs['search_word']))
          {!! Form::input('month', 'search_word', $inputs['search_word'], ['class' => 'form-control search-form']) !!}
        @else
          {!! Form::input('month', 'search_word', null, ['class' => 'form-control search-form']) !!}
      @endif
      <button type="submit" class="btn btn-icon"><i class="fa fa-search"></i></button>
    {!!Form::close()!!}  
    <a class="btn btn-icon" href="/daily/create"><i class="fa fa-plus"></i></a>
  </div>
  <div class="content-wrapper table-responsive">
    <table class="table table-striped">
      <thead>
        <tr class="row">
          <th class="col-xs-2">Date</th>
          <th class="col-xs-3">Title</th>
          <th class="col-xs-5">Content</th>
          <th class="col-xs-2"></th>
        </tr>
      </thead>
      <tbody>
        @foreach ($dailyReports as $dailyReport)
          <tr class="row">
            <td class="col-xs-2">{{ $dailyReport->reporting_time->format('m/d (D)') }}</td>
            <td class="col-xs-3">{{ $dailyReport->title }}</td>
            <td class="col-xs-5">{{ $dailyReport->contents }}</td>
            <td class="col-xs-2"><a class="btn" href="daily/{{ $dailyReport->id }}"><i class="fa fa-book"></i></a></td>
          </tr>
        @endforeach 
      </tbody>
    </table>
  </div>
</div>

@endsection

