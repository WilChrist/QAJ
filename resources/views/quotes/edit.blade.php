@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Quote
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($data['quote'], ['route' => ['quotes.update', $data['quote']->id], 'method' => 'patch']) !!}

                        @include('quotes.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection
@section('scripts')
<script>
    $(document).ready(function() {
        $('.many_categories').select2();
    });
</script>
@endsection