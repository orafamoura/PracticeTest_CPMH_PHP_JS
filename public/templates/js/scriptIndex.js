document.addEventListener('DOMContentLoaded', function() {
  const searchInput = document.getElementById('searchInput');
  const searchButton = document.getElementById('searchButton');
  const pacientesTableBody = document.querySelector('#patientsTable tbody');
  const paginacaoContainer = document.getElementById('paginacaoContainer');
  const errorDiv = document.getElementById('nameNotFoundError');
  let paginaAtual = 1;

  // Função para buscar pacientes pelo nome e página
  function searchPatientsByName(name, pagina) {
    const url = `src/api/getPacientes.php?name=${name}&pagina=${pagina}`;
  
    fetch(url)
      .then(response => {
        if (!response.ok) {
          throw new Error('Erro ao buscar pacientes');
        }
        return response.json();
      })
      .then(data => {
        if (data.data.length === 0) {
          handleNoPatientsFound();
        } else if (data.data.length >= 0) {
          searchInput.style.borderColor = 'black';
          errorDiv.textContent = '';
          errorDiv.style.display = 'none';
          renderizarPacientes(data.data); //Renderizar pacientes
          renderizarControlesPaginacao(data.totalPaginas); //Renderizar controles de paginação para a página 1

        } else {
          searchInput.style.borderColor = 'black';
          errorDiv.textContent = '';
          errorDiv.style.display = 'none'; 
          renderizarPacientes(data);
          renderizarControlesPaginacao(data.totalPaginas);
        }
      })
      .catch(error => {
        handleNoPatientsFound();
      });
  }
  
  // Função para lidar com caso nenhum paciente seja encontrado
  function handleNoPatientsFound() {
    const errorDiv = document.getElementById('nameNotFoundError');
    searchInput.style.borderColor = 'red';
    errorDiv.textContent = 'Nenhum paciente encontrado com esse nome.';
    errorDiv.style.display = 'block';
    pacientesTableBody.innerHTML = ''; // Limpar tabela
    paginacaoContainer.innerHTML = ''; // Limpar controles de paginação

  }

  // Função para renderizar os pacientes na tabela
  function renderizarPacientes(pacientes) {
    pacientesTableBody.innerHTML = '';

    pacientes.forEach(paciente => {
      const row = document.createElement('tr');
      row.innerHTML = `
        <td>${paciente.name}</td>
        <td>${paciente.birthdate}</td>
        <td>${paciente.gender}</td>
        <td>${paciente.telephone}</td>
        <td>${paciente.address}</td>
      `;
      pacientesTableBody.appendChild(row);
    });
  }

  // Função para renderizar os controles de paginação
  function renderizarControlesPaginacao(totalPaginas) {
    paginacaoContainer.innerHTML = '';

    for (let i = 1; i <= totalPaginas; i++) {
      const linkPagina = document.createElement('a');
      linkPagina.href = '#';
      linkPagina.textContent = i;

      linkPagina.addEventListener('click', (e) => {
        e.preventDefault();
        paginaAtual = i;

        const searchValue = searchInput.value.trim().toLowerCase();
        searchPatientsByName(searchValue, i);
      });
      paginacaoContainer.appendChild(linkPagina);
    }
  }

  // Função para realizar a busca ao pressionar Enter
  searchInput.addEventListener('keydown', function(e) {
    if (e.key === 'Enter') {
      performSearch();
    }
  });

  // Função para realizar a busca ao clicar no botão "Buscar"
  searchButton.addEventListener('click', performSearch);

  // Função para executar a busca e carregar os pacientes
  function performSearch() {
    const searchValue = searchInput.value.trim().toLowerCase();
    paginaAtual = 1; // Resetar para a primeira página ao realizar uma nova busca
    searchPatientsByName(searchValue, paginaAtual);
  }

  // Chamar a função para buscar os dados dos pacientes ao carregar a página inicialmente
  performSearch();
});
