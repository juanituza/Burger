<?php

namespace App\Entidades;

use DB;
use Illuminate\Database\Eloquent\Model;


class Pedidos extends Model
{
      protected $table = 'pedidos';
      public $timestamps = false;

      protected $fillable = [
            'idpedido', 'fk_idcliente', 'fk_idsucursal', 'fk_idestado', 'total', 'comentarios', 'fecha'
      ];

      protected $hidden = [];

      public function insertar()
      {
            $sql = "INSERT INTO $this->table (
                fk_idcliente,
                fk_idsucursal,
                fk_idestado,
                total,
                comentarios,
                fecha
            ) VALUES (?, ?, ?, ?, ?, ?);";
            $result = DB::insert($sql, [
                  $this->fk_idcliente,
                  $this->fk_idsucursal,
                  $this->fk_idestado,
                  $this->total,
                  $this->comentarios,
                  $this->fecha,
            ]);
            return $this->idpedido = DB::getPdo()->lastInsertId();
      }

      public function guardar()
      {
            $sql = "UPDATE $this->table SET
            fk_idcliente=$this->fk_idcliente,
            fk_idsucursal=$this->fk_idsucursal,
            fk_idestado=$this->fk_idestado,
            total=$this->total,
            comentarios='$this->comentarios',
            fecha='$this->fecha'
            WHERE idpedido=?";
            $affected = DB::update($sql, [$this->idpedido]);
      }

      public function eliminar()
      {
            $sql = "DELETE FROM $this->table WHERE
            idpedido=?";
            $affected = DB::delete($sql, [$this->idpedido]);
      }

      public function obtenerTodos()
      {
            $sql = "SELECT
                  A.idpedido,
                  A.fk_idcliente,
                  A.fk_idsucursal,
                  A.fk_idestado,
                  A.total,
                  A.comentarios,
                  A.fecha                

                FROM $this->table A ORDER BY A.idpedido";
            $lstRetorno = DB::select($sql);
            return $lstRetorno;
      }

      public function obtenerPorId($idpedido)
      {
            $sql = "SELECT
                idpedido,
                fk_idcliente,
                fk_idsucursal,
                fk_idestado,
                total,
                comentarios,
                fecha
                FROM $this->table WHERE idpedido = $idpedido";
            $lstRetorno = DB::select($sql);

            if (count($lstRetorno) > 0) {
                  $this->idpedido = $lstRetorno[0]->idpedido;
                  $this->fk_idcliente = $lstRetorno[0]->fk_idcliente;
                  $this->fk_idsucursal = $lstRetorno[0]->fk_idsucursal;
                  $this->fk_idestado = $lstRetorno[0]->fk_idestado;
                  $this->total = $lstRetorno[0]->total;
                  $this->comentarios = $lstRetorno[0]->comentarios;
                  $this->fecha = $lstRetorno[0]->fecha;

                  return $this;
            }
            return null;
      }

}
