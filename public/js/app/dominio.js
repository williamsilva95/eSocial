function inserir(){
    $.get("dominio/create", function(){
        window.location.href = "dominio/create"
    });
}

function editar(id){
    $.get("dominio/edit/" + id, function(resposta){
        window.location.href = "dominio/edit/" + id
    });
}

function visualizar(id){
    $.get("dominio/show/" + id, function(resposta){
        window.location.href = "dominio/show/" + id
    });
}

function deletar(id, nome, tld){

    swal({
        title: 'Excluir Domínio',
        text: 'Deseja realmente excluir esse domínio:' + nome + tld + '?',
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Sim",
        cancelButtonText: "Não",
        closeOnConfirm: false,
        closeOnCancel: true
    }).then((result) => {
        if(result.value) {
            $.ajax({
                type: "POST",
                url: "dominio/destroy",
                data: {_token: _token, id: id},
                success: function(data){
                    if (data.success == true) {
                        swal({
                            title: data.msg,
                            type: "success",
                            timer: 2000,
                            showConfirmButton: false
                        }).then((result) => {
                            location.reload();
                        });
                    }else{
                        swal("Dominio", data.msg , "error");
                    }
                    CustomPreload.hide();
                }, error: function(){
                    CustomPreload.hide();
                    swal("Funções", 'Não é permitido a exclusão desse Domínio.' , "error");
                }
            }).fail(function(resposta) {
                if(resposta.status == 401){
                    CustomPreload.hide();
                    swal("Funções", "Sem permissão para acessar essa funcionalidade." , "error");
                }
            });
        }
    });
}

