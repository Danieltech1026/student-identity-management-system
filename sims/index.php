<?php
session_start();
$conn = new mysqli("127.0.0.1", "root", "", "sims", 3307);

$message = "";

// SUCCESS MESSAGE
if(isset($_GET['msg'])){
    if($_GET['msg'] == "added") $message = "Student added successfully";
    if($_GET['msg'] == "updated") $message = "Student updated successfully";
    if($_GET['msg'] == "deleted") $message = "Student deleted successfully";
}

// DELETE
if(isset($_GET['delete'])){
    $id = $_GET['delete'];
    $conn->query("DELETE FROM students WHERE id=$id");
    header("Location: index.php?msg=deleted");
    exit();
}

// EDIT FETCH
$editData = null;
if(isset($_GET['edit'])){
    $id = $_GET['edit'];
    $res = $conn->query("SELECT * FROM students WHERE id=$id");
    $editData = $res->fetch_assoc();
}

// LOGIN
if(isset($_POST['login'])){
    $user = $_POST['username'];
    $pass = md5($_POST['password']);

    $res = $conn->query("SELECT * FROM admins WHERE username='$user' AND password='$pass'");
    if($res->num_rows > 0){
        $_SESSION['admin'] = $user;
        header("Location: index.php");
        exit();
    } else {
        $message = "Invalid login credentials";
    }
}

// LOGOUT
if(isset($_GET['logout'])){
    session_destroy();
    header("Location: index.php");
    exit();
}

