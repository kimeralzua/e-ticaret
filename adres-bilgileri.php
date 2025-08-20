<?php
require_once 'header.php';


if (!isset($_SESSION['userkullanici_mail'])) {
    header("Location:404.php?durum=exit");
}
?>
            
            <!-- Main Banner 1 Area End Here --> 
            <!-- Inner Page Banner Area Start Here -->
            <div class="pagination-area bg-secondary">
                <div class="container">
                    <div class="pagination-wrapper">
                       
                    </div>
                </div>  
            </div> 
            <!-- Inner Page Banner Area End Here -->          
            <!-- Settings Page Start Here -->
            <div class="settings-page-area bg-secondary section-space-bottom">
                <div class="container">
                    <div class="row settings-wrapper">
                        <?php
                        require_once 'hesap-sidebar.php';
                        ?>
                        <div class="col-lg-9 col-md-9 col-sm-8 col-xs-12"> 

                        <?php 

if ($_GET['durum']=="hata") {?>

<div class="alert alert-danger">
    <strong>Hata!</strong> İşlem Başarısız.
</div>
    

    
<?php } else if ($_GET['durum']=="ok") {?>

        <div class="alert alert-success">
        <strong>Başarılı!</strong> Kayıt Başarılı.
</div>
<?php }
 ?>


                            <form action="nedmin/netting/kullanici.php" method="POST" class="form-horizontal" id="personal-info-form">
                                <div class="settings-details tab-content">
                                    <div class="tab-pane fade active in" id="Personal">
                                        <h2 class="title-section">Adres Bilgilerimi Düzenle</h2>
                                        <div class="personal-info inner-page-padding"> 
                                        <div class="form-group">
                                                <label class="col-sm-3 control-label">Tür Seçim</label>
                                                <div class="col-sm-9">
                                                    <div class="custom-select">
                                                        <select name="kullanici_tip" id="kullanici_tip" class='select2'>
                                                            <option 
                                                            <?php
                                                                if ($kullanicicek['kullanici_tip']=="PERSONAL") {
                                                                    echo "selected";
                                                                }
                                                            ?>
                                                            value="PERSONAL">Bireysel</option>
                                                            <option
                                                            <?php
                                                                if ($kullanicicek['kullanici_tip']=="PRIVATE_COMPANY") {
                                                                    echo "selected";
                                                                }
                                                            ?>
                                                            value="PRIVATE_COMPANY">Kurumsal</option>
                                                            
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div id="tc">
                                                <div class="form-group">
                                                    <label class="col-sm-3 control-label">TC Kimlik No</label>
                                                    <div class="col-sm-9">
                                                        <input name="kullanici_tc" value="<?php echo $kullanicicek['kullanici_tc'] ?>" class="form-control" id="first-name" type="text">
                                                    </div>
                                            </div>

                                            </div>
                                        <div id="kurumsal">
                                            <div class="form-group">
                                                <label class="col-sm-3 control-label">Firma Ünvan</label>
                                                <div class="col-sm-9">
                                                    <input name="kullanici_unvan" value="<?php echo $kullanicicek['kullanici_unvan'] ?>" class="form-control" id="first-name" type="text">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-sm-3 control-label">Firma Vergi Dairesi</label>
                                                <div class="col-sm-9">
                                                    <input name="kullanici_vdaire" value="<?php echo $kullanicicek['kullanici_vdaire'] ?>" class="form-control" id="first-name" type="text">
                                                </div>
                                            </div>
                                           
                                            <div class="form-group">
                                                <label class="col-sm-3 control-label">Firma Vergi No</label>
                                                <div class="col-sm-9">
                                                    <input  name="kullanici_vno" value="<?php echo $kullanicicek['kullanici_vno'] ?>" class="form-control" id="first-name" type="text">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                                <label class="col-sm-3 control-label">Adres</label>
                                                <div class="col-sm-9">
                                                    <input required="" name="kullanici_adres" value="<?php echo $kullanicicek['kullanici_adres'] ?>" class="form-control" id="first-name" type="text">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-3 control-label">İl</label>
                                                <div class="col-sm-9">
                                                    <input required="" name="kullanici_il" value="<?php echo $kullanicicek['kullanici_il'] ?>" class="form-control" id="first-name" type="text">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-sm-3 control-label">İlçe</label>
                                                <div class="col-sm-9">
                                                    <input required="" name="kullanici_ilce" value="<?php echo $kullanicicek['kullanici_ilce'] ?>" class="form-control" id="first-name" type="text">
                                                </div>
                                            </div>

                                           
                                           
                                            <div class="form-group">
                                                
                                                <div align="right" class="col-sm-12">
                                                    
                                                    <button name="musteriadresguncelle" class="update-btn" id="login-update">Bilgileri Güncelle</button>
                                                </div>
                                            </div>                                        
                                        </div> 
                                    </div> 
                                   
                                    
                                    
                                               
                                </div> 

                            </form> 
                        </div>  
                    </div>  
                </div>  
            </div> 

            <?php
require_once 'footer.php';
?>
<script type="text/javascript">
$(document).ready(function(){
    $("#kullanici_tip").change(function(){
        var tip = $("#kullanici_tip").val();
        if (tip=="PERSONAL") {
            $("#kurumsal").hide();
            $("#tc").show();
        } else if (tip=="PRIVATE_COMPANY") {
            $("#kurumsal").show();
            $("#tc").hide();
        }
    }).change();
})

</script>