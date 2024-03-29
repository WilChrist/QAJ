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

<div class="form-group col-sm-6">
    {!! Form::label('image_url', 'Image:') !!}
    <div class="input-group">
        <label class="input-group-btn">
            <span class="btn btn-primary">
                Selectionner un fichier<input type="file" style="display: none;" name="image_url" id="image_url">
            </span>
        </label>
        <input type="text" class="form-control" readonly value="{!! $author->image_url ?? null !!}">
    </div>
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('authors.index') !!}" class="btn btn-default">Cancel</a>
</div>
