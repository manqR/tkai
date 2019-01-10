<?php
    function FormatRupiah($rp){
        $rupiah = number_format($rp,0,".",".");
        return $rupiah;
    }
    function SaveRupiah($val){
        return str_replace('.','',$val);
    }

?>