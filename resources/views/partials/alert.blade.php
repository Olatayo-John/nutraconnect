<div class="alertWrapper">
    @if (session()->has('status'))
        <div class="alertDiv">
            <p><strong class="alertMsg">{{ session('status') }}</strong></p>
        </div>
    @endif

    <div class="alertDivAjax bg-danger" id="alertDivAjaxErr">
        <p><strong class="alertMsgAjax"></strong></p>
    </div>

    <div class="alertDivAjax bg-success" id="alertDivAjaxSucc">
        <p><strong class="alertMsgAjax">fef</strong></p>
    </div>
</div>

<style>
    .alertWrapper{
        position: fixed;
        right: 0;
        z-index:999;
    }

    .alertDiv{
        background:#020073;
        padding: 7px;
        margin: 7px 0;
    }
    .alertDiv p,.alertDivAjax p{
        margin: 0 !important;
    }
    strong{
        color: white;
        font-weight: 500;
    }

    .alertDivAjax{
        padding: 7px;
        margin: 7px 0;
        display: none;
    }
</style>
