<!DOCTYPE html>
<?php
session_start();
if(!isset($_SESSION["session_username"])){
    header("Location:login.php");
}
else{

include './headcode.php';?>
<html lang="en">
<?php
//debemos revisar si los input tienen informacion
//isset(what we check)-?-if true-:-if false;


$txtID = (isset($_POST['txtID']))?$_POST['txtID']:""; //['nombre/id de su input en el formulario']
$txtName = (isset($_POST['txtName']))?$_POST['txtName']:"";
$txtDescription = (isset($_POST['txtDescription']))?$_POST['txtDescription']:"";
$txtCategory = (isset($_POST['txtCategory']))?$_POST['txtCategory']:"";
$txtPrice = (isset($_POST['txtPrice']))?$_POST['txtPrice']:"";

$txtImage = (isset($_FILES['txtImage']['name']))?$_FILES['txtImage']['name']:"";//aqui se usa $_FILES
$accion = (isset($_POST['accion']))?$_POST['accion']:"";
var_dump($txtName);
var_dump($txtDescription);
var_dump($txtImage);
var_dump($txtPrice);
var_dump($txtCategory);
$txtCategory2="";
var_dump($txtCategory2);
switch ($accion) {
	case 'add':
	$sentenciaSQL = $pdo->prepare("INSERT INTO Product (ProductName, CategoryID , ProductDescription, 
    `Price`, `UserID`, `ProductImage`) VALUES (:productname, :categoryID, :productDescripcion, 
    :price, 1, :ProductImage);"); 
    //get curret datetime to 
    $date = new DateTime();
    $ImgFileName =($txtImage!="")?$date->getTimestamp()."_".$_FILES["txtImage"]["name"]:"image.jpg";
    $ImgTmp=$_FILES["txtImage"]["tmp_name"];
    if($ImgTmp!=""){
        move_uploaded_file($ImgTmp, "../img/productImg.jpg".$ImgFileName);
    }
    
	$sentenciaSQL->bindParam(':productname', $txtName);
    $sentenciaSQL->bindParam(':categoryID', $txtCategory);
	$sentenciaSQL->bindParam(':productDescripcion', $txtDescription);
    $sentenciaSQL->bindParam(':price', $txtPrice);
	$sentenciaSQL->bindParam(':ProductImage', $txtImage);
	$sentenciaSQL->execute();
    	// code...
	    echo "Click on add";
	break;
	
	case 'Cancel':
		// code...
	    echo "Click on Cancelar";
		break;
    case 'Modify':
        // code...
     
        header("Location: ./edit.php?eid=".$txtID);
        //header("Location: ./edit.php");
    

        
        break;
  
    case 'Delete':
        $sentenciaSQL = $pdo->prepare("DELETE FROM Product WHERE productID=:id");
        $sentenciaSQL->bindParam(':id', $txtID);
        $sentenciaSQL->execute();
        $product=$sentenciaSQL->fetch(PDO::FETCH_LAZY);

        if(isset($product[""]))
        break;
	default:
		// code...
        echo "Invalid option";
		break;
}
?>
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
                                <div class="row">
                                    <div class="col-md-12">
                                            <br/>
                                        <div class="card">
                                            <div class="card-header">
                                                Product data
                                            </div>
                                            <div class="card-body">
                                                <form method="POST" enctype="multipart/form-data">  <!--change method to POST, we use enctype to allow file submission-->
                                                    <div class="form-group">
                                
                                                        <label for="txtName">Name</label>
                                                        <input type="text" name="txtName" id="txtName" value="<?php echo $txtName; ?>" class="form-control single-input" placeholder="Name">
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="txtPrice">Price</label>
                                                        <input type="text" name="txtPrice" id="txtPrice" value="<?php echo $txtPrice; ?>" class="form-control progress-table-wrap" placeholder="Product price">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="txtDescription">Description</label>
                                                        <input type="text" name="txtDescription" value="<?php echo $txtDescription; ?>" id="txtDescription" class="form-control progress-table-wrap" 
                                                        placeholder="Product description">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="txtCategory">Categories</label>
                                                        <?php echo $txtCategory; ?>
                                                        <select class="form-control" name="txtCategory"  id="txtCategory">       
                                                        <option value="00">-- Seleccione --</option>
                                                        <?php $sentenciaCategories = $pdo->prepare("SELECT * from Category;");
                                                            $sentenciaCategories->execute();
                                                            $ListCategories=$sentenciaCategories->fetchAll();
                                                        foreach ($ListCategories as $category) { 
                                                        echo '<option value="'.$category['CategoryID'].'">'.$category['NameCategory'].'</option>';
                                                        }?>
                        
                                                    </select>
                                                
                                            </div>

                                                    <div class="form-group">
                                                        <label for="txtImage"></label>
                                                        <?php echo $txtImage; ?>
                                                        <input type="file" name="txtImage" id="txtImage" class="form-control" placeholder="Image">
                                                    </div>
                                                
                                                    <div class="btn-group" role="group">		
                                                        <button type="submit" name="accion" value="add" class="btn btn-primary">Add</button> <!--value must match
                                                        with switch-->
                                                    
                                                        <button type="submit" name="accion" value="Cancel" class="">Cancel</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
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
<?php
}
?>