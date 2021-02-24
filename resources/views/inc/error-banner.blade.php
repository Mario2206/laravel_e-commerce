@if($errors->has("customError"))
    <div class="alert alert-danger">{{ $errors->get('customError')[0]}}</div>
@endif
