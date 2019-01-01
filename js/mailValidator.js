$(document).ready(function(){
   $('#formContato').submit(function(e) {
    e.preventDefault();
    var nome = $('.nome').val();
    var email = $('.email').val();
    var assunto = $('.assunto').val();
    var mensagem = $('.mensagem').val();
    $.ajax({
        url: '/_portifolio/enviarEmail.php', // caminho para o script que vai processar os dados -RODA NO LOCALHOST-
        /*url: '/enviarEmail.php', // caminho para o script que vai processar os dados -RODA NO ONLINE-*/
        type: 'POST',
        data: {nome: nome, email: email, assunto: assunto, mensagem: mensagem},
        success: function(response) {
            //$('#resp').html(response);
            $.Notification.autoHideNotify('success', 'top right', 'Sucesso!', 'Mensagem enviada para o administrador do site.');
			var Name = $('.nome').val('');
            var Email = $('.email').val('');
            var Subject = $('.assunto').val('');
			var Message = $('.mensagem').val('');
        },
        error: function(xhr, status, error) {
            alert(xhr.responseText);
        }
    });
    return false;
});
});
