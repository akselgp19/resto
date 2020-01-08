  <?php
include "config/koneksi.php";
include "fungsi.php";
if(isset($_POST['simpan'])){
  $sql = mysqli_query($con,"INSERT INTO level(nama_level) VALUES ('$_POST[nama_level]')");
  if($sql){
      echo "<script>alert('data berhasil disimpan');document.location.href='?menu=level'</script>";
  }else{
      echo "<script>alert('data gagal disimpan');document.location.href='?menu=level'</script>";
  }
}
  // ini untuk opsi delete hapus
       if(isset($_GET['delete'])){
            $sql = mysqli_query($con,"DELETE FROM level WHERE id_level = '$_GET[id_level]'");
            if($sql){
                echo "<script>alert('data berhasil dihapus');document.location.href='?menu=level'</script>";
            }
            else{
                echo "<script>alert('data gagal dihapus');document.location.href='?menu=level'</script>";
            }
        }
        if(isset($_GET['edit'])){
            $sql = mysqli_query($con,"SELECT * FROM level WHERE id_level ='$_GET[id_level]'");
            $row_edit = mysqli_fetch_array($sql);
        }else{
            $row_edit=null;
        }
         if(isset($_POST['update'])){
             $sql = mysqli_query($con,"UPDATE level SET nama_level = '$_POST[nama_level]' WHERE id_level = '$_GET[id_level]'");
              if($sql){
                echo "<script>alert('data berhasil diupdate');
                document.location.href= '?menu=level'</script>";
            }
            else{
                echo "<script>alert('data gagal diupdate');
                document.location.href= '?menu=level'</script>";
            }
          }
?>        
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Data Level</h6>
            </div>
            <div class="card-body">
            <form method="post" name="form">
            <div class="form-group">
                <div class="row">
                  <input type="text" id=" nama_level" name="nama_level"  value="<?php echo $row_edit['nama_level'];?>" class="form-control" placeholder="nama_level">
                </div>
            </div>
                <?php
          if(isset ($_GET['edit'])){
            ?>
            <button type="submit" name="update" class="btn btn-primary" value="update"> Update</button>
            <td><a href="?menu=level">Batal</a></td>
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
                      <th>id level</th>
                      <th>nama level</th>
                    </tr>
                  </thead>
                  <tbody>
                   <?php
                    $sql = mysqli_query($con,"SELECT * FROM level");
                    while ($row_edit = mysqli_fetch_array($sql)){
                   ?>
                    <tr>
                      <td><?php echo $row_edit['id_level']?></td>
                      <td><?php echo $row_edit['nama_level']?></td>
                      <td>
                        <a href="?menu=level&delete&id_level=<?php echo $row_edit['id_level']?>"onClick="return confirm('Apakah anda yakin akan menghapus ini?')">HAPUS</a>
                      </td>
                    </tr>
                  <?php } ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
