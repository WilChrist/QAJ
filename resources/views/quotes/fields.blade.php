<!-- Content Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('content', 'Content:') !!}
    {!! Form::textarea('content', null, ['class' => 'form-control']) !!}
</div>

<!-- Link To The Source Field -->
<div class="form-group col-sm-6">
    {!! Form::label('link_to_the_source', 'Link To The Source:') !!}
    {!! Form::text('link_to_the_source', null, ['class' => 'form-control']) !!}
</div>

<!-- Approuved Field -->
<div class="form-group col-sm-6">
    {!! Form::label('approuved', 'Approuved:') !!}
    <label class="checkbox-inline">
        {!! Form::hidden('approuved', 0) !!}
        {!! Form::checkbox('approuved', '1', null) !!}
    </label>
</div>

<!-- Author Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('author_id', 'Author:') !!}
    {!! Form::select('author_id', $data['authors'],null, ['class' => 'form-control']) !!}
</div>

<!-- Language Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('language_id', 'Language:') !!}
    {!! Form::select('language_id',$data['languages'], null, ['class' => 'form-control']) !!}
</div>

<!-- User Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('category_ids', 'Categories:') !!}
    {!! Form::select('category_ids[]',$data['categories'], $data['quote']->quoteCategories, ['class' => 'form-control many_categories','multiple'=>'multiple']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('quotes.index') !!}" class="btn btn-default">Cancel</a>
</div>
