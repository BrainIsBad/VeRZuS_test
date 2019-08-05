@extends('template')
@section('title')
DB Queries
@stop

@section('links')
    <link rel="stylesheet" href="css/db.css">
    <script>
        function replaceBlock(selector, url) {
            $.ajax({
                url: url,
                type: 'get',
                success: function (data) {
                    $(selector).html(data);
                }
            });
        }
    </script>
@stop

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <button class="btn btn-primary" onclick="history.back();">Back</button>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body db-btn-container">
                    <button class="btn btn-primary" onclick="replaceBlock('#db_res', 'db/b2a')">Books 2 authors</button>
                    <button class="btn btn-primary" onclick="replaceBlock('#db_res', 'db/bua')">Books unique authors</button>
                    <button class="btn btn-primary" onclick="replaceBlock('#db_res', 'db/aa7')">Authors average > 7</button>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Results:</h5>
                    <div class="card-text" id="db_res">

                    </div>
                </div>
            </div>
        </div>
    </div>
@stop