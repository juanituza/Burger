<?php

namespace App\Entidades;

use DB;
use Illuminate\Database\Eloquent\Model;


class Sucursal extends Model
{
      protected $table = 'sucursales';
      public $timestamps = false;

      protected $fillable = [
            'idsucursal', 'nombre', 'domicilio', 'telefono', 'link_mapa'
      ];

      protected $hidden = [];

      public function insertar()
      {
            $sql = "INSERT INTO $this->table (
                nombre,
                domicilio,
                telefono,
                link_mapa,
                
            ) VALUES (?, ?, ?, ?);";
            $result = DB::insert($sql, [
                  $this->nombre,
                  $this->domicilio,
                  $this->telefono,
                  $this->link_mapa,
                 
            ]);
            return $this->idsucursal = DB::getPdo()->lastInsertId();
      }
      public function guardar()
      {
            $sql = "UPDATE $this->table SET
            nombre='$this->nombre',
            apellido='$this->apellido',
            telefono='$this->telefono',
            link_mapa='$this->link_mapa',
            
            WHERE idsucursal=?";
            $affected = DB::update($sql, [$this->idsucursal]);
      }
      public function eliminar()
      {
            $sql = "DELETE FROM $this->table WHERE
            idsucursal=?";
            $affected = DB::delete($sql, [$this->idsucursal]);
      }
      public function obtenerTodos()
      {
            $sql = "SELECT
                  A.idsucursal,
                  A.nombre,
                  A.apellido,
                  A.telefono,
                  A.link_mapa             

                FROM $this->table A ORDER BY A.nombre";
            $lstRetorno = DB::select($sql);
            return $lstRetorno;
      }
      public function obtenerPorId($idsucursal)
      {
            $sql = "SELECT
                idsucursal,
                nombre,
                apellido,
                telefono,
                link_mapa
                
                FROM $this->table WHERE idcliente = $idsucursal";
            $lstRetorno = DB::select($sql);

            if (count($lstRetorno) > 0) {
                  $this->idsucursal = $lstRetorno[0]->idsucursal;
                  $this->nombre = $lstRetorno[0]->nombre;
                  $this->apellido = $lstRetorno[0]->apellido;
                  $this->telefono = $lstRetorno[0]->telefono;
                  $this->link_mapa = $lstRetorno[0]->link_mapa;
                 

                  return $this;
            }
            return null;
      }


}
