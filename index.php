<?php
Include('include-global.php');
$pagename = "Home";
$title = "$pagename - $basetitle";
Include('include-header.php');
?>
    <div id="home-slider" class="carousel slide carousel-fade" data-ride="carousel">
      <div class="carousel-inner">

<?php 
$i = 0;

$ddaa = $db->query("SELECT id, img, btxt, stxt FROM slider_home ORDER BY id ");
while ($data = $ddaa->fetch()){
if ($i==0) {
$cls = "active";
}else{
$cls = "";
}
?>

        <div class="item <?php echo $cls; ?>" style="background-image: url(<?php echo "$fronturl/assets/images/slider/$data[1]"; ?>)">
          <div class="caption">
            <h1 class="animated fadeInLeftBig"><?php echo $data[2]; ?></h1>
            <p class="animated fadeInRightBig"><?php echo $data[3]; ?></p>
            <a data-scroll class="btn btn-start animated fadeInUpBig" href="<?php echo $baseurl; ?>">Sign In</a>
            <a data-scroll class="btn btn-reg animated fadeInUpBig" href="<?php echo $baseurl; ?>/Register">Register now</a>
          </div>
        </div>

<?php 
$i++;
}
?>


      </div>
      <a class="left-control" href="#home-slider" data-slide="prev"><i class="fa fa-angle-left"></i></a>
      <a class="right-control" href="#home-slider" data-slide="next"><i class="fa fa-angle-right"></i></a>


    </div><!--/#home-slider-->
   
  </header><!--/#home-->


<?php 
$txt = $db->query("SELECT heading, btxt FROM home_text WHERE id='1'")->fetch();
?>

  <section>
    <div class="container">
      <div class="heading wow fadeInUp" data-wow-duration="1000ms" data-wow-delay="300ms">
        <div class="row">
          <div class="text-center col-sm-12">
            <h2 class="uppercase bold bottom-line"><?php echo $txt[0] ?></h2>
            <p><?php echo $txt[1] ?></p>
          </div>
        </div> 
      </div>
    </div>
  </section>

<?php 
$txt = $db->query("SELECT heading, btxt FROM home_text WHERE id='2'")->fetch();
?>

  <section class="parallax services">
    <div class="container">
      <div class="text-center our-services">
        <div class="row">

         <div class="text-center col-sm-12" style="margin-bottom: 40px;">
            <h2 class="uppercase bold bottom-line"><?php echo $txt[0] ?></h2>
            <p style="color:#fff;"><?php echo $txt[1] ?></p>
        </div>
</div>




        <div class="row">


<?php
$ddaa =$db->query("SELECT id, icon, btxt, stxt FROM service ORDER BY id");
while ($data = $ddaa->fetch()){
?>

    <div class="col-sm-4 wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="300ms">
            <div class="service-icon">
              <i class="fa fa-<?php echo $data[1] ?>"></i>
            </div>
            <div class="service-info">
              <h3><?php echo $data[2] ?></h3>
              <p><?php echo $data[3] ?></p>
            </div>
          </div>
<?php 
}
 ?>


        </div>



      </div>
    </div>
  </section><!--/#services-->

<?php 
$txt = $db->query("SELECT heading, btxt FROM home_text WHERE id='3'")->fetch();
?>
  <section>
    <div class="container">
      <div class="heading wow fadeInUp" data-wow-duration="1000ms" data-wow-delay="300ms">
        <div class="row">
          <div class="text-center col-sm-12">
            <h2 class="uppercase bold bottom-line"><?php echo $txt[0] ?></h2>
            <p><?php echo $txt[1] ?></p>
          </div>
        </div> 
      </div>
    </div>
  </section>





  <section  class="dark features">
    <div class="container">
      <div class="row count">

<?php 
$ddaa = $db->query("SELECT icon, btxt, stxt FROM stats ORDER BY id");
while ($data = $ddaa->fetch()){
?>


        <div class="col-sm-3 col-xs-6 wow fadeInLeft" data-wow-duration="1000ms" data-wow-delay="300ms">
          <i class="fa fa-<?php echo $data[0];?>"></i>                    
          <h3><?php echo $data[1];?></h3>
          <p><?php echo $data[2];?></p>
        </div> 

<?php 
}
?>


      </div>
    </div>
  </section><!--/#features-->

  




  <section class="payment">
    <div class="container">

        <div class="row">
          <div class="text-center col-sm-12">
            <h2 class="uppercase bold bottom-line"> Processing payments from</h2>

          <div class="about-info wow fadeInRight" data-wow-duration="1000ms" data-wow-delay="300ms">

<?php 
$ddaa = $db->query("SELECT id, img FROM payment_image ORDER BY id");
while ($data = $ddaa->fetch()){
?>
<img src="<?php echo "$fronturl/assets/images/processing/$data[1]"; ?>" alt="image">
<?php 
}
?>

          </div>
        </div>
      </div>

    </div>
  </section><!--/#PAYMENTS-->






<?php 
include('include-footer.php');
?>
</body>
</html>