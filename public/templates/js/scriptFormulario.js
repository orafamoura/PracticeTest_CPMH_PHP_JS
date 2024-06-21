//variavel global
var telefoneValido = false;

//funcao para validar se os campos do formulario estao vazios ou nao
function validarFormulario() {
  var campos = ['name', 'birthdate', 'gender', 'telephone', 'address'];
  var formValido = true;
  valoresCampos ={};

  //percorre os campos e verificar se estao vazios
  campos.forEach(function(campo) {
    var inputElement = document.getElementById(campo);
    var errorDiv = document.getElementById(campo + '-error');
    
    if (campo === 'telephone') {
      if (!telefoneValido) {
        // Define mensagem de erro para o telefone se não for válido
        errorDiv.textContent = 'Por favor, insira um telefone válido';
        errorDiv.style.display = 'block';
        formValido = false;
      } else {
        // Limpa mensagem de erro se o telefone for válido
        errorDiv.textContent = '';
        errorDiv.style.display = 'none';
      }
    } else {
      // Verifica outros campos obrigatórios
      if (inputElement.value.trim() === '') {
        errorDiv.textContent = 'Este campo é obrigatório';
        errorDiv.style.display = 'block';
        formValido = false;
      } else {
        errorDiv.textContent = '';
        errorDiv.style.display = 'none';
      }
    }
    valoresCampos[campo] = inputElement.value;
  });
return formValido;
}

document.addEventListener('DOMContentLoaded', function() {
  var nameInput = document.getElementById('name');

  nameInput.addEventListener('input', function(event) {
    var input = event.target;
    var inputValue = input.value;

    // Remove caracteres que não são letras (apenas permite letras de A a Z e espaços)
    var formattedValue = inputValue.replace(/[^a-zA-ZÀ-ú\s]/g, '');

    // Atualiza o valor no input com a formatação
    input.value = formattedValue;
  });

  var telephoneInput = document.getElementById('telephone');

  telephoneInput.addEventListener('keyup', function(event){
    var input = event.target;

    var cleanedValue = input.value.replace(/\D/g, '');

    if(cleanedValue.length > 0){
      formattedValue = '(' + cleanedValue.substring(0, 2) + ') ';
      if (cleanedValue.length > 2) {
        formattedValue += cleanedValue.substring(2, 3) + ' ' + cleanedValue.substring(3, 7);
        if (cleanedValue.length > 7) {
          formattedValue += '-' + cleanedValue.substring(7);
        }
      }
    }
    if (formattedValue.length === 16){
      telefoneValido = true;
    } else {
      telefoneValido = false;
    }
    input.value = formattedValue;
  });
});