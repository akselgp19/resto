  <?php
include "config/koneksi.php";
include "fungsi.php";
if(isset($_POST['simpan'])){
  $sql = mysqli_query($con,"INSERT INTO detail_order(id_order,id_masakan,keterangan,status_detail_order) VALUES ('$_POST[id_order]','$_POST[id_masakan]','$_POST[keterangan]','$_POST[status_detail_order]')");
  if($sql){
      echo "<script>alert('data berhasil disimpan');document.location.href='?menu=detail'</script>";
  }else{
      echo "<script>alert('data gagal disimpan');document.location.href='?menu=detail'</script>";
  }
}
  // ini untuk opsi delete hapus
       if(isset($_GET['delete'])){
            $sql = mysqli_query($con,"DELETE FROM detail_order WHERE id_detail_order = '$_GET[id_detail_order]'");
            if($sql){
                echo "<script>alert('data berhasil dihapus');document.location.href='?menu=detail'</script>";
            }
            else{
                echo "<script>alert('data gagal dihapus');document.location.href='?menu=detail'</script>";
            }
        }
        if(isset($_GET['edit'])){
            $sql = mysqli_query($con,"SELECT * FROM detail_order WHERE id_detail_order ='$_GET[id_detail_order]'");
            $row_edit = mysqli_fetch_array($sql);
        }else{
            $row_edit=null;
        }
         if(isset($_POST['update'])){
             $sql = mysqli_query($con,"UPDATE detail_order SET keterangan = '$_POST[keterangan]', status_detail_order = '$_POST[status_detail_order]' WHERE id_detail_order = '$_GET[id_detail_order]'");
              if($sql){
                echo "<script>alert('data berhasil diupdate');
                document.location.href= '?menu=detail'</script>";
            }
            else{
                echo "<script>alert('data gagal diupdate');
                document.location.href= '?menu=detail'</script>";
            }
          }
?>        
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Data Detail Order</h6>
            </div>
            <div class="card-body">
            <form method="post" name="form">
            <div class="form-group">
                <div class="row">
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
                                no_meja:'".addslashes($row['no_meja'])."'};\n";
                                }
                            ?>

                    </select>

                    <select name="id_masakan" class="form-control" class="form-control form-control-md" id="" onchange='changeValueNamaa(this.value)' >
                      <option value="" disabled="disabled" selected="selected">- pilih id masakan -</option>
                        <?php
                                $con = mysqli_connect("localhost", "root","", "restoran");
                                $query=mysqli_query($con, "select * from masakan by id_masakan asc");
                                $result = mysqli_query($con, "select * from masakan");
                                $jsArrayNamaa = "var idTipee = new Array();\n";
                                while ($row = mysqli_fetch_array($result)) {
                                echo '<option name="id_masakan"  value="' . $row['id_masakan'] . '">' . $row['id_masakan'] . '</option>';
                                $jsArrayNama .= "idTipee['" . $row['id_masakan'] . "'] = 
                                {
                                :'".addslashes($row[''])."'};\n";
                                }
                            ?>

                    </select>



                   <input type="text" id="keterangan" name="keterangan"  value="<?php echo $row_edit['keterangan'];?>" class="form-control" placeholder="keterangan">
                    
                    <input type="text" id="status_detail_order" name="status_detail_order"  value="<?php echo $row_edit['status_detail_order'];?>" class="form-control" placeholder="status detail order">

                   
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
                      <th>id order</th>
                      <th>id masakan</th>
                      <th>keterangan</th>
                      <th>status detail order</th>
                    </tr>
                  </thead>
                  <tbody>
                   <?php
                    $sql = mysqli_query($con,"SELECT * FROM detail_order");
                    while ($row_edit = mysqli_fetch_array($sql)){
                   ?>
                    <tr>
                      <td><?php echo $row_edit['id_order']?></td>
                      <td><?php echo $row_edit['id_masakan']?></td>
                      <td><?php echo $row_edit['keterangan']?></td>
                      <td><?php echo $row_edit['status_detail_order']?></td>
                      <td>
                        <a href="?menu=detail&delete&id_detail_order=<?php echo $row_edit['id_detail_order']?>"onClick="return confirm('Apakah anda yakin akan menghapus ini?')">HAPUS</a>
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