$(document).ready(function(){
    $('.button-deleted').on('click', function(e){
        e.preventDefault()
        let id_alu = null
        id_alu = $(this).val()
        if(id_alu){
            if(confirm("Tem certeza que deseja EXCLUIR o aluno?")){
                $.ajax({
                    url: "AlunoDeleted.php",
                    type: "POST",
                    data: "id_alu="+id_alu ,
                    dataType: "html"
                }).done(function(response){
                    console.log("Aluno excluído")
                }).fail(function(jqXHR, TextResposta){
                    alert("Fail: "+TextResposta)
                }).always(function(){
                    location.reload()
                    console.log("Finalizando requisição Ajax!")
                })
            }else{
                console.log("Não foi identificado o ID do aluno!")
                alert("Falha na solicitação, verifique o log!")
                return false
            }
        }
    })
})