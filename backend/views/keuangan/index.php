<?php
    $this->title = 'Laporan Keuangan';
?>

<h4> Laporan Keuangan </h4>
<div class="card card-block">
    <form action="admin-keuangan_print" method="GET">
        <select name="periode" class="select2 m-b-1" style="width:100%">
            <option value=""> - pilih - </option>
            <option value="1"> Harian  </option>
            <option value="2"> Mingguan</option>
            <option value="3"> Tahunan </option>
        </select>
        <input type="submit" value="Cetak" class="btn btn-success" />
    </form>
</div>