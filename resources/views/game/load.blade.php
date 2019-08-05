<div class="timer-continer">
    <div id="timer">{!! $time !!}</div>
</div>
<div class="log-bar"></div>
@foreach ($grid as $row)
    <div class="game-row">
        @foreach ($row as $cell)
            <div class="game-cell disabled" id="{!! $cell['id'] !!}">
                <input type="hidden" class="x" value="{!! $cell['x'] !!}">
                <input type="hidden" class="y" value="{!! $cell['y'] !!}">
                <input type="hidden" class="cell-active" value="{!! $cell['active'] !!}">
                @if ($cell['active'])
                    START
                @endif
            </div>
        @endforeach
    </div>
@endforeach
<div class="game-steps-container">
    @foreach ($motion as $m)
        <div class="game-step">
            <i class="material-icons">

            </i>
        </div>
    @endforeach
</div>
<script>
    function sleep(ms) {
        return new Promise(resolve => setTimeout(resolve, ms));
    }

    steps($.parseJSON('{!! json_encode($motion) !!}'), {
        x: parseInt($('.cell-active[value=1]').parent().find('.x').val()),
        y: parseInt($('.cell-active[value=1]').parent().find('.y').val()),
    });
    async function steps(data, active) {
        let time = 400,
            dLen = data.length,
            click = false;
        for (let i in data) {
            await sleep(time);
            let stepContainer = $('.game-steps-container').children().eq(i),
                stepAll = $('.game-step');
            stepContainer.find('i').text(data[i]);
            stepAll.removeClass('active');
            stepContainer.prev().addClass('active');

            if (parseInt(i) === dLen - 1) {
                await sleep(time);
                stepAll.removeClass('active');
                stepContainer.addClass('active');
                await sleep(time);
                stepAll.removeClass('active');
            }
        }
        $('.game-cell').removeClass('disabled').on('click', function () {
            if ($(this).hasClass('disabled')) return false;
            $('.game-cell').addClass('disabled');
            if (!parseInt($('#timer').text())) return false;

            click = true;

            let dirArr = {
                    arrow_upward: {
                        val: -1,
                        ax: 1,
                    },
                    arrow_back: {
                        val: -1,
                        ax: 0,
                    },
                    arrow_downward: {
                        val: 1,
                        ax: 1,
                    },
                    arrow_forward: {
                        val: 1,
                        ax: 0
                    },
                },
                coord = {
                    x: parseInt($(this).find('.x').val()),
                    y: parseInt($(this).find('.y').val()),
                };

            for (let i in data) {
                let dir = dirArr[data[i]];
                if (dir.ax) active.y += dir.val;
                if (!dir.ax) active.x += dir.val;
            }

            if (coord.x === active.x && coord.y === active.y) {
                $(this).text('Success!');
            } else {
                $(this).text('Not right!');
                $('.game-cell').map(function () {
                    let x = parseInt($(this).find('.x').val()),
                        y = parseInt($(this).find('.y').val());

                    if (active.x === x && active.y === y) $(this).text('Here!')
                });
            }
            showRestart();
        });

        let timer = parseInt($('#timer').text());
        if (isNaN(timer)) timer = 0;

        while (timer > 0 && !click) {
            await sleep(1000);
            timer--;
            $('#timer').text(timer);
        }

        if (!timer && !$('.game-cell').hasClass('disabled')) {
            $('.log-bar').append($('<span>', {class: 'error'}).text('Time is out!'));
            $('.game-cell').addClass('disabled');
            showRestart();
        }
    }
    function showRestart() {
        if (!$('.restart-btn-container').length) {
            $('.game-row').last().after($('<div>', {class: 'restart-btn-container'}).append($('<button>', {
                text: 'RESTART',
                class: 'btn btn-primary',
                id: 'restart_btn',
            })));
            $('#restart_btn').on('click', function () {
                $.ajax({
                    url: 'game/settings',
                    type: 'get',
                    success: function (data) {
                        $('.game-grid-container').html(data);
                    }
                });
            });
        }
    }
</script>