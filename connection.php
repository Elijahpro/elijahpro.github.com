<?
$firstname = $_POST['Fname'];
$lastname = $_POST['Lname'];
$Gender = $_POST['gender'];
$Age = $_POST['age'];
$Address = $_POST['address'];
$companyname =$_POST['Cname'];
$Email = $_POST['email'];
$PhoneCode =$_POST['PhoneCode'];
$Phone = $_POST['phone'];
$comment =$_POST['comment'];


if (!empty($firstname) || !empty($lastname) || !empty($Gender) || !empty($Age) || !empty($Address) || !empty($companyname) || !empty($Email)|| !empty($PhoneCode) || !empty($Phone || !empty($comment)){
  $host = "lacalhost";
  $dbUsername = "root";
  $dbPassword = "";
  $dbname = "MyHome";

//create connection_aborte
$conn =new mysqli($host,$dbUsername,$dbPassword,  $dbname);
if (mysqli_connect_error()){
 die ('Connect Error('.mysqli_connect_error().')'.mysqli_connect_error());
}else{
  $SELECT = "SELECT Email From registration Where Email = ? Limit 1";
  $INSERT = "INSERT Into registration (FIRSTNAME,LASTNAME,GENDER,AGE,ADDRESS,COMPANYNAME,EMAIL,PHONECODE,PHONENO,COMMENT) values (?,?,?,?,?,?,?,?,?,?)";
  
  //prepare statement
  $stmt = $conn->prepare(SELECT);
  $stmt->bind_param("s",$Email);
  $stmt->execute();
  $stmt->bind_result($Email);
  $stmt->store_result();
  $rnum = $stmt->num_rows;
  
   if ($rnum==0){
       $stmt->close();
	   $stmt = $conn->prepare($INSERT);
	   $stmt->bind_param("ssssil",$firstname,$lastname,$Gender,$Age,$Address,$companyname,$Email,$PhoneCode,$Phone,$comment);
	   $stmt->execute();
	   echo "NEW RECORD ISERTED SUCESSFULLY";
   }else{
      echo "SOMEONE ALREADY REGISTER USING THIS EMAIL";
   }
   $stmt->close();
   $conn->close();
}
}else{
   echo "All field are required";
   die();
}
?>