@extends ('common.user')
@section ('content')

<h2 class="brand-header">日報作成</h2>
<div class="main-wrap">
  <div class="container">
  {!!Form::open(['route' => 'daily.store', 'method' => 'post'])!!}
        <input class="form-control" name="user_id" type="hidden">
    <div class="form-group form-size-small {{ $errors->has('reporting_time')? 'has-error' : '' }}">
      <input class="form-control" name="reporting_time" type="date" value="{{ old('reporting_time') }}">
      <span class="help-block">{{ $errors->first('reporting_time') }}</span>
    </div>
    <div class="form-group {{ $errors->has('title')? 'has-error' : '' }}">
      <input class="form-control" placeholder="Title" name="title" type="text" value="{{ old('title') }}">
      <span class="help-block">{{ $errors->first('title') }}</span>
    </div>
    <div class="form-group {{ $errors->has('contents')? 'has-error' : '' }}">
      <textarea class="form-control" placeholder="Content" name="contents" cols="50" rows="10">{{ old('contents') }}</textarea> <!--textareaだけはvalueで指定してもold()は消えてしまうので閉じタグ間に記述-->
      <span class="help-block">{{ $errors->first('contents') }}</span>
    </div>
    <button type="submit" class="btn btn-success pull-right">Add</button>
  {!!Form::close()!!}
  </div>
</div>

@endsection

