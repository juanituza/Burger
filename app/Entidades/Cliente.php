<?php

namespace App\Entidades;

use DB;
use Illuminate\Database\Eloquent\Model;


class Cliente extends Model
{
      protected $table = 'clientes';
      public $timestamps = false;

      protected $fillable = [
            'idcliente', 'nombre', 'apellido', 'telefono', 'correo', 'clave', 'dni'
      ];

      protected $hidden = [];

      public function cargarDesdeRequest($request)
      {
            $this->idcliente = $request->input('id') != "0" ? $request->input('id') : $this->idcliente;
            $this->nombre = $request->input('txtNombre');
            $this->apellido = $request->input('txtApellido');
            $this->telefono = $request->input('txtTelefono');
            $this->correo = $request->input('txtCorreo');
            $this->clave = $request->input('txtClave');
            $this->dni = $request->input('txtDni');
      }

      public function insertar()
      {
            $sql = "INSERT INTO $this->table (
                nombre,
                apellido,
                telefono,
                correo,
                clave,
                dni
            ) VALUES (?, ?, ?, ?, ?, ?);";
            $result = DB::insert($sql, [
                  $this->nombre,
                  $this->apellido,
                  $this->telefono,
                  $this->correo,
                  $this->clave,
                  $this->dni,
            ]);
            return $this->idcliente = DB::getPdo()->lastInsertId();
      }

      public function guardar()
      {
            $sql = "UPDATE $this->table SET
            nombre='$this->nombre',
            apellido='$this->apellido',
            telefono='$this->telefono',
            correo='$this->correo',
            clave='$this->clave',
            dni='$this->dni'
            WHERE idcliente=?";
            $affected = DB::update($sql, [$this->idcliente]);
      }


      public function eliminar()
      {
            $sql = "DELETE FROM $this->table WHERE
            idcliente=?";
            $affected = DB::delete($sql, [$this->idcliente]);
      }


      public function obtenerTodos()
      {
            $sql = "SELECT
                  A.idcliente,
                  A.nombre,
                  A.apellido,
                  A.telefono,
                  A.correo,
                  A.clave,
                  A.dni                

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
