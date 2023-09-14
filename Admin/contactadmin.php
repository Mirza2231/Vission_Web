<?php

@include 'config.php';



if(isset($_GET['delete'])){
   $delete_id = $_GET['delete'];
   $delete_query = mysqli_query($conn, "DELETE FROM `contact` WHERE id = $delete_id ") or die('query failed');
   if($delete_query){
      // header('location:lipadmin.php');
      $message[] = 'product has been deleted';
   }else{
      // header('location:lipadmin.php');
      $message[] = 'product could not be deleted';
   };
};


?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>admin panel</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- Css Styles -->
   <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
   <link rel="stylesheet" href="css/font-awesome.min.css" type="text/css">
   <link rel="stylesheet" href="css/elegant-icons.css" type="text/css">
   <link rel="stylesheet" href="css/jquery-ui.min.css" type="text/css">
   <link rel="stylesheet" href="css/magnific-popup.css" type="text/css">
   <link rel="stylesheet" href="css/owl.carousel.min.css" type="text/css">
   <link rel="stylesheet" href="css/slicknav.min.css" type="text/css">
   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/lipadmin.css">

</head>
<body>
   
<?php


if(isset($message)){
   foreach($message as $message){
      echo '<div class="message" id="close-alert"><span>'.$message.'</span> <i class="fas fa-times" onclick="this.parentElement.style.display = `none`;"></i> </div>';
   };
};
//  forEach((name) => { setTimeout(() => { display(name); }, 1000); })
?>

<?php include 'adminheader.php'; ?>

<div class="container">



<section class="display-product-table">
<h3>Conatcts</h3>
   <table>

      <thead>
         <th>Name</th>
         <th>Email</th>
         <th>Message</th>
         <th>Action</th>
      </thead>

      <tbody>
         <?php
         
            $select_contact = mysqli_query($conn, "SELECT * FROM `contact`");
            if(mysqli_num_rows($select_contact) > 0){
               while($row = mysqli_fetch_assoc($select_contact)){
         ?>

         <tr>
            <td><?php echo $row['name']; ?></td>
            <td><?php echo $row['email']; ?></td>
            <td><?php echo $row['message']; ?></td>
            <td>
               <a href="contactadmin.php?delete=<?php echo $row['id']; ?>" class="delete-btn" onclick="return confirm('are your sure you want to delete this?');"> <i class="fas fa-trash"></i> delete </a>
            </td>
         </tr>

         <?php
            };    
            }else{
               echo "<div class='empty'>no product added</div>";
            };
         ?>
      </tbody>
   </table>

</section>

</div>















<!-- custom js file link  -->
<script src="js/cus.js"></script>
<!-- Js Plugins -->
<script src="js/jquery-3.3.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery.magnific-popup.min.js"></script>
<script src="js/jquery-ui.min.js"></script>
<script src="js/mixitup.min.js"></script>
<script src="js/jquery.countdown.min.js"></script>
<script src="js/jquery.slicknav.js"></script>
<script src="js/owl.carousel.min.js"></script>
<script src="js/jquery.nicescroll.min.js"></script>
<script src="js/main.js"></script>

</body>
</html>