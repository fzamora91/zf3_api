<?php
namespace Usuarios\Model\Dao;

interface IUsuarioDao
{
  public function obtenerPorId($id);
  public function obtenerTodos();
}