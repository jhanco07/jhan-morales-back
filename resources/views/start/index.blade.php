
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
            Numero de test: <span id="numberTest"></span>
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
            <br> <button id="initMatrix" class="btn btn-primary" onclick="initMatrix()" disabled >Iniciar Matriz</button>
        </div>

        <div class="col-md-12" id="bloqQueries">
            Selecccionar tipo consulta:  
            <select  class="form-control" id="typeQuery">
                <option value=""></option>
                <option value="1">Query</option>
                <option value="2">Update</option>
            </select>
            Valor para la consulta:            
            <input type="text" id="valueQuery" class="form-control">
            <span id="errorValueQuery"></span>
            <br> <button id="btnSendData" class="btn btn-primary" onclick="validacionesInput()" disabled > Enviar </button>
        </div>
    </div>        

    <div class="col-md-8" id="resultado">
        <table  class="table">
            <thead>
                <tr>
                    <th>Numero Test</th>
                    <th>Resultado consulta</th>
                </tr>
            </thead>
            <tbody id="results">
                
            </tbody>

        </table>

    </div> 
</div>

<script>
   var _token = $('meta[name="csrf-token"]').attr('content');
   
   var iteracion1 = 1;
   var iteracion2 = 1;
   
    $(document).ready(function () {
        $("#bloq").hide();
        $("#numberTest").html("1");
        $("#bloqQueries").hide();
        
        $("#typeQuery").change(function(){
            $("#valueQuery").val("");
        });
        
    });
    function initMatrix() {
        $("#bloqQueries").show();
        activarBoton($("#btnSendData"));
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
        $.post('{{ url('initMatrix') }}', {
            _token: _token,
            n: n,
            m: m
        }, function (data) {            
            $("#bloqQueries").show();            
            $("#initMatrix").attr("disabled","disabled");
             contarIteracionesTest();
        });
    }
    function okTest() {        
        activarBoton($("#initMatrix"));
        desactivarBoton($("#ok"));
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
    
    function sendQuery(){
        $.post('{{ url('initQuery') }}',{
             _token: _token,
             idTest:iteracion2 - 1 ,
             typeQuery: $("#typeQuery").val(),
             valueQuery: $("#valueQuery").val()
        }, function(data){
            if($("#typeQuery").val()== "2"){ 
                  $("#results").append("<tr><td>"+ data.idTest+ "</td><td>"+data.consulta +" "+ data.valueQuery+"</td></tr>");
            }else{
                $("#results").append("<tr><td>"+data.idTest+"</td><td>"+data.consulta +" "+ data.valueQuery+" "+ data.resultQ +"</td></tr>");
            }            
            contarIteracionesConsulta();
       });
    }
    
    function contarIteracionesConsulta(){
         iteracion1++;
        if(iteracion1 > $("#m").val()){
            $("#typeQuery").val("");
            $("#valueQuery").val("");
            desactivarBoton($("#btnSendData"));
            activarBoton($("#initMatrix"));        
            $("#n").val("");
            $("#m").val("");
            $("#bloqQueries").hide();  
            iteracion1=1;
            if(iteracion2 > $("#test").val() ){
                    $("#typeQuery").val("");
                    $("#valueQuery").val("");
                    desactivarBoton($("#btnSendData"));
                    desactivarBoton($("#initMatrix"));        
                    $("#n").val("");
                    $("#m").val("");
                    $("#bloqQueries").hide();
                    $("#results").html("");
                    activarBoton($("#ok")); 
                    iteracion2 = 1;
                    return false;
            }    
            return false;
        }
        
    }
    function contarIteracionesTest(){        
         $("#numberTest").html(iteracion2);    
        if(iteracion2 > $("#test").val() ){
            $("#typeQuery").val("");
            $("#valueQuery").val("");
            desactivarBoton($("#btnSendData"));
            desactivarBoton($("#initMatrix"));        
            $("#n").val("");
            $("#m").val("");
            $("#bloqQueries").hide();
            $("#results").html("");
            activarBoton($("#ok")); 
            iteracion2 = 1;
            return false;
        }     
        iteracion2++;
    }
    
    function activarBoton(selector){
        selector.removeAttr("disabled");
    }
    
    function desactivarBoton(selector){
        selector.attr("disabled", "disabled");
    }
    
    function validacionesInput(){
        var input= $("#valueQuery").val();
        var n= $("#n").val();
        var datos= input.split(" ");
        var typeQuery= $("#typeQuery").val();        
        
       
        if((typeQuery == 1 ) && ((datos.length < 6 ) || ((datos[0]< 1 || datos[0] > datos[3] || datos[3] > n)  ||
                 (datos[1] < 1 || datos[1] > datos[4] || datos[4] > n)  ||
                 (datos[2]< 1 || datos[2] > datos[5] || datos[5] > n)))) {                  
                $("#errorValueQuery").html("Error valores fuera de rango");
                return false;
        } 
        else if((typeQuery== 2) && ((datos.length < 4 ) || ( (datos[0] < 1 || datos[0] > n )  || (datos[1] < 1 || datos[1] > n )
                || (datos[2] < 1 || datos[2]> n ) ))){
             $("#errorValueQuery").html("Error valores fuera de rango");
             return false;
            
        }else{
              $("#errorValueQuery").html("");
              sendQuery();
        }
        
    }
</script>

@stop