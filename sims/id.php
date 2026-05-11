<?php
$conn = new mysqli("127.0.0.1", "root", "", "sims", 3307);

$id = $_GET['id'];

$res = $conn->query("SELECT * FROM students WHERE id=$id");
$row = $res->fetch_assoc();
?>

<!DOCTYPE html>
<html>
<head>
<title>Student ID Card</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<style>
body{
    margin:0;
    height:100vh;
    display:flex;
    justify-content:center;
    align-items:center;
    background:#eef3f8;
    font-family:Arial, Helvetica, sans-serif;
}

.card-wrapper{
    text-align:center;
}

.id-card{
    width:850px;
    height:500px;
    background:#fff;
    border-radius:30px;
    overflow:hidden;
    position:relative;
    box-shadow:0 10px 30px rgba(0,0,0,0.2);
}

/* HEADER */
.top-title{
    position:absolute;
    top:35px;
    left:45px;
    color:#0076c9;
    font-size:58px;
    font-weight:bold;
    letter-spacing:2px;
}

/* UNIVERSITY TAG */
.uni-tag{
    position:absolute;
    top:0;
    right:55px;
    width:170px;
    height:200px;
    background:#0076c9;
    clip-path:polygon(0 0,100% 0,100% 85%,50% 100%,0 85%);
    display:flex;
    flex-direction:column;
    justify-content:center;
    align-items:center;
    color:white;
}

.logo{
    width:60px;
    height:60px;
    border:3px solid white;
    border-radius:50%;
    display:flex;
    justify-content:center;
    align-items:center;
    font-size:28px;
    font-weight:bold;
    margin-bottom:10px;
}

.uni-text{
    text-align:center;
    font-size:15px;
    font-weight:bold;
    line-height:1.4;
}

/* PHOTO */
.photo-area{
    position:absolute;
    left:55px;
    top:130px;
}

.photo-circle{
    width:280px;
    height:280px;
    border:6px solid #0076c9;
    border-radius:50%;
    overflow:hidden;
    background:#f3f3f3;
    position:relative;
    z-index:2;
}

.photo-circle img{
    width:100%;
    height:100%;
    object-fit:cover;
}

/* SHAPES */
.shape1{
    position:absolute;
    width:330px;
    height:170px;
    background:#bff5ea;
    bottom:-120px;
    left:-120px;
    transform:rotate(-20deg);
    border-radius:40px;
}

.shape2{
    position:absolute;
    width:350px;
    height:180px;
    background:#0076c9;
    bottom:-120px;
    left:120px;
    transform:rotate(-20deg);
    border-radius:40px;
}

/* INFO */
.info{
    position:absolute;
    top:160px;
    left:430px;
    width:320px;
    text-align:left;
}

.label{
    color:#005792;
    font-size:22px;
    font-weight:bold;
    margin-top:22px;
}

.value{
    font-size:20px;
    color:#111;
    font-weight:bold;
    margin-top:6px;
    border-bottom:1px solid #ccc;
    padding-bottom:10px;
}

/* QR STYLE */
.qr{
    position:absolute;
    right:45px;
    top:250px;
    width:70px;
    height:70px;
    border-radius:50%;
    border:4px solid #00b7ff;
}

.qr::after{
    content:'';
    position:absolute;
    width:70px;
    height:70px;
    border-radius:50%;
    border:4px solid #9beadf;
    top:-10px;
    left:10px;
}

/* BARCODE */
.barcode{
    width:220px;
    height:55px;
    margin-top:35px;
    background:repeating-linear-gradient(
        to right,
        #000,
        #000 2px,
        #fff 2px,
        #fff 4px
    );
}

.barcode-number{
    text-align:center;
    margin-top:8px;
    font-size:15px;
    color:#111;
    font-weight:bold;
}

/* VALID */
.valid{
    position:absolute;
    left:55px;
    bottom:55px;
    font-size:15px;
    font-weight:bold;
    color:#111;
    z-index:3;
}

.valid span{
    display:block;
    font-size:24px;
    margin-top:5px;
}

/* SIGNATURE */
.signature{
    position:absolute;
    right:120px;
    bottom:45px;
    text-align:center;
}

.signature img{
    width:150px;
}

.sign-line{
    width:220px;
    border-top:1px dashed #444;
    margin-top:5px;
}

/* PRINT BUTTON */
.print-btn{
    margin-top:20px;
}

button{
    background:#0076c9;
    color:white;
    border:none;
    padding:12px 18px;
    border-radius:8px;
    cursor:pointer;
    font-size:15px;
}

button:hover{
    background:#005b99;
}

@media print{
    .print-btn{
        display:none;
    }

    body{
        background:white;
    }
}

@media(max-width:900px){

    .id-card{
        width:95%;
        height:auto;
        padding-bottom:40px;
    }

    .top-title{
        position:static;
        text-align:center;
        font-size:35px;
        margin-top:25px;
    }

    .uni-tag{
        position:static;
        margin:20px auto;
    }

    .photo-area{
        position:static;
        margin-top:20px;
    }

    .photo-circle{
        width:220px;
        height:220px;
        margin:auto;
    }

    .info{
        position:static;
        width:90%;
        margin:30px auto;
    }

    .qr{
        display:none;
    }

    .signature{
        position:static;
        margin-top:20px;
    }

    .valid{
        position:static;
        text-align:center;
        margin-top:20px;
    }
}
</style>
</head>

<body>

<div class="card-wrapper">

<div class="id-card">

    <div class="top-title">STUDENT ID CARD</div>

    <div class="uni-tag">
        <div class="logo">BU</div>

        <div class="uni-text">
            BABCOCK<br>
            UNIVERSITY
        </div>
    </div>

    <div class="photo-area">

        <div class="photo-circle">
            <img src="uploads/<?php echo $row['photo']; ?>">
        </div>

        <div class="shape1"></div>
        <div class="shape2"></div>

    </div>

    <div class="info">

        <div class="label">NAME:</div>
        <div class="value"><?php echo strtoupper($row['name']); ?></div>

        <div class="label">MATRIC:</div>
        <div class="value"><?php echo $row['matric']; ?></div>

        <div class="label">PROGRAM:</div>
        <div class="value"><?php echo strtoupper($row['department']); ?></div>

        <div class="barcode"></div>
        <div class="barcode-number"><?php echo $row['matric']; ?></div>

    </div>

    <div class="qr"></div>

    <div class="valid">
        VALID UNTIL
        <span>DEC 2030</span>
    </div>

    

</div>

<div class="print-btn">
    <button onclick="window.print()">Download as PDF</button>
</div>

</div>

</body>
</html>