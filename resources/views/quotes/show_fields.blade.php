<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{!! $quote->id !!}</p>
</div>

<!-- Content Field -->
<div class="form-group">
    {!! Form::label('content', 'Content:') !!}
    <p>{!! $quote->content !!}</p>
</div>

<!-- Link To The Source Field -->
<div class="form-group">
    {!! Form::label('link_to_the_source', 'Link To The Source:') !!}
    <p>{!! $quote->link_to_the_source !!}</p>
</div>

<!-- Approuved Field -->
<div class="form-group">
    {!! Form::label('approuved', 'Approuved:') !!}
    <p>{{$quote->approuved?"yes":"no"}}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{!! $quote->created_at !!}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{!! $quote->updated_at !!}</p>
</div>

<!-- Author Id Field -->
<div class="form-group">
    {!! Form::label('author_id', 'Author:') !!}
    <p>{!! $quote->author->full_name !!}</p>
</div>

<!-- Language Id Field -->
<div class="form-group">
    {!! Form::label('language_id', 'Language :') !!}
    <p>{!! $quote->language->name !!}</p>
</div>

<!-- Categories Ids Field -->
<div class="form-group">
    {!! Form::label('category_id', 'Categories :') !!}
    @foreach($quote->quoteCategories as $category)
        <p>{!! $category->name !!}</p>
    @endforeach
</div>


