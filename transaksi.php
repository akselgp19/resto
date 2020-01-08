  <?php
include "config/koneksi.php";
include "fungsi.php";
if(isset($_POST['simpan'])){
  $sql = mysqli_query($con,"INSERT INTO transaksi(id_user,id_order,tanggal,total_bayar) VALUES ('$_POST[id_user]','$_POST[id_order]','$_POST[tanggal]','$_POST[total_bayar]')");

  $eksekusi = mysqli_query($con, $sql);
  echo "<script>alert('Berhasil tersimpan');document.location.href='?menu=transaksi'</script>";
}
  // ini untuk opsi delete hapus
       if(isset($_GET['delete'])){
            $sql = mysqli_query($con,"DELETE FROM transaksi WHERE id_transaksi = '$_GET[id_transaksi]'");
            if($sql){
                echo "<script>alert('data berhasil dihapus');document.location.href='?menu=transaksi'</script>";
            }
            else{
                echo "<script>alert('data gagal dihapus');document.location.href='?menu=transaksi'</script>";
            }
        }
        if(isset($_GET['edit'])){
            $sql = mysqli_query($con,"SELECT * FROM transaksi WHERE id_transaksi ='$_GET[id_transaksi]'");
            $row_edit = mysqli_fetch_array($sql);
        }else{
            $row_edit=null;
        }
         if(isset($_POST['update'])){
             $sql = mysqli_query($con,"UPDATE transaksi SET id_transaksi = '$_POST[id_transaksi]', id_user = '$_POST[id_user]',id_order = '$_POST[id_order]', tanggal = '$_POST[tanggal]', total_bayar = '$_POST[total_bayar]' WHERE id_transaksi = '$_GET[id_transaksi]'");
              if($sql){
                echo "<script>alert('data berhasil diupdate');
                document.location.href= '?menu=transaksi'</script>";
            }
            else{
                echo "<script>alert('data gagal diupdate');
                document.location.href= '?menu=transaksi'</script>";
            }
          }
?>

<script type="text/javascript">
    function ten(){
        aa=eval(form.tenor.value);

        if ( aa == 3){
            form.bunga.value = 2;
        }
        else if ( aa == 6){
            form.bunga.value = 4;
        }
         else if ( aa == 9){
            form.bunga.value = 6;
        }
         else if ( aa == 12) {
            form.bunga.value = 8;
        }
        else{
            form.bunga.value = 0;
        }

        hj=eval(form.harga.value);
        bunga=eval(form.bunga.value);
        sc = hj + (bunga/100 * hj);
        form.hargakredit.value = sc;
    }

</script>

<script type="text/javascript">
    function bagi(){
      hb= eval(form.hargakredit.value);
      dp = eval(form.dp.value);
      ten = eval(form.tenor.value);
      sc = hb - dp;
      ang = sc / ten;
      form.sisa.value = sc;
      form.angsuran.value = ang;
    }
</script>
          
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Data Transaksi</h6>
            </div>
            <div class="card-body">
            <form method="post" name="form">
            <div class="form-group">
                <div class="row">
                   <select name="id_user" class="form-control" class="form-control form-control-md" id="" onchange='changeValueNama(this.value)' >
                      <option value="" disabled="disabled" selected="selected">- pilih id user -</option>
                        <?php
                                $con = mysqli_connect("localhost", "root","", "restoran");
                                $query=mysqli_query($con, "select * from user order by id_user asc");
                                $result = mysqli_query($con, "select * from user");
                                $jsArrayNama = "var idTipe = new Array();\n";
                                while ($row = mysqli_fetch_array($result)) {
                                echo '<option name="id_user"  value="' . $row['id_user'] . '">' . $row['id_user'] . '</option>';
                                $jsArrayNama .= "idTipe['" . $row['id_user'] . "'] = 
                                {
                                id_user:'".addslashes($row['id_user'])."'};\n";
                                }
                            ?>

                    </select>

                    <select name="id_order" class="form-control" class="form-control form-control-md" id="" onchange='changeValueNamaa(this.value)' >
                      <option value="" disabled="disabled" selected="selected">- pilih id order -</option>
                        <?php
                                $con = mysqli_connect("localhost", "root","", "restoran");
                                $query=mysqli_query($con, "select * from order1 by id_order asc");
                                $result = mysqli_query($con, "select * from order1");
                                $jsArrayNamaa = "var idTipee = new Array();\n";
                                while ($row = mysqli_fetch_array($result)) {
                                echo '<option name="id_order"  value="' . $row['id_order'] . '">' . $row['id_order'] . '</option>';
                                $jsArrayNama .= "idTipee['" . $row['id_order'] . "'] = 
                                {
                                id_order:'".addslashes($row['id_order'])."'};\n";
                                }
                            ?>

                    </select>
                    
                    <input type="number" id="tanggal" name="tanggal"  value="<?php echo $row_edit['tanggal'];?>" class="form-control" placeholder="tanggal">

                    <input type="number" id="total_bayar" name="total_bayar"  value="<?php echo $row_edit['total_bayar'];?>" class="form-control" placeholder="total bayar">
                </div>
            </div>
                <?php
          if(isset ($_GET['edit'])){
            ?>
            <button type="submit" name="update" class="btn btn-primary" value="update"> Update</button>
            <td><a href="?menu=transaksi">Batal</a></td>
            <?php
          }else{
            ?>
            <td><input type="submit" name="simpan" value="simpan"></td>
            <?php
          }
        ?>
            </form>
            <br><br>
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>

                    <tr>
                      <th>id transaksi</th>
                      <th>id user</th>
                      <th>id order</th>
                      <th>tanggal</th>
                      <th>total bayar</th>
                    </tr>
                  </thead>
                  <tbody>
                   <?php
                    $sql = mysqli_query($con,"SELECT * FROM transaksi");
                    while ($row_edit = mysqli_fetch_array($sql)){
                   ?>
                    <tr>
                      <td><?php echo $row_edit['id_transaksi']?></td>
                      <td><?php echo $row_edit['id_user']?></td>
                      <td><?php echo $row_edit['id_order']?></td>
                      <td><?php echo $row_edit['tanggal']?></td>
                      <td style="text-align: center;"><?php echo format_money($row_edit['total_bayar']);?></td>
                      <td>
                        <a href="?menu=transaksi&delete&id_transaksi=<?php echo $row_edit['id_transaksi']?>"onClick="return confirm('Apakah anda yakin akan menghapus ini?')">HAPUS</a>

                        <a href="cetak.php?id_transaksi=<?php echo $row_edit['id_transaksi']?>">CETAK</a>
                      </td>
                    </tr>
                  <?php } ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
<script type="text/javascript">
        <?php echo $jsArrayNama; ?>
        function changeValueNama(id_user){
            console.log(id_user);
            console.log(idTipe);   
            document.getElementById('id_user').value = idTipe[id_user].id_user;
        }
        </script>

<script type="text/javascript">
        <?php echo $jsArrayNamaa; ?>
        function changeValueNamaa(id_order){
            console.log(id_order);
            console.log(idTipee);   
            document.getElementById('id_order').value = idTipe[id_order].id_order;
        }
        </script>
