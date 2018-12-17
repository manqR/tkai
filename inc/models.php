<?php
    function AttributeSiswa(){
        $attribute = array(
             'Nis'
            ,'Nama Siswa'
            ,'Cabang'
            ,'Grade'
            ,'NISN'
            ,'Jenis Kelamin'
            ,'Tempat Lahir'
            ,'Tanggal Lahir'
            ,'Aksi'
        );

        return $attribute;
    }
    function AttributeKelasSiswa(){
        $attribute = array(
             'Nis'
            ,'Nama Siswa'
            ,'Cabang'
            ,'Grade'            
            ,'Jenis Kelamin'
            ,'Tempat Lahir'
            ,'Tanggal Lahir'            
        );

        return $attribute;
    }
    function AttributeKelasSiswaWithAksi(){
        $attribute = array(
             'Nis'
            ,'Nama Siswa'
            ,'Cabang'
            ,'Grade'            
            ,'Jenis Kelamin'
            ,'Tempat Lahir'
            ,'Tanggal Lahir'     
            ,'Aksi'       
        );

        return $attribute;
    }
    function AttributeKelas(){
        $attribute = array(
             'Kode'
            ,'Cabang'
            ,'Grade'
            ,'Tahun Ajaran'            
            ,'Wali Kelas'
            ,'Status Kelas'   
            ,'Aksi'        
        );

        return $attribute;
    }
    function AttributeTahunAjaran(){
        $attribute = array(
             'Tahun Ajaran'
            ,'Status'   
            ,'Aksi'
        );

        return $attribute;
    }

?>