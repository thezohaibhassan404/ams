<?php 
include 'admin/db_connect.php'; 
?>
<style>
#portfolio .img-fluid{
    width: calc(100%);
    height: 30vh;
    z-index: -1;
    position: relative;
    padding: 1em;
}
.event-list{
cursor: pointer;
}
span.hightlight{
    background: yellow;
}
.banner{
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 26vh;
        width: calc(30%);
    }
    .banner img{
        width: calc(100%);
        height: calc(100%);
        cursor :pointer;
    }
.event-list{
cursor: pointer;
border: unset;
flex-direction: inherit;
}

.event-list .banner {
    width: calc(40%)
}
.event-list .card-body {
    width: calc(60%)
}
.event-list .banner img {
    border-top-left-radius: 5px;
    border-bottom-left-radius: 5px;
    min-height: 50vh;
}
span.hightlight{
    background: yellow;
}
.banner{
   min-height: calc(100%)
}
</style>
        <!-- <header class="masthead">
            <div class="container-fluid h-10">
                <div class="row h-100 align-items-center justify-content-center text-center">
                    <div class="col-lg-8 align-self-end mb-4 page-title">
                    	<h3 class="text-white">Welcome to <?php echo $_SESSION['system']['name']; ?></h3>
                        <hr class="divider my-4" />

                    <div class="col-md-12 mb-2 justify-content-center">
                    </div>                        
                    </div>
                    
                </div>
            </div>
        </header> -->


        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
  <ol class="carousel-indicators">
    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
  </ol>
  <div class="carousel-inner">
    <!-- <div class="carousel-item active">
      <img class="d-block w-100" height="700" src="assets/img/18.jpg" alt="First slide">
    </div> -->
    <div class="carousel-item-active">
      <img class="d-block w-100" height="700" src="assets/img/23.jpg" alt="Second slide">
    </div>
    <div class="carousel-item">
      <img class="d-block w-100" height="700" src="assets/img/26.jpg" alt="Third slide">
    </div>
  </div>
  <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>
      
            <div class="container p-5 my-5 bg-dark text-white"  id="welcome message">
                <div class="row">
                    <div class="col">
                        <h2>Welcome Message</h2>
                        <p>Learning is a process that never stops in one's life, and it starts from childhood. TheToday, technology has grown rapidly and changes various aspects of life. When used wisely, technology can support learning. One form of technology is mobile gadgets. One example of the operating system that is currently widely used is Android. Android has grown rapidly in comparison to other operating systems. This is because Android has advantages, which is open source, free, and provide many tools to build software that allows opportunities for application development.
 </p>
                    </div>

                       

                    </div>
                    <div class="col">
                        <h2>Important Links</a></h2>
                        <li><a href="www.coursera.org">Coursera</a></li>
                        <li><a href="www.edx.org">edX</a></li>
                        <li><a href="www.odesk.com">oDesk</a></li>
                        <li><a href="www.elance.com">Elance</a></li>
                        <li><a href="www.fiverr.com">Fiverr</a></li>
                        <li><a href="www.upwork.com">Upwork</a></li>
                        <li><a href="www.udemy.com">Udemy</a></li>
                        <li><a href="www.udacity.com">Udacity</a></li>
                    </div>
                    
                    
                </div>
                <div class="row">
                    <div class="col">
                      
                        
                    </div>
                    
                    
                </div>

            </div>
            <div class="container mt-3 pt-2">
                <h4 class="text-center text-white">Upcoming Events</h4>
                <hr class="divider">
                <?php
                $event = $conn->query("SELECT * FROM events where date_format(schedule,'%Y-%m%-d') >= '".date('Y-m-d')."' order by unix_timestamp(schedule) asc");
                while($row = $event->fetch_assoc()):
                    $trans = get_html_translation_table(HTML_ENTITIES,ENT_QUOTES);
                    unset($trans["\""], $trans["<"], $trans[">"], $trans["<h2"]);
                    $desc = strtr(html_entity_decode($row['content']),$trans);
                    $desc=str_replace(array("<li>","</li>"), array("",","), $desc);
                ?>
                <div class="card event-list" data-id="<?php echo $row['id'] ?>">
                     <div class='banner'>
                        <?php if(!empty($row['banner'])): ?>
                            <img src="admin/assets/uploads/<?php echo($row['banner']) ?>" alt="">
                        <?php endif; ?>
                    </div>
                    <div class="card-body">
                        <div class="row  align-items-center justify-content-center text-center h-100">
                            <div class="">
                                <h3><b class="filter-txt"><?php echo ucwords($row['title']) ?></b></h3>
                                <div><small><p><b><i class="fa fa-calendar"></i> <?php echo date("F d, Y h:i A",strtotime($row['schedule'])) ?></b></p></small></div>
                                <hr>
                                <larger class="truncate filter-txt"><?php echo strip_tags($desc) ?></larger>
                                <br>
                                <hr class="divider"  style="max-width: calc(80%)">
                                <button class="btn btn-primary float-right read_more" data-id="<?php echo $row['id'] ?>">Read More</button>
                            </div>
                        </div>
                        

                    </div>
                </div>
                <br>
                <?php endwhile; ?>
                
            </div>
            
            </div>
  <div class="test-form">

<script>
     $('.read_more').click(function(){
         location.href = "index.php?page=view_event&id="+$(this).attr('data-id')
     })
     $('.banner img').click(function(){
        viewer_modal($(this).attr('src'))
    })
    $('#filter').keyup(function(e){
        var filter = $(this).val()

        $('.card.event-list .filter-txt').each(function(){
            var txto = $(this).html();
            txt = txto
            if((txt.toLowerCase()).includes((filter.toLowerCase())) == true){
                $(this).closest('.card').toggle(true)
            }else{
                $(this).closest('.card').toggle(false)
               
            }
        })
    })
</script>