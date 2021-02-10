$(function () {
    
    $("[name=start_date]").blur(function () {
        
        var data = $(this).val();
        var dia = data.substring(0, 2);
        var mes = data.substring(3, 5);
        var ano = data.substring(6, 10);
        var novaData = new Date(ano, (mes - 1), dia);
        var mesmoDia = parseInt(dia, 10) == parseInt(novaData.getDate());
        var mesmoMes = parseInt(mes, 10) == parseInt(novaData.getMonth()) + 1;
        var mesmoAno = parseInt(ano) == parseInt(novaData.getFullYear());
        if ($(this).val() != "") {
            if (!((mesmoDia) && (mesmoMes) && (mesmoAno)))
            {
                alert("Data Inválida");
                $(this).val("");
                $(this).focus();
                return false;
            }
        }
        
        if($("[name=end_date]").val()!="" && $("[name=start_date]").val()!=""){
            if(gerarData($("[name=start_date]").val()) > gerarData($("[name=end_date]").val())){
              alert("A data início não pode ser maior que a data fim");
              $("[name=start_date]").val("");
              return false;
            }
            
            var date1 = gerarData($("[name=start_date]").val());
            var date2 = gerarData($("[name=end_date]").val());
            var timeDiff = date2 - date1;
            var diffSegundos = timeDiff / 1000;
            var diffMinutos = diffSegundos / 60;
            var diffHoras = diffMinutos / 60;
            var diffDias = diffHoras / 24;
            var diffMeses = diffDias / 30;

            if(diffMeses<11.9){
              alert("O prazo mínimo do contrato é de um ano");
              $("[name=end_date]").val("");
              return false; 
            }
        }
    });
    
    $("[name=end_date]").blur(function () {
        
        var data = $(this).val();
        var dia = data.substring(0, 2);
        var mes = data.substring(3, 5);
        var ano = data.substring(6, 10);
        var novaData = new Date(ano, (mes - 1), dia);
        var mesmoDia = parseInt(dia, 10) == parseInt(novaData.getDate());
        var mesmoMes = parseInt(mes, 10) == parseInt(novaData.getMonth()) + 1;
        var mesmoAno = parseInt(ano) == parseInt(novaData.getFullYear());
        if ($(this).val() != "") {
            if (!((mesmoDia) && (mesmoMes) && (mesmoAno)))
            {
                alert("Data Inválida");
                $(this).val("");
                $(this).focus();
                return false;
            }
        }
        
        if($("[name=end_date]").val()!="" && $("[name=start_date]").val()!=""){
            if(gerarData($("[name=start_date]").val()) > gerarData($("[name=end_date]").val())){
              alert("A data início não pode ser maior que a data fim");
              $("[name=end_date]").val("");
              return false;
            }
            
            var date1 = gerarData($("[name=start_date]").val());
            var date2 = gerarData($("[name=end_date]").val());
            var timeDiff = date2 - date1;
            var diffSegundos = timeDiff / 1000;
            var diffMinutos = diffSegundos / 60;
            var diffHoras = diffMinutos / 60;
            var diffDias = diffHoras / 24;
            var diffMeses = diffDias / 30;

            if(diffMeses<11.9){
              alert("O prazo mínimo do contrato é de um ano");
              $("[name=end_date]").val("");
              return false; 
            }
        }
    });
    
   $('#property').change(function () {
        var property = $(this).val();
        document.getElementById("value_lessor").innerHTML = "";
        if(property!=""){
            $.getJSON( path + '/contract/getOwner/'+property, function (data){

                $.each(data.owner, function(i, obj){

                    document.getElementById("value_lessor").innerHTML += obj.name ;
                     $("[name=lessor]").val(obj.id);
                });

            });
        }
    });
    
});

function gerarData(str) {
    var partes = str.split("/");
    return new Date(partes[2], partes[1] - 1, partes[0]);
}