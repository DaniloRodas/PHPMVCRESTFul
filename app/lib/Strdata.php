<?php
// Nos pirmitira agregar class extras para nuesro sistema

	class Strdata{

    public function str_fixedJson($str){
      $issussCadena = array('"', '(', "'");
      $fixCadena = array('\\"');
      return strtoupper(str_replace($issussCadena,$fixCadena,$str));
    }

    public function strBarcode_fixed($value){
        $value = str_replace("+", "", $value);
        $value = str_replace("*", "", $value);
        $value = str_replace("#", "", $value);
        $value = str_replace("á", "", $value);
        $value = str_replace("à", "&#0224;", $value);//Correccion
        $value = str_replace("â", "&#0226;", $value);//Correccion
        $value = str_replace("ã", "&#0227;", $value);//Correccion
        $value = str_replace("ª", "&#0170;", $value);//Correccion
        $value = str_replace("é", "&eacute;", $value);
        $value = str_replace("è", "&eacute;", $value);
        $value = str_replace("ê", "&eacute;", $value);
        $value = str_replace("í", "&iacute;", $value);
        $value = str_replace("ì", "&iacute;", $value);
        $value = str_replace("î", "&iacute;", $value);
        $value = str_replace("ó", "&oacute;", $value);
        $value = str_replace("ò", "&oacute;", $value);
        $value = str_replace("ô", "&oacute;", $value);
        $value = str_replace("õ", "&oacute;", $value);
        $value = str_replace("º", "&oacute;", $value);
        $value = str_replace("ú", "&uacute;", $value);
        $value = str_replace("ù", "&#0249;", $value);//Correccion
        $value = str_replace("û", "&uacute;", $value);
        $value = str_replace("ü", "&#0252;", $value);//Correccion
        $value = str_replace("Á", "&Aacute;", $value);
        $value = str_replace("À", "&Aacute;", $value);
        $value = str_replace("Â", "&Aacute;", $value);
        $value = str_replace("Ã", "&#0195;", $value);//Correccion
        $value = str_replace("É", "&Eacute;", $value);
        $value = str_replace("È", "&Eacute;", $value);
        $value = str_replace("Ê", "&#0202;", $value);//Correccion
        $value = str_replace("Í", "&Iacute;", $value);
        $value = str_replace("Ì", "&Iacute;", $value);
        $value = str_replace("Î", "&Iacute;", $value);
        $value = str_replace("Ó", "&Oacute;", $value);
        $value = str_replace("Ò", "&Oacute;", $value);
        $value = str_replace("Ô", "&Oacute;", $value);
        $value = str_replace("Õ", "&#0213;", $value);//Correccion
        $value = str_replace("Ú", "&Uacute;", $value);
        $value = str_replace("Ù", "&Uacute;", $value);
        $value = str_replace("Û", "&Uacute;", $value);
        $value = str_replace("ñ", "&ntilde;", $value);
        $value = str_replace("Ñ", "&Ntilde;", $value);
        $value = str_replace("@", "", $value);
        $value = str_replace("&", "y", $value);
        //$value = str_replace("-", "", $value);
        $value = str_replace("_", "", $value);
        $value = str_replace("<", "", $value);
        $value = str_replace(">", "", $value);
        $value = str_replace("javascript:", "", $value);
        $value = str_replace("%", "", $value);
        $value = str_replace("'", "", $value); /// Fuae agreado a la lista
        $value = str_replace("!", "", $value); /// Fuae agreado a la lista
        $value = str_replace("(", "", $value); /// Fuae agreado a la lista
        $value = str_replace(")", "", $value); /// Fuae agreado a la lista
        $value = str_replace("[", "", $value); /// Fuae agreado a la lista
        $value = str_replace("]", "", $value); /// Fuae agreado a la lista
        $value = str_replace("{", "", $value); /// Fuae agreado a la lista
        $value = str_replace("}", "", $value); /// Fuae agreado a la lista
        $value = str_replace(".", "", $value); /// Fuae agreado a la lista PUNTO
        $value = str_replace(",", "", $value); /// Fuae agreado a la lista COMA
        $value = str_replace('"', "", $value); /// Fuae agreado a la lista COMILLA DOBLE
        $value = str_replace("'", "", $value); /// Fuae agreado a la lista COMILLA APOSTROFE
        $value = str_replace("/", "", $value); /// Fuae agreado a la lista COMILLA APOSTROFE
        $value = str_replace("\\", "", $value); /// Fuae agreado a la lista COMILLA APOSTROFE
      return strtoupper($value);


    }



  }