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
    function AttributeRegister(){
        $attribute = array(
             'No Registrasi'
            ,'NIS'
            ,'Nama Siswa'
            ,'Cabang'
            ,'Grade'
            ,'Jenis Kelamin'
            ,'Tempat Lahir'
            ,'Tanggal Lahir'
            ,'<input type="checkbox" id= "checkAll" />'
            ,'Aksi '
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
            ,'Guru Kelas'
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
    function AttributeTagihan(){
        $attribute = array(
             'Cabang'
            ,'Grade'   
            ,'Tahun Ajaran'
            ,'Seragam'
            ,'Peralatan'
            ,'Uang Pangkal'
            ,'Uang Bangunan'
            ,'Material Penunjang'
            ,'Material Tahunan'
            ,'Aksi'
        );

        return $attribute;
    }
    function AttributeListTunggakan(){
        $attribute = array(
             'Nis'
            ,'Nama Lengkap'   
            ,'Jenis Kelamin'
            ,'Tempat Lahir'
            ,'Tanggal Lahir'
            ,'Tahun Ajaran'
            ,'Remarks'
            ,'Nominal'

         
        );

        return $attribute;
    }

?>