<?php include("includes/header.php"); ?>


<?php 

//if(!$session->is_signed_in()) {redirect("admin/login");}
//Ako nije prazno, ovdje dobivamo zahtjeve za stranice s ključem ako je iz nekog razloga prazno, postavljamo jedan
$page = !empty($_GET['page']) ? (int)$_GET['page'] : 1;

//Ograničeni broj stranica za paginaciju
$items_per_page = 16;

//Dakle, ovo će samo prebrojati sve zapise i sve fotografije 
$items_total_count = Photo::count_all();



$paginate = new Paginate($page, $items_per_page, $items_total_count);


$sql = "SELECT * FROM photos ";
$sql .= "LIMIT {$items_per_page} ";
$sql .= "OFFSET {$paginate->offset()}";
//Pronalazimo sve fotografije ut pomoć ove metode
$photos = Photo::find_by_query($sql);



// $photos = Photo::find_all();


 ?>

<a class="navbar-brand" href="admin/admin">Visit to admin Page</a>

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-12">


     <div class="thumbnails row">

   <!--Prikazujemo fotografije na display-->
         <?php  foreach ($photos as $photo):  ?>


            <div class="col-xs-6 col-md-3">
                
            <a class="thumbnail" href="photo.php?id=<?php echo $photo->id; ?>">
                
            <img class="home_page_photo img-responsive " src="admin/<?php echo $photo->picture_path(); ?>" alt="">


            </a>


            </div>
            

   


         <?php endforeach; ?>


     </div>


     <div class="row">


        <ul class="pager">

            <?php 


            if($paginate->page_total() > 1) {

                if($paginate->has_next()) {

echo "<li class='next'><a href='index.php?page={$paginate->next()}'>Next</a></li>";


                }




                for ($i=1; $i <= $paginate->page_total(); $i++) { 


                    if($i == $paginate->current_page) {


        echo  "<li class='active'><a href='index.php?page={$i}'>{$i}</a></li>";



                    } else {

        echo  "<li><a href='index.php?page={$i}'>{$i}</a></li>";


                    }
                  
                }

         


               




        







                  if($paginate->has_previous()) {

echo "<li class='previous'><a href='index.php?page={$paginate->previous()}'>Previous</a></li>";


                }




            }


             ?>


        </ul>
         






     </div>








               
     

 </div>




            <!-- Blog Sidebar Widgets Column -->
          <!--   <div class="col-md-4">
 -->
            
                 <?php // include("includes/sidebar.php"); ?>



</div> 
        <!-- /.row -->

        <?php include("includes/footer.php"); ?>
