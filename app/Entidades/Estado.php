<?php

namespace App\Entidades;

use DB;
use Illuminate\Database\Eloquent\Model;


class Estado extends Model
{
      protected $table = 'estados';
      public $timestamps = false;

      protected $fillable = [
            'idestado', 'nombre'
      ];

      protected $hidden = [];

      public function insertar()
      {
            $sql = "INSERT INTO $this->table (
                nombre
                
            ) VALUES (?);";
            $result = DB::insert($sql, [
                  $this->nombre,

            ]);
            return $this->idestado = DB::getPdo()->lastInsertId();
      }
      public function guardar()
      {
            $sql = "UPDATE $this->table SET
            nombre='$this->nombre'

            WHERE idestado=?";
            $affected = DB::update($sql, [$this->idestado]);
      }

      public function eliminar()
      {
            $sql = "DELETE FROM $this->table WHERE
            idestado=?";
            $affected = DB::delete($sql, [$this->idestado]);
      }

      public function obtenerTodos()
      {
            $sql = "SELECT
                  A.idestado,
                  A.nombre

                FROM $this->table A ORDER BY A.nombre";
            $lstRetorno = DB::select($sql);
            return $lstRetorno;
      }

      public function obtenerPorId($idliente)
      {
            $sql = "SELECT
                idcliente,
                nombre,
                apellido,
                telefono,
                correo,
                clave,
                dni
                FROM $this->table WHERE idcliente = $idliente";
            $lstRetorno = DB::select($sql);

            if (count($lstRetorno) > 0) {
                  $this->idcliente = $lstRetorno[0]->idcliente;
                  $this->nombre = $lstRetorno[0]->nombre;
                  $this->apellido = $lstRetorno[0]->apellido;
                  $this->telefono = $lstRetorno[0]->telefono;
                  $this->correo = $lstRetorno[0]->correo;
                  $this->clave = $lstRetorno[0]->clave;
                  $this->dni = $lstRetorno[0]->dni;

                  return $this;
            }
            return null;
      }





      
}
