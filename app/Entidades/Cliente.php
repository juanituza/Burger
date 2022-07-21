<?php

namespace App\Entidades;

use DB;
use Illuminate\Database\Eloquent\Model;


class Cliente extends Model
{
      protected $table = 'clientes';
      public $timestamps = false;

      protected $fillable = [
            'idcliente', 'nombre', 'apellido', 'telefono', 'dni', 'correo', 'clave', 
      ];

      protected $hidden = [];

      public function cargarDesdeRequest($request)
      {
            $this->idcliente = $request->input('id') != "0" ? $request->input('id') : $this->idcliente;
            $this->nombre = $request->input('txtNombre');
            $this->apellido = $request->input('txtApellido');
            $this->dni = $request->input('txtDni');
            $this->telefono = $request->input('txtTelefono');
            $this->correo = $request->input('txtCorreo');
            $this->clave = $request->input('txtClave');
      }

      public function insertar()
      {
            $sql = "INSERT INTO $this->table (
                nombre,
                apellido,
                telefono,
                dni,
                correo,
                clave
            ) VALUES (?, ?, ?, ?, ?, ?);";
            $result = DB::insert($sql, [
                  $this->nombre,
                  $this->apellido,
                  $this->telefono,
                  $this->dni,
                  $this->correo,
                  $this->clave,
            ]);
            return $this->idcliente = DB::getPdo()->lastInsertId();
      }

      public function guardar(){
            $sql = "UPDATE clientes SET
                  nombre='$this->nombre',
                  apellido='$this->apellido',
                  telefono='$this->telefono',
                  dni='$this->dni',
                  correo='$this->correo',
                  clave='$this->clave'
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
                  A.dni,                
                  A.telefono,
                  A.correo,
                  A.clave

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
                dni,
                telefono,
                correo,
                clave
                FROM $this->table WHERE idcliente = $idliente";
            $lstRetorno = DB::select($sql);

            if (count($lstRetorno) > 0) {
                  $this->idcliente = $lstRetorno[0]->idcliente;
                  $this->nombre = $lstRetorno[0]->nombre;
                  $this->apellido = $lstRetorno[0]->apellido;
                  $this->dni = $lstRetorno[0]->dni;
                  $this->telefono = $lstRetorno[0]->telefono;
                  $this->correo = $lstRetorno[0]->correo;
                  $this->clave = $lstRetorno[0]->clave;

                  return $this;
            }
            return null;
      }
}
