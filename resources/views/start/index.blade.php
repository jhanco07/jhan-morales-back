
@extends('layout')
@section('content')

<div class="row">
    <div class="col-md-2"></div> 
    <div class="col-md-8">
        <div class="control-group">

            <div class="col-md-3">
                <label class="control-label">Size matrix:</label>
                <input type="text" id="size" class="form-control"> 
            </div>

            <div class="col-md-12">
                <br> <button id="ok" class="btn btn-primary" > Aceptar </button>
            </div><br>

        </div>
    </div> 
    <div class="col-md-2"></div> 
</div>
<hr>


<div class="row">
    <div class="col-md-2"></div> 
    <div class="col-md-8">
        <p>Resultado</p>
    </div> 
    <div class="col-md-2" id="resultado"></div> 
</div>

<script>
    $(document).on("click", "#ok", function () {
        var _token = $('meta[name="csrf-token"]').attr('content');
        $.post('{{ url('add') }}',{ _token : _token}, function (data) {

        })
    });
</script>

@stop