<div class="card">
    <div class="card-body">
        <form action="" id="setting_form">
            <div class="form-group">
                <label for="w">Width: </label>
                <input type="text" name="w" class="form-control size_input" value="3">
            </div>
            <div class="form-group">
                <label for="h">Height: </label>
                <input type="text" name="h" class="form-control size_input" value="3">
            </div>
            <div class="form-group">
                <label for="time">Time: </label>
                <input type="text" name="time" class="form-control" value="15">
            </div>
        </form>
        <div class="form-group">
            <button id="load_game" class="btn btn-success form-control">OK</button>
        </div>
    </div>
</div>
<script>
    (function ($) {
        $.fn.inputFilter = function (inputFilter) {
            return this.on("input keydown keyup mousedown mouseup select contextmenu drop", function () {
                if (inputFilter(this.value)) {
                    this.oldValue = this.value;
                    this.oldSelectionStart = this.selectionStart;
                    this.oldSelectionEnd = this.selectionEnd;
                } else if (this.hasOwnProperty("oldValue")) {
                    this.value = this.oldValue;
                    this.setSelectionRange(this.oldSelectionStart, this.oldSelectionEnd);
                }
            });
        };
    }(jQuery));

    $('.size_input').on('input', function () {
        if (parseInt(this.value) < 2) this.value = 2;
        if (parseInt(this.value) > 6) this.value = 6;
    });

    $('.game-container input').inputFilter(function (value) {
        return /^\d*$/.test(value);
    });

    $('#load_game').on('click', function () {
        $.ajax({
            url: 'game/load',
            type: 'get',
            data: $('#setting_form').serialize(),
            success: function (data) {
                $('.game-grid-container').html(data);
            }
        });
    });
</script>