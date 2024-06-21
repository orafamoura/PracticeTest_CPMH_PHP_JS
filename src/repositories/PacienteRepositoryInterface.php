<?php
namespace src\repositories;

use src\entities\Paciente;

//interface paciente
interface PacienteRepositoryInterface
{
  public function findByName(string $name, int $paginaAtual = 1, int $itensPorPagina = 10): ?array;
  public function save(Paciente $paciente): bool;

}
?>