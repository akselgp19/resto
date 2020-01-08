  <?php
include "config/koneksi.php";
include "fungsi.php";
if(isset($_POST['simpan'])){
  $sql = mysqli_query($con,"INSERT INTO order1(no_meja,keterangan,status_order,nama_user) VALUES ('$_POST[no_meja]','$_POST[keterangan]','$_POST[status_order]','$_POST[nama_user]')");
  if($sql){
      echo "<script>alert('data berhasil disimpan');document.location.href='?menu=order'</script>";
  }else{
      echo "<script>alert('data gagal disimpan');document.location.href='?menu=order'</script>";
  }
}
  // ini untuk opsi delete hapus
       if(isset($_GET['delete'])){
            $sql = mysqli_query($con,"DELETE FROM order1 WHERE id_order = '$_GET[id_order]'");
            if($sql){
                echo "<script>alert('data berhasil dihapus');document.location.href='?menu=order'</script>";
            }
            else{
                echo "<script>alert('data gagal dihapus');document.location.href='?menu=order'</script>";
            }
        }
        if(isset($_GET['edit'])){
            $sql = mysqli_query($con,"SELECT * FROM order1 WHERE id_order ='$_GET[id_order]'");
            $row_edit = mysqli_fetch_array($sql);
        }else{
            $row_edit=null;
        }
         if(isset($_POST['update'])){
             $sql = mysqli_query($con,"UPDATE order1 SET nama_pembeli = '$_POST[nama_pembeli]',no_meja = '$_POST[no_meja]', keterangan = '$_POST[keterangan]', status_order = '$_POST[status_order]'");
              if($sql){
                echo "<script>alert('data berhasil diupdate');
                document.location.href= '?menu=order'</script>";
            }
            else{
                echo "<script>alert('data gagal diupdate');
                document.location.href= '?menu=order'</script>";
            }
          }
?>        
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Data Order</h6>
            </div>
            <div class="card-body">
            <form method="post" name="form">
            <div class="form-group">
                <div class="row">
                  
                   <input type="number" id="no_meja" name="no_meja"  value="<?php echo $row_edit['no_meja'];?>" class="form-control" placeholder="no meja">

                   <input type="number" id="tanggal" name="tanggal"  value="<?php echo $row_edit['tanggal'];?>" class="form-control" placeholder="tanggal">

                   <select name="id_user" class="form-control" class="form-control form-control-md" id="" onchange='changeValueNama(this.value)' >
                      <option value="" disabled="disabled" selected="selected">- pilih id user -</option>
                        <?php
                                $con = mysqli_connect("localhost", "root","", "restoran");
                                $query=mysqli_query($con, "select * from user by id_user asc");
                                $result = mysqli_query($con, "select * from user");
                                $jsArrayNama = "var idTipe = new Array();\n";
                                while ($row = mysqli_fetch_array($result)) {
                                echo '<option name="id_user"  value="' . $row['id_user'] . '">' . $row['id_user'] . '</option>';
                                $jsArrayNama .= "idTipe['" . $row['id_user'] . "'] = 
                                {
                                nama_user:'".addslashes($row['nama_user'])."'};\n";
                                }
                            ?>

                    </select>

                    <input type="text" id="nama_user" name="nama_user"  value="<?php echo $row_edit['nama_user'];?>" class="form-control" placeholder="nama pembeli">

                    
                    <input type="text" id="keterangan" name="keterangan"  value="<?php echo $row_edit['keterangan'];?>" class="form-control" placeholder="keterangan">

                    <input type="text" id="status_order" name="status_order"  value="<?php echo $row_edit['status_order'];?>" class="form-control" placeholder="status_order">
                </div>
            </div>
                <?php
          if(isset ($_GET['edit'])){
            ?>
            <button type="submit" name="update" class="btn btn-primary" value="update"> Update</button>
            <td><a href="?menu=order">Batal</a></td>
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
                      <th>id order</th>
                      <th>no meja</th>
                      <th>tanggal</th>
                      <th>nama pembeli</th>
                      <th>keterangan</th>
                      <th>status order</th>
                    </tr>
                  </thead>
                  <tbody>
                   <?php
                    $sql = mysqli_query($con,"SELECT * FROM order1");
                    while ($row_edit = mysqli_fetch_array($sql)){
                   ?>
                    <tr>
                      <td><?php echo $row_edit['id_order']?></td>
                      <td><?php echo $row_edit['no_meja']?></td>
                      <td><?php echo $row_edit['tanggal']?></td>
                      <td><?php echo $row_edit['nama_user']?></td>
                      <td><?php echo $row_edit['keterangan']?></td>
                      <td><?php echo $row_edit['status_order']?></td>
                      <td>
                        <a href="?menu=order&edit&id_order=<?php echo $row_edit['id_order']?>"onClick="return confirm('Apakah anda yakin akan menghapus ini?')">EDIT</a>

                        <a href="?menu=order&delete&id_order=<?php echo $row_edit['id_order']?>"onClick="return confirm('Apakah anda yakin akan menghapus ini?')">HAPUS</a>
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
            document.getElementById('nama_user').value = idTipe[id_user].nama_user;
        }
        </script>