<table class="table table-responsive" id="quotes-table">
    <thead>
        <tr>
            <th>Content</th>
        <th>Link To The Source</th>
        <th>Approuved</th>
        <th>Author Id</th>
        <th>Language Id</th>
        <th>User Id</th>
            <th colspan="3">Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($quotes as $quote)
        <tr>
            <td>{!! $quote->content !!}</td>
            <td>{!! $quote->link_to_the_source !!}</td>
            <td>{!! $quote->approuved !!}</td>
            <td>{!! $quote->author_id !!}</td>
            <td>{!! $quote->language_id !!}</td>
            <td>{!! $quote->user_id !!}</td>
            <td>
                {!! Form::open(['route' => ['quotes.destroy', $quote->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('quotes.show', [$quote->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('quotes.edit', [$quote->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>