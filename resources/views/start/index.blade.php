
@extends('layout')
@section('content')

<div class="row">
    <div class="col-md-2"></div> 
    <div class="col-md-8">
        <div class="control-group">

            <div class="col-md-3">
                <label class="control-label">Test cases(T):</label>
                <input type="number" id="test"  class="form-control" onfocusout="validarTest()">
                <span id="errorTest"></span>
            </div>

            <div class="col-md-12">
                <br> <button id="ok" class="btn btn-primary" onclick="okTest()" > Start </button>
            </div><br>

        </div>
    </div> 
    <div class="col-md-2"></div> 
</div>
<hr>


<div class="row" id="bloq">
    <div class="col-md-4" id="controles">
        <div class="col-md-12">
            Test case number: <span id="numberTest"></span>
        </div>
        <div class="col-md-12">
            N: <input type="number" id="n" class="form-control">
            <span id="errorN"></span>
        </div>
        <div class="col-md-12">
            M: <input type="number" id="m" class="form-control">
            <span id="errorM"></span>
        </div>          
        <div class="col-md-12">
            <br> <button id="initMatrix" class="btn btn-primary" onclick="initMatrix()">Init Matrix</button>
        </div>

        <div class="col-md-12" id="bloqQueries">
         QUERIES:  <select id="" class="form-control">
                <option value="1">Query</option>
                <option value="2">Update</option>
            </select>
        </div>
    </div>        
</div>  
<div class="col-md-8" id="resultado"></div> 
</div>

<script>

    $(document).ready(function () {
        $("#bloq").hide();
        $("#numberTest").html("1");
        $("#bloqQueries").hide();

    });

    function initMatrix() {
        var n = $("#n").val();
        if (n.length == 0 || n > 1000 || n < 0) {
            $("#errorN").html("N debe ser mayor que 0 y menor que 101");
            $("#n").val("");
            return false;
        }
        $("#errorN").html("");
        var m = $("#m").val();
        if (m.length == 0 || m > 1000 || m < 0) {
            $("#errorM").html("M debe ser mayor que 0 y menor que 1001");
            $("#m").val("");
            return false;
        }
        $("#errorM").html("");

        var _token = $('meta[name="csrf-token"]').attr('content');
        $.post('{{ url('initMatrix') }}', {
            _token: _token,
            n: n,
            m: m
        }, function (data) {
            $("#bloqQueries").show();
        });


    }

    function okTest() {
        var test = $("#test").val();
        if (test.length == 0 || test > 50) {
            $("#errorTest").html("Test debe ser mayor que 0 y menor que 51");
            return false;
        } else {
            $("#bloq").show();
        }
    }

    function validarTest() {
        var test = $("#test").val();
        if (test < 1 || test > 50) {
            $("#errorTest").html("Test debe ser mayor que 0 y menor que 51");
            $("#test").val("")
            return false;
        } else {
            $("#errorTest").html("");
        }
    }


</script>

@stop