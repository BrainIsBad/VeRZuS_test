@extends('template')

@section('title')
    Game
@stop
@section('links')
    <link rel="stylesheet" href="css/game.css">
@stop
@section('content')
    <div class="row">
        <div class="col-sm-12">
            <button class="btn btn-primary" onclick="history.back();">Back</button>
        </div>
    </div>
    <div class="row justify-content-center">
        <h1>Game</h1>
        <div class="game-container">
            <div class="game-grid-container">
                <button id="start_btn" class="btn btn-success">START</button>
            </div>
        </div>
    </div>
    <script>
        $('#start_btn').on('click', function () {
            $.ajax({
                url: 'game/settings',
                type: 'get',
                success: function (data) {
                    $('.game-grid-container').html(data);
                }
            });
        });
    </script>
@stop