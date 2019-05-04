<!-- Full Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('full_name', 'Full Name:') !!}
    {!! Form::text('full_name', null, ['class' => 'form-control']) !!}
</div>

<!-- Popular Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('popular_name', 'Popular Name:') !!}
    {!! Form::text('popular_name', null, ['class' => 'form-control']) !!}
</div>

<!-- Biography Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('biography', 'Biography:') !!}
    {!! Form::textarea('biography', null, ['class' => 'form-control']) !!}
</div>

<!-- Link To Full Biography Field -->
<div class="form-group col-sm-6">
    {!! Form::label('link_to_full_biography', 'Link To Full Biography:') !!}
    {!! Form::text('link_to_full_biography', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('authors.index') !!}" class="btn btn-default">Cancel</a>
</div>
