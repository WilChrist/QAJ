<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{!! $author->id !!}</p>
</div>

<!-- Full Name Field -->
<div class="form-group">
    {!! Form::label('full_name', 'Full Name:') !!}
    <p>{!! $author->full_name !!}</p>
</div>

<!-- Popular Name Field -->
<div class="form-group">
    {!! Form::label('popular_name', 'Popular Name:') !!}
    <p>{!! $author->popular_name !!}</p>
</div>

<!-- Biography Field -->
<div class="form-group">
    {!! Form::label('biography', 'Biography:') !!}
    <p>{!! $author->biography !!}</p>
</div>

<!-- Link To Full Biography Field -->
<div class="form-group">
    {!! Form::label('link_to_full_biography', 'Link To Full Biography:') !!}
    <p>{!! $author->link_to_full_biography !!}</p>
</div>
<div class="form-group">
    {!! Form::label('image_url', 'Image of the author:') !!}
    <img src="{!! $author->image_url !!}" class="img-thumbnail img-responsive" width="200px" alt="image of {!! $author->popular_name !!}">
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{!! $author->created_at !!}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{!! $author->updated_at !!}</p>
</div>

