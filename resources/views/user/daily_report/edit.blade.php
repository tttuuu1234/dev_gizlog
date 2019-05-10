@extends ('common.user')
@section ('content')

<h1 class="brand-header">日報編集</h1>
<div class="main-wrap">
  <div class="container">
    {!! Form::open(['route' => ['daily.update', $reportEdit->id], 'method' => 'put'] )!!}
      <input class="form-control" name="user_id" type="hidden">
      <div class="form-group form-size-small {{ $errors->has('reporting_time')? 'has-error' : '' }}">
        <input class="form-control " name="reporting_time" value="{{ $reportEdit->reporting_time->format('Y-m-d') }}" type="date">
      <span class="help-block">{{ $errors->first('reporting_time')}}</span>
      </div>
      <div class="form-group {{ $errors->has('title')? 'has-error' : ''}}">
        <input class="form-control" placeholder="Title" name="title" type="text" value="{{ $reportEdit->title }}">
      <span class="help-block">{{ $errors->first('title')}}</span>
      </div>
      <div class="form-group {{ $errors->has('contents')? 'has-error' : ''}}">
        <textarea class="form-control" placeholder="本文" name="contents" cols="50" rows="10">{{ $reportEdit->contents }}</textarea>
      <span class="help-block">{{ $errors->first('contents')}}</span>
      </div>
      <button type="submit" class="btn btn-success pull-right">Update</button>
    {!! Form::close()!!}
  </div>
</div>

@endsection

