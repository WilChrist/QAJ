<table class="table table-responsive" id="authors-table">
    <thead>
        <tr>
            <th>Full Name</th>
        <th>Popular Name</th>
        <th>Biography</th>
        <th>Link To Full Biography</th>
            <th colspan="3">Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($authors as $author)
        <tr>
            <td>{!! $author->full_name !!}</td>
            <td>{!! $author->popular_name !!}</td>
            <td>{!! $author->biography !!}</td>
            <td>{!! $author->link_to_full_biography !!}</td>
            <td>
                {!! Form::open(['route' => ['authors.destroy', $author->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('authors.show', [$author->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('authors.edit', [$author->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>