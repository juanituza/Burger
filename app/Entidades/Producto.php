<?php

namespace App\Entidades;

use DB;
use Illuminate\Database\Eloquent\Model;


class Productos extends Model
{
      protected $table = 'productos';
      public $timestamps = false;

      protected $fillable = [
            'idproducto', 'nombre', 'descripcion', 'imagen', 'precio'
      ];

      protected $hidden = [];

      public function insertar()
      {
            $sql = "INSERT INTO $this->table (
                nombre,
                descripcion,
                imagen,
                precio
                
            ) VALUES (?, ?, ?, ?);";
            $result = DB::insert($sql, [
                  $this->nombre,
                  $this->descripcion,
                  $this->imagen,
                  $this->precio,
            ]);
            return $this->idproducto = DB::getPdo()->lastInsertId();
      }
      public function guardar()
      {
            $sql = "UPDATE $this->table SET
            nombre='$this->nombre',
            descripcion='$this->descripcion',
            imagen='$this->imagen',
            precio=$this->precio

            WHERE idproducto=?";
            $affected = DB::update($sql, [$this->idproducto]);
      }
      public function eliminar()
      {
            $sql = "DELETE FROM $this->table WHERE
            idproducto=?";
            $affected = DB::delete($sql, [$this->idproducto]);
      }
      public function obtenerTodos()
      {
            $sql = "SELECT
                  A.idproducto,
                  A.nombre,
                  A.descripcion,
                  A.imagen,
                  A.precio               

                FROM $this->table A ORDER BY A.nombre";
            $lstRetorno = DB::select($sql);
            return $lstRetorno;
      }
      public function obtenerPorId($idproducto)
      {
            $sql = "SELECT
                idproducto,
                nombre,
                descripcion,
                imagen,
                precio

                FROM $this->table WHERE idcliente = $idproducto";
            $lstRetorno = DB::select($sql);

            if (count($lstRetorno) > 0) {
                  $this->idproducto = $lstRetorno[0]->idproducto;
                  $this->nombre = $lstRetorno[0]->nombre;
                  $this->descripion = $lstRetorno[0]->descripion;
                  $this->imagen = $lstRetorno[0]->imagen;
                  $this->precio = $lstRetorno[0]->precio;
            
                  return $this;
            }
            return null;
      }


}
