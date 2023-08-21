// function clear_form_cep_origin() {
//   document.getElementById('address_origin').value=("");
//   document.getElementById('neighborhood_origin').value=("");
//   document.getElementById('city_origin').value=("");
//   document.getElementById('uf_origin').value=("");
// }

// function clear_form_cep_destination() {
//   document.getElementById('address_destination').value=("");
//   document.getElementById('neighborhood_destination').value=("");
//   document.getElementById('city_destination').value=("");
//   document.getElementById('uf_destination').value=("");
// }

// function meu_callback_origin(conteudo) {
//   if (!("erro" in conteudo)) {
//     //Atualiza os campos com os valores.
//     document.getElementById('address_origin').value=(conteudo.logradouro);
//     document.getElementById('neighborhood_origin').value=(conteudo.bairro);
//     document.getElementById('city_origin').value=(conteudo.localidade);
//     document.getElementById('uf_origin').value=(conteudo.uf);
//   }
//   else {
//     //CEP não Encontrado.
//     clear_form_cep_origin();
//     alert("CEP não encontrado.");
//   }
// }

// function meu_callback_destination(conteudo) {
//   if (!("erro" in conteudo)) {
//     //Atualiza os campos com os valores.
//     document.getElementById('address_destination').value=(conteudo.logradouro);
//     document.getElementById('neighborhood_destination').value=(conteudo.bairro);
//     document.getElementById('city_destination').value=(conteudo.localidade);
//     document.getElementById('uf_destination').value=(conteudo.uf);
//   }
//   else {
//     //CEP não Encontrado.
//     clear_form_cep_destination();
//     alert("CEP não encontrado.");
//   }
// }

// function search_cep_origin(valor) {
//   //Nova variável "cep" somente com dígitos.
//   var cep = valor.replace(/\D/g, '');

//   if (cep != "") {
//     //Expressão regular para validar o CEP.
//     var validacep = /^[0-9]{8}$/;

//     //Valida o formato do CEP.
//     if(validacep.test(cep)) {
//       //Preenche os campos com "..." enquanto consulta webservice.
//       document.getElementById('address_origin').value="...";
//       document.getElementById('neighborhood_origin').value="...";
//       document.getElementById('city_origin').value="...";
//       document.getElementById('uf_origin').value="...";

//       //Cria um elemento javascript.
//       var script = document.createElement('script');

//       //Sincroniza com o callback.
//       script.src = '//viacep.com.br/ws/'+ cep + '/json/?callback=meu_callback_origin';

//       //Insere script no documento e carrega o conteúdo.
//       document.body.appendChild(script);
//     }
//     else {
//       //cep é inválido.
//       clear_form_cep_origin();
//       alert("Formato de CEP inválido.");
//     }
//   }
//   else {
//     //cep sem valor, limpa formulário.
//     clear_form_cep_origin();
//   }
// };

// function search_cep_destination(valor) {
//   //Nova variável "cep" somente com dígitos.
//   var cep = valor.replace(/\D/g, '');

//   if (cep != "") {
//     //Expressão regular para validar o CEP.
//     var validacep = /^[0-9]{8}$/;

//     //Valida o formato do CEP.
//     if(validacep.test(cep)) {
//       //Preenche os campos com "..." enquanto consulta webservice.
//       document.getElementById('address_destination').value="...";
//       document.getElementById('neighborhood_destination').value="...";
//       document.getElementById('city_destination').value="...";
//       document.getElementById('uf_destination').value="...";

//       //Cria um elemento javascript.
//       var script = document.createElement('script');

//       //Sincroniza com o callback.
//       script.src = '//viacep.com.br/ws/'+ cep + '/json/?callback=meu_callback_destination';

//       //Insere script no documento e carrega o conteúdo.
//       document.body.appendChild(script);
//     }
//     else {
//       //cep é inválido.
//       clear_form_cep_destination();
//       alert("Formato de CEP inválido.");
//     }
//   }
//   else {
//     //cep sem valor, limpa formulário.
//     clear_form_cep_destination();
//   }
// };

// 1-inputCEP,2-Pegando CEP,
function pegarCPF(inputCEP, ...parametros) {
  const campos = [...parametros]
  const CEP = inputCEP.value
  const logradouro = document.querySelector(campos[0])
  const complemento = document.querySelector(campos[1])
  const bairro = document.querySelector(campos[2])
  const distrito = document.querySelector(campos[3])
  const uf = document.querySelector(campos[4])
  const url = fetch(`https://viacep.com.br/ws/${CEP}/json`)
  url.then(r => r.json()).then(r => {
    logradouro.value = r.logradouro
    complemento.value = r.complemento
    bairro.value = r.bairro
    distrito.value = r.localidade
    uf.value = r.uf

  })

}

// 22996734823



// let inputCEP3 = document.querySelector('.cep')
// inputCEP3.addEventListener('input', () => {
//   pegarCPF(inputCEP3, '.logradouro', '.complemento', '.bairro', '.cidade', '.uf')
// })

