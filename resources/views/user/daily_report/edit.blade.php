@extends ('common.user')
@section ('content')

<h1 class="brand-header">日報編集</h1>
<div class="main-wrap">
  <div class="container">
    {!! Form::open(['route' => ['daily.update', $reportShow->user_id]] )!!}
      <input class="form-control" name="user_id" type="hidden" value="4">
      <div class="form-group form-size-small">
        <input class="form-control" name="reporting_time" type="date">
      <span class="help-block"></span>
      </div>
      <div class="form-group">
        <input class="form-control" placeholder="Title" name="title" type="text" value="{{ $reportShow->title }}">
      <span class="help-block"></span>
      </div>
      <div class="form-group">
        <textarea class="form-control" placeholder="本文" name="contents" cols="50" rows="10">{{ $reportShow->contents }}</textarea>
      <span class="help-block"></span>
      </div>
      <button type="submit" class="btn btn-success pull-right">Update</button>
    {!! Form::close()!!}
  </div>
</div>

@endsection