// ADD / UPDATE
if(isset($_POST['add'])){
    $name = $_POST['name'];
    $matric = $_POST['matric'];
    $dept = $_POST['department'];

    // UPDATE
    if(isset($_GET['edit'])){
        $id = $_GET['edit'];

        // CHECK IF NEW IMAGE WAS UPLOADED
        if(!empty($_FILES['photo']['name'])){

            $photo = $_FILES['photo']['name'];
            $temp = $_FILES['photo']['tmp_name'];

            move_uploaded_file($temp, "uploads/".$photo);

            $conn->query("UPDATE students 
            SET name='$name',
            matric='$matric',
            department='$dept',
            photo='$photo'
            WHERE id=$id");

        } else {

            $conn->query("UPDATE students 
            SET name='$name',
            matric='$matric',
            department='$dept'
            WHERE id=$id");
        }

        header("Location: index.php?msg=updated");
        exit();

    } else {

        // ADD NEW
        $photo = $_FILES['photo']['name'];
        $temp = $_FILES['photo']['tmp_name'];

        move_uploaded_file($temp, "uploads/".$photo);

        $conn->query("INSERT INTO students (name, matric, department, photo)
        VALUES ('$name','$matric','$dept','$photo')");

        header("Location: index.php?msg=added");
        exit();
    }
}

// TOTAL COUNT
$total = $conn->query("SELECT COUNT(*) as t FROM students")->fetch_assoc()['t'];

// SEARCH
$search = "";

if(isset($_GET['search'])){
    $search = $_GET['search'];

    $result = $conn->query("SELECT * FROM students 
    WHERE name LIKE '%$search%' 
    OR matric LIKE '%$search%'");

} else {

    $result = $conn->query("SELECT * FROM students");
}
?>

<!DOCTYPE html>
<html>
<head>
<title>SIMS</title>

<style>
body{
    font-family:'Segoe UI';
    background:linear-gradient(to right, #4facfe, #00f2fe);
    margin:0;
}

.login-box{
    width:300px;
    margin:100px auto;
    background:white;
    padding:25px;
    border-radius:12px;
    box-shadow:0 5px 15px rgba(0,0,0,0.2);
    text-align:center;
}

.container{
    width:90%;
    margin:auto;
    margin-top:20px;
}

.card{
    background:white;
    padding:20px;
    border-radius:12px;
    box-shadow:0 3px 10px rgba(0,0,0,0.1);
    margin-bottom:20px;
}

input{
    padding:10px;
    margin:5px;
    border-radius:6px;
    border:1px solid #ccc;
}

button{
    padding:10px 15px;
    background:#007bff;
    color:white;
    border:none;
    border-radius:6px;
    cursor:pointer;
    transition:0.3s;
}

button:hover{
    background:#0056b3;
}

table{
    width:100%;
    border-collapse:collapse;
    margin-top:10px;
}

th{
    background:#007bff;
    color:white;
}

th, td{
    padding:12px;
}

tr:nth-child(even){
    background:#f2f2f2;
}

img{
    width:50px;
    height:50px;
    border-radius:50%;
}

.top-bar{
    display:flex;
    justify-content:space-between;
    align-items:center;
    margin-bottom:15px;
}

.message{
    padding:10px;
    background:#28a745;
    color:white;
    border-radius:6px;
    margin-bottom:10px;
    animation:fadeOut 4s forwards;
}

.error{
    background:red;
}

@keyframes fadeOut{
    0%{opacity:1;}
    80%{opacity:1;}
    100%{opacity:0; display:none;}
}

.badge{
    background:#007bff;
    color:white;
    padding:6px 12px;
    border-radius:20px;
    font-size:14px;
}

.barcode{
    width:120px;
    height:40px;
    background:repeating-linear-gradient(
        to right,
        #000,
        #000 2px,
        #fff 2px,
        #fff 4px
    );
    margin:auto;
}

a{
    text-decoration:none;
    color:#007bff;
    margin-right:5px;
}

.current-photo{
    display:block;
    margin-top:10px;
}

.current-photo img{
    width:70px;
    height:70px;
    border-radius:10px;
}
</style>
</head>

<body>

<?php if(!isset($_SESSION['admin'])){ ?>

<div class="login-box">

    <h2>SIMS Login</h2>

    <?php if($message) echo "<div class='error message'>$message</div>"; ?>

    <form method="POST">

        <input type="text" name="username" placeholder="Username" required><br>

        <input type="password" name="password" placeholder="Password" required><br>

        <button name="login">Login</button>

    </form>

</div>

<?php } else { ?>

<div class="container">

<div class="top-bar">

    <h2>Welcome, <?php echo $_SESSION['admin']; ?></h2>

    <div>
        <a href="index.php"><button>Home</button></a>
        <a href="?logout=1"><button>Logout</button></a>
    </div>

</div>

<?php if($message) echo "<div class='message'>$message</div>"; ?>

<div class="card">

<h3><?php echo isset($_GET['edit']) ? "Edit Student" : "Add Student"; ?></h3>

<form method="POST" enctype="multipart/form-data">

    <input type="text" name="name" placeholder="Name"
    value="<?php echo $editData['name'] ?? ''; ?>" required>

    <input type="text" name="matric" placeholder="Matric"
    value="<?php echo $editData['matric'] ?? ''; ?>" required>

    <input type="text" name="department" placeholder="Department"
    value="<?php echo $editData['department'] ?? ''; ?>" required>

    <input type="file" name="photo">

    <?php if(isset($_GET['edit']) && !empty($editData['photo'])){ ?>
        <div class="current-photo">
            Current Photo:<br>
            <img src="uploads/<?php echo $editData['photo']; ?>">
        </div>
    <?php } ?>

    <button name="add">
        <?php echo isset($_GET['edit']) ? "Update" : "Add"; ?>
    </button>

</form>

</div>

<div class="card">

<div style="display:flex; justify-content:space-between; align-items:center;">

    <h3>Student List</h3>

    <span class="badge">
        Total: <?php echo $total; ?>
    </span>

</div>

<form method="GET">

    <input type="text" name="search"
    placeholder="Search by name or matric"
    value="<?php echo $search; ?>">

    <button>Search</button>

</form>

<table>

<tr>
    <th>Photo</th>
    <th>Name</th>
    <th>Matric</th>
    <th>Dept</th>
    <th>Barcode</th>
    <th>Actions</th>
</tr>

<?php while($row = $result->fetch_assoc()){ ?>

<tr>

<td>

<?php if(!empty($row['photo']) && file_exists("uploads/".$row['photo'])){ ?>

<img src="uploads/<?php echo $row['photo']; ?>">

<?php } else { echo "No Image"; } ?>

</td>

<td><?php echo $row['name']; ?></td>

<td><?php echo $row['matric']; ?></td>

<td><?php echo $row['department']; ?></td>

<td>
    <div class="barcode"></div>
</td>

<td>

<a href="?edit=<?php echo $row['id']; ?>">Edit</a>

<a href="?delete=<?php echo $row['id']; ?>"
onclick="return confirm('Delete this student?')">
Delete
</a>

<a href="id.php?id=<?php echo $row['id']; ?>" target="_blank">
ID
</a>

</td>

</tr>

<?php } ?>

</table>

</div>

</div>

<?php } ?>

</body>
</html>