<!DOCTYPE html>
<?php include './headcode.php';?>
<html lang="en">

    <body>
        <div class="container-scroller">
            <!-- Here goes the code for menu  but inside the main tag-->
            <?php include './TopMenu.php';?>
            <div class="container-fluid page-body-wrapper">
                <!-- Here goes the code for sidebar menu  but inside the container-fluid page-body-wrapper-->
                <?php include './SideMenu.php';?>
                <div class="main-panel">
                    <div class="content-wrapper">
                        <div class="row">
                            <div class="col-md-12 grid-margin">
                                <div class="row">
                                    <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                                        <h3 class="font-weight-bold">Welcome Aamir</h3>
                                        <h6 class="font-weight-normal mb-0">All systems are running smoothly! You have <span class="text-primary">3 unread alerts!</span></h6>
                                    </div>
                                    
                                    
                                </div>
                                <!-- FORM CONTENT AND TABLE -->
                                
                            </div>
                        </div>

                    </div>
                    <!-- content-wrapper ends -->
                    <!-- partial:partials/_footer.html -->
                    <?php include './footer.php';?>
                    <!-- partial -->
                </div> 
            </div>
        </div>


        
    </body>
</html>
