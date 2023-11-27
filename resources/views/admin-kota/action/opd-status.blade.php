@if(\App\Models\Lock::status($model->id) == '1')
    <b style="color:red">Locked</b>
@else
    <b style="color:green">Open</b>
@endif