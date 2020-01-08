  <?php
include "config/koneksi.php";
include "fungsi.php";
if(isset($_POST['simpan'])){
  $sql = mysqli_query($con,"INSERT INTO masakan(nama_masakan,harga,status_masakan) VALUES ('$_POST[nama_masakan]','$_POST[harga]','$_POST[status_masakan]')");
  if($sql){
      echo "<script>alert('data berhasil disimpan');document.location.href='?menu=masakan'</script>";
  }else{
      echo "<script>alert('data gagal disimpan');document.location.href='?menu=masakan'</script>";
  }
}
  // ini untuk opsi delete hapus
       if(isset($_GET['delete'])){
            $sql = mysqli_query($con,"DELETE FROM masakan WHERE id_masakan = '$_GET[id_masakan]'");
            if($sql){
                echo "<script>alert('data berhasil dihapus');document.location.href='?menu=masakan'</script>";
            }
            else{
                echo "<script>alert('data gagal dihapus');document.location.href='?menu=masakan'</script>";
            }
        }
        if(isset($_GET['edit'])){
            $sql = mysqli_query($con,"SELECT * FROM masakan WHERE id_masakan ='$_GET[id_masakan]'");
            $row_edit = mysqli_fetch_array($sql);
        }else{
            $row_edit=null;
        }
         if(isset($_POST['update'])){
             $sql = mysqli_query($con,"UPDATE masakan SET nama_masakan = '$_POST[nama_masakan]', harga = '$_POST[harga]',status_masakan = '$_POST[status_masakan]' WHERE id_masakan = '$_GET[id_masakan]'");
              if($sql){
                echo "<script>alert('data berhasil diupdate');
                document.location.href= '?menu=masakan'</script>";
            }
            else{
                echo "<script>alert('data gagal diupdate');
                document.location.href= '?menu=masakan'</script>";
            }
          }
?>


          
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Data Transaksi</h6>
            </div>
            <div class="card-body">
            <form method="post" name="form">
            <div class="form-group">
                <div class="row">
                  
                    
                    <input type="text" id="nama_masakan" name="nama_masakan"  value="<?php echo $row_edit['nama_masakan'];?>" class="form-control" placeholder="nama masakan">

                    <input type="number" id="harga" name="harga"  value="<?php echo $row_edit['harga'];?>" class="form-control" placeholder="harga">

                    <input type="text" id="status_masakan" name="status_masakan"  value="<?php echo $row_edit['status_masakan'];?>" class="form-control" placeholder="status_masakan">
                </div>
            </div>
                <?php
          if(isset ($_GET['edit'])){
            ?>
            <button type="submit" name="update" class="btn btn-primary" value="update"> Update</button>
            <td><a href="?menu=masakan">Batal</a></td>
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
                      <th>id masakan</th>
                      <th>nama masakan</th>
                      <th>harga</th>
                      <th>status masakan</th>
                    </tr>
                  </thead>
                  <tbody>
                   <?php
                    $sql = mysqli_query($con,"SELECT * FROM masakan");
                    while ($row_edit = mysqli_fetch_array($sql)){
                   ?>
                    <tr>
                      <td><?php echo $row_edit['id_masakan']?></td>
                      <td><?php echo $row_edit['nama_masakan']?></td>
                      <td><?php echo $row_edit['harga']?></td>
                      <td><?php echo $row_edit['status_masakan']?></td>
                      <td>
                        <a href="?menu=masakan&delete&id_masakan=<?php echo $row_edit['id_masakan']?>"onClick="return confirm('Apakah anda yakin akan menghapus ini?')">HAPUS</a>
                      </td>
                    </tr>
                  <?php } ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>

