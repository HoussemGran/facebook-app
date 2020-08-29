    <?php

    session_start();



    $id_user = $_GET['id_user'];

    $id_img = $_GET['id_img'];

    $comment = $_GET['comment'];



    $con = mysqli_connect("localhost" , "root" ,"houssem0123" , "projet"); 

    $req = "insert into img_comment values ('' , $id_user , $id_img , '$comment')";

    $res = mysqli_query($con , $req);


      $reqfr = "select * from images where id_img =  ".$id_img;

       $resfr = mysqli_query($con , $reqfr);


      if($_GET['loc'] == 'home'){

            header("Location: home.php");    

            }

        else{       


        while($rowfr = mysqli_fetch_assoc($resfr)){


          header("Location: profileFr.php?id=".$rowfr['id_user']);

        }  

    }
