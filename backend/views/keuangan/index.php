<?php
    $this->title = 'Laporan Keuangan';
?>

<h4> Laporan Keuangan </h4>
<div class="card card-block">
    <form action="admin-keuangan_print" method="GET">
        <select name="periode" class="select2 m-b-1" style="width:100%">
            <option value=""> - pilih - </option>
            <option value="1"> Harian  </option>
            <option value="2"> Bulanan</option>
            <option value="3"> Tahunan </option>
        </select>
        <button class="btn" name ="type" type="submit" value="pdf"><i class="fa fa-file-pdf-o fa-2x"></i></button>        
        <button class="btn" name ="type" type="submit" value="excel"><i class="fa fa-file-excel-o fa-2x"></i></button>        
    </form>
</div>