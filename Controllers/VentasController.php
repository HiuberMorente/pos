<?php

  class VentasController{
    public static function showSalesController($item, $value){
      $table = "ventas";
      return VentasModel::showSalesModel($table, $item, $value);
    }
  }