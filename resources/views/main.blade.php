@extends('template')

@section('title')
Test task
@stop
@section('links')
    <link rel="stylesheet" href="css/db.css">
@stop

@section('content')
    <div class="row">
        <div class="col-sm-12 col-md-4 offset-md-2">
            <div class="card">
                <img src="/images/db-logo.png" alt="" class="card-img-top">
                <div class="card-body">
                    <div class="form-group">
                        <a href="/db" class="btn btn-primary form-control">DB queries</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-md-4">
            <div class="card">
                <img src="/images/game.png" alt="" class="card-img-top">
                <div class="card-body">
                    <div class="form-group">
                        <a href="/game" class="btn btn-primary form-control">Game</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
