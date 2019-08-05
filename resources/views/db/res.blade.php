<div class="row">
    <div class="col-sm-12">
        <pre>{{ $sql }}</pre>
    </div>
</div>
<div class="row">
    @foreach($data as $row)
        <div class="col-sm-3">
    <pre>
        {!! print_r($row) !!}
    </pre>
        </div>
@endforeach
</div>