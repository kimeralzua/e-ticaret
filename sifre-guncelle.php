

            
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
        <strong>Başarılı!</strong> İşlem Başarılı.
</div>
<?php }

else if ($_GET['durum']=="eskisifrehata") {?>

    <div class="alert alert-danger">
    <strong>Hata!</strong> Girilen eski parola hatalı.
</div>
<?php }
else if ($_GET['durum']=="sifreleruyusmadi") {?>

    <div class="alert alert-danger">
    <strong>Hata!</strong> Girilen yeni parolalar uyuşmuyor.
</div>
<?php }
else if ($_GET['durum']=="eksiksifre") {?>

    <div class="alert alert-danger">
    <strong>Hata!</strong> Girilen parolalar en az 6 karakterden oluşmalıdır.
</div>
<?php }
 ?>


                            <form action="nedmin/netting/kullanici.php" method="POST" class="form-horizontal" id="personal-info-form">
                                <div class="settings-details tab-content">
                                    <div class="tab-pane fade active in" id="Personal">
                                        <h2 class="title-section">Parola Güncelleme İşlemleri</h2>
                                        <div class="personal-info inner-page-padding"> 

                                       

                                            <div class="form-group">
                                                <label class="col-sm-3 control-label">Eski Parola</label>
                                                <div class="col-sm-9">
                                                    <input name="kullanici_eskipassword"  class="form-control" id="first-name" type="text">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-sm-3 control-label">Yeni Parola</label>
                                                <div class="col-sm-9">
                                                    <input name="kullanici_passwordone"  class="form-control" id="first-name" type="text">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-sm-3 control-label">Yeni Parola (Tekrar)</label>
                                                <div class="col-sm-9">
                                                    <input name="kullanici_passwordtwo"  class="form-control" id="first-name" type="text">
                                                </div>
                                            </div>

                                          
                                            
                                            

                                           
                                           
                                            <div class="form-group">
                                                
                                                <div align="right" class="col-sm-12">
                                                    
                                                    <button name="musterisifreguncelle" class="update-btn" id="login-update">Bilgileri Güncelle</button>
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