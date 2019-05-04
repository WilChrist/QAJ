




<li class="{{ Request::is('categories*') ? 'active' : '' }}">
    <a href="{!! route('categories.index') !!}"><i class="fa fa-edit"></i><span>Categories</span></a>
</li>

<li class="{{ Request::is('authors*') ? 'active' : '' }}">
    <a href="{!! route('authors.index') !!}"><i class="fa fa-edit"></i><span>Authors</span></a>
</li>

<li class="{{ Request::is('languages*') ? 'active' : '' }}">
    <a href="{!! route('languages.index') !!}"><i class="fa fa-edit"></i><span>Languages</span></a>
</li>

<li class="{{ Request::is('quotes*') ? 'active' : '' }}">
    <a href="{!! route('quotes.index') !!}"><i class="fa fa-edit"></i><span>Quotes</span></a>
</li>

