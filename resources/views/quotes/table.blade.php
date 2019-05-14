<table class="table table-responsive" id="quotes-table">
    <thead>
        <tr>
            <th>Content</th>
        <th>Link To The Source</th>
        <th>Approuved</th>
        <th>Author</th>
        <th>Language</th>
            <th colspan="3">Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($quotes as $quote)
        <tr>
            <td style="max-width: 200px;">
                <span style="overflow: hidden; text-overflow: ellipsis; display: inline-block; white-space: nowrap; max-width: 100%;">
                    {!! $quote->content !!}
                </span>
            </td>
            <td style="max-width: 100px;">
                <span style="overflow: hidden; text-overflow: ellipsis; display: inline-block; white-space: nowrap; max-width: 100%;">
                    {!! $quote->link_to_the_source !!}
                </span>
            </td>
            <td>{{$quote->approuved?"yes":"no"}}</td>
            <td>{{ $quote->author->popular_name}}</td>
            <td>{!! $quote->language->name !!}</td>
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