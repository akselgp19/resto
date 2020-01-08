  <?php
include "config/koneksi.php";
include "fungsi.php";
if(isset($_POST['simpan'])){
  $sql = mysqli_query($con,"INSERT INTO user(username,password,nama_user,id_level,nama_level) VALUES ('$_POST[username]','$_POST[password]','$_POST[nama_user]','$_POST[id_level]','$_POST[nama_level]')");
  if($sql){
      echo "<script>alert('data berhasil disimpan');document.location.href='?menu=user'</script>";
  }else{
      echo "<script>alert('data gagal disimpan');document.location.href='?menu=user'</script>";
  }
}
  // ini untuk opsi delete hapus
       if(isset($_GET['delete'])){
            $sql = mysqli_query($con,"DELETE FROM user WHERE id_user = '$_GET[id_user]'");
            if($sql){
                echo "<script>alert('data berhasil dihapus');document.location.href='?menu=user'</script>";
            }
            else{
                echo "<script>alert('data gagal dihapus');document.location.href='?menu=user'</script>";
            }
        }
        if(isset($_GET['edit'])){
            $sql = mysqli_query($con,"SELECT * FROM user WHERE id_user ='$_GET[id_user]'");
            $row_edit = mysqli_fetch_array($sql);
        }else{
            $row_edit=null;
        }
         if(isset($_POST['update'])){
             $sql = mysqli_query($con,"UPDATE user SET username = '$_POST[username]', password = '$_POST[password]', nama_user = '$_POST[nama_user]', id_level = '$_POST[id_level]' WHERE id_user = '$_GET[id_user]'");
              if($sql){
                echo "<script>alert('data berhasil diupdate');
                document.location.href= '?menu=user'</script>";
            }
            else{
                echo "<script>alert('data gagal diupdate');
                document.location.href= '?menu=user'</script>";
            }
          }
?>        
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Data User</h6>
            </div>
            <div class="card-body">
            <form method="post" name="form">
            <div class="form-group">
                <div class="row">
                   <input type="text" id="username" name="username"  value="<?php echo $row_edit['username'];?>" class="form-control" placeholder="username">
                    
                    <input type="password" id="password" name="password"  value="<?php echo $row_edit['password'];?>" class="form-control" placeholder="password">

                    <input type="text" id="nama_user" name="nama_user"  value="<?php echo $row_edit['nama_user'];?>" class="form-control" placeholder="nama_user">

                    <select name="id_level" class="form-control" class="form-control form-control-md" id="" onchange='changeValueNama(this.value)' >
                      <option value="" disabled="disabled" selected="selected">- pilih id level -</option>
                        <?php
                                $con = mysqli_connect("localhost", "root","", "restoran");
                                $query=mysqli_query($con, "select * from level by id_level asc");
                                $result = mysqli_query($con, "select * from level");
                                $jsArrayNama = "var idTipe = new Array();\n";
                                while ($row = mysqli_fetch_array($result)) {
                                echo '<option name="id_level"  value="' . $row['id_level'] . '">' . $row['id_level'] . '</option>';
                                $jsArrayNama .= "idTipe['" . $row['id_level'] . "'] = 
                                {
                                nama_level:'".addslashes($row['nama_level'])."'};\n";
                                }
                            ?>

                    </select>

                    <input type="text" id="nama_level" name="nama_level"  value="<?php echo $row_edit['nama_level'];?>" class="form-control" placeholder="nama_level">
                </div>
            </div>
                <?php
          if(isset ($_GET['edit'])){
            ?>
            <button type="submit" name="update" class="btn btn-primary" value="update"> Update</button>
            <td><a href="?menu=user">Batal</a></td>
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
                      <th>id user</th>
                      <th>username</th>
                      <th>password</th>
                      <th>nama user</th>
                      <th>nama level</th>
                    </tr>
                  </thead>
                  <tbody>
                   <?php
                    $sql = mysqli_query($con,"SELECT * FROM user");
                    while ($row_edit = mysqli_fetch_array($sql)){
                   ?>
                    <tr>
                      <td><?php echo $row_edit['id_user']?></td>
                      <td><?php echo $row_edit['username']?></td>
                      <td><?php echo $row_edit['password']?></td>
                      <td><?php echo $row_edit['nama_user']?></td>
                      <td><?php echo $row_edit['nama_level']?></td>
                      <td>
                        <a href="?menu=user&delete&id_user=<?php echo $row_edit['id_user']?>"onClick="return confirm('Apakah anda yakin akan menghapus ini?')">HAPUS</a>
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
        function changeValueNama(id_level){
            console.log(id_level);
            console.log(idTipe);   
            document.getElementById('nama_level').value = idTipe[id_level].nama_level;
        }
        </script>