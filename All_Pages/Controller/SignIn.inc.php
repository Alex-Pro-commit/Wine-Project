<?php
    include_once "Includes/dbconnect.inc.php";
 
    $errors=[]; //because we have multiple error messages


      //submission of password and username


    //because we have multiple error messages 
    if(isset($_POST['submit'])):

      //submission of password and username
      $email=$_POST['Name'];
      $password=$_POST['Pswd'];
       
      //Select 1 customer where email and password that might match db 

        $html_email=htmlspecialchars($email);
        $html_password=htmlspecialchars($password);
        $Slash_email=stripslashes($html_email);
        $Slash_password=stripslashes($html_password);
        $San_email=trim($Slash_email);
        $San_password=trim($Slash_password);

        //pattern
      
        $pattern = '/[a-zA-Z0-9]/';
      
        
        
        
          if(empty($email)):
          
            $errors['Name'] = 'Empty UserName!'; 
            
          endif;

          if(empty($password)){   //check if password is empty
            $errors['Pswd'] = 'Empty Password';
          
          } else if(!preg_match($pattern, $San_password)){  //check the pattern of the password
            $errors['Pswd'] = 'Invalid Password';
          
          }

          //if no errors start validating the username and password with the help of select query and comparing it to users input

          if(empty($errors)):
                 
              //Select 1 customer where email and password that might match db
        
              $query1="SELECT * FROM CUSTOMER WHERE EMAIL=? AND PASSWORD=? Limit 1";
                
              //gets result from db

              $stmt=$conn->prepare($query1);
              $stmt->bind_param("ss",$San_email,$San_password);
              $stmt->execute();
              $result=$stmt->get_result();
              
              //if failed display errors message, else make the session start of that user id

              if( $result->num_rows===0) 
              {
              $errors['Name'] = 'No matched record!';
              }
              else
              {
              $row=$result->fetch_assoc();
              session_start();            
              $_SESSION['email']= $row['email'];
              $_SESSION['id'] = $row['id'];
              
              header("Location:../All_Pages/CG.php");               
              }   
                        
                      
                    
            endif;
      
    endif; 
   
   
?>
  
