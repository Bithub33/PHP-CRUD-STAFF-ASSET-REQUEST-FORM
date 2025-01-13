<?php
session_start();
header("Cache-Control: no-store,no-cache, must-revalidate, max-age=0");
header("Pragma: no-cache");
header("Expires: 0");
//include "create.php";
if(isset($_SESSION['userid']) && isset($_SESSION['username'])
&& isset($_SESSION['name'])&& isset($_SESSION['role'])) {

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="layout.css">
    <link rel="stylesheet" href="css/all.min.css"/>
    <link rel="stylesheet" href="css/fontawesome.min.css">
    <link rel="icon" href="favicon.png" type="image/png">
    <script>
        window.onload = function(){
            if(!<?php echo isset($_SESSION['userid']) ? 'true' : 'false';?>)
            {
                window.location.href = "index.php";
            }
        };
    </script>
    
</head>
<body>
<nav class="navbar">

    <!-- <div class="icon">
        <i class="icons fa-solid fa-bars" id="icons"></i>
    </div> -->
   
    <div class="tit">
        <h4>Melcom</h4>
    </div>
</nav>
<div class="lay">

    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <!--li class="nav-item" role="presentation">
            <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home-tab-pane" type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true">Employee Request</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile-tab-pane" type="button" role="tab" aria-controls="profile-tab-pane" aria-selected="false">Onboarding</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact-tab-pane" type="button" role="tab" aria-controls="contact-tab-pane" aria-selected="false">Asset</button>
        </li-->
                
    </ul>

    <div class="layout active">

        <div class="main">
            <div class="side_nav collapsed" id="side_bar">
                
                <?php
                if($_SESSION['role'] === 'STAFF')
                {
                    ?>
                    <a class='pp' href='#'><i class='fa-solid fa-table'></i><h4 class='sec'>Requests</h4></a>
                    <?php
                }
                if($_SESSION['role'] === 'ERP' || $_SESSION['role'] === 'EMAIL' || $_SESSION['role'] === 'BIOMETRIC' || $_SESSION['role'] === 'INTERNET' || $_SESSION['role'] === 'INFRASTRUCTURE')
                {
                    ?>
                    <a class='pp' href='#'><i class='fa-solid fa-check'></i><h4 class='sec'>Requests</h4></a>
                    <?php
                }
                if($_SESSION['role'] === 'AUDITOR')
                {
                    ?>
                    <a class='pp' href='#'><i class='fa-solid fa-list-check'></i><h4 class='sec'>Requests</h4></a>
                    <?php
                }
                if($_SESSION['level'] === 'YES')
                {
                    ?>
                    <a class='pp' href='#'><i class='fa-solid fa-list-check'></i><h4 class='sec'>Users</h4></a>
                    <?php
                }
                ?>
                <a id="logout" href="logout.php"><i class="fa-solid fa-arrow-right-from-bracket"></i><h4>Logout</h4></a>
            </div>

            <?php
                
                if($_SESSION['role'] === 'STAFF')
                {
                    $name = $_SESSION['name'];
                    ?>
                    <div id="request" class="container">
                        <h2>Employee Request Form</h2>
                        <button id="btn" class="bt btn btn-primary">New Request</button>
                        <div id="nr" class="newr mt-5">
                            
                            <form method="POST" id="form" action="create.php" class="req">

                                <div class="con">
                                    <div class="list">
                                        <div class="items">
                                            <input type="checkbox" name="tab[]" value="erp" class="check">
                                            <h4>ERP Id Request</h4>
                                        </div>
                                        <div class="items">
                                            <input type="checkbox" name="tab[]" value="email" class="check">
                                            <h4>Email Id Request</h4>
                                        </div>
                                        <div class="items">
                                            <input type="checkbox" name="tab[]" value="biometric" class="check">
                                            <h4>Biometric Request</h4>
                                            
                                        </div>
                                        <div class="items">
                                            <input type="checkbox" name="tab[]" value="internet" class="check" id="int">
                                            <h4>Internet Access Request</h4>
                                            
                                        </div>
                                        <div class="items">
                                            <input type="checkbox" name="tab[]" value="infrastructure" class="check" id="inf">
                                            <h4>Infrastructure Request</h4>
                                            
                                        </div>
                                        
                                    </div>
                                </div>

                                <div class="content">
                                    <div class="staff-det">
                                        <h4>Personal Details</h4>   
                                        <div class="opt">

                                            <div class="column mb-3">
                                                <label for="date" class="">Date of Request</label>
                                                <div class="">
                                                    <input type="date" name="date" id="date" class="form-control" disabled>
                                                </div>
                                                
                                            </div>
                                            <div class="column mb-3">
                                                <label for="req" class="">Requested for* (Name)</label>
                                                <div class="">
                                                    <input id="req" type="text" name="reqfor" class="form-control" oninput="this.value = this.value.toUpperCase();" required>
                                                </div>
                                                
                                            </div>
                                        </div>

                                        <div class="opt">
                                            <div class="column mb-3">
                                                <label for="dep" class="">Department*</label>
                                                <div class="">
                                                    <select name="dep" class="form-select" id="dep">
                                                        
                                                    </select>
                                                </div>
                                                
                                            </div>
                                            <div class="column mb-3">
                                                <label for="loc" class="">Location*</label>
                                                <div class="">
                                                    <select name="loc" class="form-select" id="loc">
                                                        
                                                    </select>
                                                </div>
                                                
                                            </div>
                                        </div>

                                        <div class="opt">

                                            <div class="column mb-3">
                                                <label for="num_inp" class="">Contact Information*</label>
                                                <div class="">
                                                    <input id="num_inp" type="text" minlength="10" maxlength="10" name="con" class="form-control" oninput="this.value = this.value.toUpperCase();" required>
                                                    <span id="err" style="color: red; display: none">Please enter exactly 10 digits </span>
                                                </div>
                                            </div>

                                            <div class="column mb-3">
                                                <label for="loc" class="">Employee Code*</label>
                                                <div class="">
                                                    <input id="empcode" type="text" name="empcode" class="form-control" oninput="this.value = this.value.toUpperCase();" required>
                                                </div>
                                                
                                            </div>

                                            
                                            
                                        </div>
                                    </div>

                                    <div id="internet" class="internet">
                                        <div class="opt">
                                            <div class="column mb-3">
                                                <label for="reqsites" class="">Requester Sites*</label>
                                                <div class="">
                                                    <input id="reqsites" type="text" name="reqsites" class="form-control" oninput="this.value = this.value.toUpperCase();">
                                                    <span id="err" style="color: red; display: none"></span>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                    <div id="infras">
                                        <h4>Infrastructure Request Details</h4>
                                        <div class="type">
                                            <div class="type_1">
                                                <h4>Software Request</h4>
                                                <input type="radio" name="type" value="SOFTWARE" id="soft_rad" checked>
                                            </div>
                                            <div class="type_2">
                                                <h4>Hardware Request</h4>
                                                <input type="radio" name="type" value="HARDWARE" id="hard_rad">
                                            </div>
                                        </div>
                                        
                                        <div class="inf_type">

                                            <div id="infras_hard" class=" mt-4">

                                                <div class="infras_rep" id="infras_rep">
                                                    <h4>Infrastructure Replacement</h4>
                                                    <input type="checkbox" name="oldhrepl" value="YES" id="inf_rep">
                                                </div>

                                                <div class="repl" id="repl">
                                                    <h4>Current Hardware Information</h4>
                                                    <div class="opt">

                                                        <div class="column mb-3">
                                                            <label for="oldhname" class="">Item Name/Description*</label>
                                                            <div class="">
                                                                <input id="oldhname" type="text" name="oldhname" class="form-control" oninput="this.value = this.value.toUpperCase();">
                                                                <span id="err" style="color: red; display: none">Field cannot be empty</span>
                                                            </div>
                                                            
                                                        </div>
                                                        <div class="column mb-3">
                                                            <label for="oldhser" class="">Serial Number*</label>
                                                            <div class="">
                                                                <input id="oldhser" type="text" name="oldhser" class="form-control" oninput="this.value = this.value.toUpperCase();">
                                                                <span id="err" style="color: red; display: none">Field cannot be empty</span>
                                                            </div>
                                                            
                                                        </div>
                                                    </div>

                                                    <div class="opt">
                                                        <div class="column mb-3">
                                                            <label for="oldhmod" class="">Model*</label>
                                                            <div class="">
                                                                <input id="oldhmod" type="text" name="oldhmod" class="form-control" oninput="this.value = this.value.toUpperCase();">
                                                                <span id="err" style="color: red; display: none">Field cannot be empty</span>
                                                            </div>
                                                            
                                                        </div>
                                                        <div class="column mb-3">
                                                            <label for="oldhardtag" class="">Asset Tag Number (if applicable)</label>
                                                            <div class="oldhardtag">
                                                                <input id="oldhardtag" type="text" name="oldhardtag" class="form-control" oninput="this.value = this.value.toUpperCase();">
                                                            </div>
                                                            
                                                        </div>
                                                    </div>

                                                    <div class="column mb-3">
                                                        <label for="oldhcond" class="col-sm-3 col-form-label">Condition of Current Hardware*</label>
                                                        <div class="col-sm-6">
                                                            <input id="oldhcond" type="text" name="oldhcond" class="form-control" oninput="this.value = this.value.toUpperCase();" placeholder="e.g. Working, Needs Repair, Non-Functional">
                                                            <span id="err" style="color: red; display: none">Field cannot be empty</span>
                                                        </div>

                                                    </div>

                                                    <div class=" mb-3">
                                                        <label for="hard-ta" class="">Reason for Replacement</label>
                                                        <div class="hard-text-area">
                                                            <textarea name="oldhreason" oninput="this.value = this.value.toUpperCase();" id="hard-ta" class="form-control"></textarea>
                                                        </div>
                                                                
                                                    </div>

                                                </div>

                                                <div id="new_hard" class="new_hard">
                                                    <h4>New Hardware Information</h4>
                                                    <div class="opt">

                                                        <div class="column mb-3">
                                                            <label for="newhname" class="">New Item Description*</label>
                                                            <div class="">
                                                                <input style="width: 50%;" id="newhname" type="text" name="newhname" class="form-control" oninput="this.value = this.value.toUpperCase();">
                                                                <span id="err" style="color: red; display: none">Field cannot be empty</span>
                                                            </div>
                                                            
                                                        </div>
                                                        
                                                    </div>

                                                </div>

                                            </div>

                                            <div id="infras_soft" class=" active mt-4">

                                                <div id="soft_new" class="soft_new">

                                                    <h4>New Software Information</h4>

                                                    <div class="column mb-3">
                                                        <label for="drop" style="align-self: center;">Software Request Type</label>
                                                        <div class="">
                                                            <select style="width: 50%;" name="stype" class="form-select" id="drop_soft">
                                                                <option value="Software Install" >Software Install</option>
                                                                <option value="Software Update" >Software Update</option>
                                                                
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="opt">

                                                        <div class="column mb-3">
                                                            <label for="newsname" class="">Software Details*</label>
                                                            <div class="">
                                                                <input id="newsname" style="width:50%;" type="text" name="newsname" class="form-control" oninput="this.value = this.value.toUpperCase();">
                                                                <span id="err" style="color: red; display: none">Field cannot be empty</span>
                                                            </div>
                                                            
                                                        </div>
                                                            
                                                    </div>

                                                </div>

                                            </div>

                                        </div>
                                        
                                        
                                    </div>
                                    
                                    <div class="row mb-3">
                                        <div class="col-sm-3 d-grid mt-5">
                                            <button  type="submit" class="btn btn-primary"><i class="fa-solid fa-spinner fa-spin" style="display: none;" id="load"></i>
                                                Request
                                            </button>
                                        </div>
                                        <div class="col-sm-3 d-grid mt-5">
                                            <a  type="submit" href="" class="bt btn btn-outline-primary" role="button">
                                                Cancel
                                            </a>
                                        </div>
                                        
                                    </div>
                                    
                                </div>
                                        
                            </form>
                        </div>
                        <h3 class="mt-5">Request lists</h3>
                        <div class="filter">
                            <form method="GET" action="" id="form_fils">
                                <div class="fil mb-1">
                                    <div class="column">
                                        <label for="st_date_fil" class="">Start Date</label>
                                        <div class="">
                                            <input type="date" name="st_date_fil" id="st_date_fil" value="<?= isset($_GET['st_date_fil']) ? $_GET['st_date_fil'] : '';?>" class="form-control">
                                        </div>
                                                
                                    </div>
                                    <div class="column">
                                        <label for="end_date_fil" class="">End Date</label>
                                        <div class="">
                                            <input type="date" name="end_date_fil" id="end_date_fil" value="<?= isset($_GET['end_date_fil']) ? $_GET['end_date_fil'] : '';?>" class="form-control">
                                        </div>
                                                
                                    </div>
                                    <div class="column">
                                        <label for="imp-drop" class="">Implement Status</label>
                                        <div class="">
                                            <select name="imp_status" class="form-select" id="imp-drop">
                                                <option value="Status" <?= isset($_GET['imp_status']) && $_GET['imp_status'] == 'Status'? 'selected':'';?>>Status</option>
                                                <option value="APPROVED" <?= isset($_GET['imp_status']) && $_GET['imp_status'] == 'APPROVED'? 'selected':'';?>>Approved</option>
                                                <option value="PENDING" <?= isset($_GET['imp_status']) && $_GET['imp_status'] == 'PENDING'? 'selected':'';?>>Pending</option>
                                                <option value="DECLINED" <?= isset($_GET['imp_status']) && $_GET['imp_status'] == 'DECLINED'? 'selected':'';?>>Declined</option>
                                            </select>
                                        </div>
                                                
                                    </div>
                                    <div class="column">
                                        <label for="aud-drop" class="">Audit Status</label>
                                        <div class="">
                                            <select name="aud_status" class="form-select" id="aud-drop">
                                                <option value="Status" <?= isset($_GET['aud_status']) && $_GET['aud_status'] == 'Status'? 'selected':'';?>>Status</option>
                                                <option value="APPROVED" <?= isset($_GET['aud_status']) && $_GET['aud_status'] == 'APPROVED'? 'selected':'';?>>Approved</option>
                                                <option value="PENDING" <?= isset($_GET['aud_status']) && $_GET['aud_status'] == 'PENDING'? 'selected':'';?>>Pending</option>
                                                <option value="DECLINED" <?= isset($_GET['aud_status']) && $_GET['aud_status'] == 'DECLINED'? 'selected':'';?>>Declined</option>
                                            </select>
                                        </div>
                                                
                                    </div>
                                </div>
                                <div class="fil mb-5">
                                    <div class="column">
                                        <label for="aud-drop" class="">Request Type</label>
                                        <div class="">
                                            <select name="req_type" class="form-select" id="role">
                                                <option value="All" <?= isset($_GET['req_type']) && $_GET['req_type'] == 'All'? 'selected':'';?>>All</option>
                                                <option value="erp" <?= isset($_GET['req_type']) && $_GET['req_type'] == 'erp'? 'selected':'';?>>Erp</option>
                                                <option value="email" <?= isset($_GET['req_type']) && $_GET['req_type'] == 'email'? 'selected':'';?>>Email</option>
                                                <option value="internet" <?= isset($_GET['req_type']) && $_GET['req_type'] == 'internet'? 'selected':'';?>>Internet</option>
                                                <option value="biometric" <?= isset($_GET['req_type']) && $_GET['req_type'] == 'biometric'? 'selected':'';?>>Biometric</option>
                                                <option value="infrastructure" <?= isset($_GET['req_type']) && $_GET['req_type'] == 'infrastructure'? 'selected':'';?>>Infrastructure</option>
                                            </select>
                                        </div> 
                                    </div>
                                    <div class="column mb-3">
                                        <label for="imp_by" class="">Implemented By</label>
                                        <div class="">
                                            <input type="text" name="imp_by" id="imp_by" value="<?= isset($_GET['imp_by']) ? $_GET['imp_by'] : '';?>" class="form-control">
                                        </div>
                                                
                                    </div>
                                    <div class="column mb-3">
                                        <label for="aud_by" class="">Audited By</label>
                                        <div class="">
                                            <input type="text" name="aud_by" id="aud_by" value="<?= isset($_GET['aud_by']) ? $_GET['aud_by'] : '';?>" class="form-control">
                                        </div>
                                                
                                    </div>
                                    <div class="column mb-3">
                                        <label for="aud_by" class="">Requested By</label>
                                        <div class="">
                                            <input type="text" name="req_by" id="c" value="<?= isset($_GET['req_by']) ? $_GET['req_by'] : '';?>" class="form-control">
                                        </div>
                                                
                                    </div>
                                    <div class="col mt-4">
                                            <button  type="submit" class="btn btn-primary">
                                                Filter
                                            </button>
                                    </div>
                                    <div class="col mt-4">
                                            <a  type="submit" href="home.php" class="bt btn btn-outline-primary" role="button">
                                                Reset
                                            </a>
                                    </div>
                                </div>
                                <div class="opt">
                                    <div class="fil mb-3">
                                        <label for="drop" style="align-self: center;">Show</label>
                                        <div class="">
                                            <select name="limit" onchange="this.form.submit()" class="form-select" id="drop">
                                                <option value="10" <?php if(isset($_GET['limit']) && $_GET['limit'] ==10) echo 'selected';?>>10</option>
                                                <option value="20" <?php if(isset($_GET['limit']) && $_GET['limit'] ==20) echo 'selected';?>>20</option>
                                                <option value="30" <?php if(isset($_GET['limit']) && $_GET['limit'] ==30) echo 'selected';?>>30</option>
                                                <option value="40" <?php if(isset($_GET['limit']) && $_GET['limit'] ==40) echo 'selected';?>>40</option>
                                                <option value="50" <?php if(isset($_GET['limit']) && $_GET['limit'] ==50) echo 'selected';?>>50</option>
                                            </select>
                                        </div>
                                        <label for="drop" style="align-self: center;">rows</label>
                                    </div>
                                    <h4 style="font-size: 15px; align-items: end;justify-content: center;cursor: pointer" onclick="exports_staff()">Export  <i class="fa-solid fa-download"></i></h4> 
                                </div>

                            </form>
                            
                        </div>
                        <table class="t table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Request ID</th>
                                    <th>Requested By</th>
                                    <th>Date of Request</th>
                                    <th>Implement Status</th>
                                    <th>Implemented By</th>
                                    <th>Date Implemented</th>
                                    <th>Audit Status</th>
                                    <th>Audited By</th>
                                    <th>Date Audited</th>
                                    <th>Request Type</th>
                                    <th>Action</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    include "db_conn.php";
                                    $userid = $_SESSION['userid'];
                                    $limit = isset($_GET['limit']) ? (int)$_GET['limit'] : 10;

                                    $page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;
                                    $start = ($page - 1) * $limit;

                                    $st_date = isset($_GET['st_date_fil']) ? $_GET['st_date_fil'] : '';
                                    $end_date = isset($_GET['end_date_fil']) ? $_GET['end_date_fil'] : '';
                                    $imp_status = isset($_GET['imp_status']) ? $_GET['imp_status'] : '';
                                    $aud_status = isset($_GET['aud_status']) ? $_GET['aud_status'] : '';
                                    $imp_by = isset($_GET['imp_by']) ? $_GET['imp_by'] : '';
                                    $aud_by = isset($_GET['aud_by']) ? $_GET['aud_by'] : '';
                                    $req_by = isset($_GET['req_by']) ? $_GET['req_by'] : '';
                                    $req_type = isset($_GET['req_type']) ? $_GET['req_type'] : '';

                                    $limit = max(1, $limit);
                                    $page = max(1, $page);
                                    $start = max(0, $start);
                                    $filters = [];

                                    if(!empty($st_date))
                                    {
                                        $filters[] = "DATE(Date)>='$st_date'";
                                        
                                    }

                                    if(!empty($end_date))
                                    {
                                        $filters[] = "DATE(Date)<='$end_date'";
                                        
                                    }

                                    if(!empty($imp_status))
                                    {
                                        if($imp_status !== 'Status')
                                        {
                                            $filters[] = "Status='$imp_status'";
                                        }
                                        
                                    }

                                    if(!empty($aud_status))
                                    {
                                        if($aud_status !== 'Status')
                                        {
                                            $filters[] = "Audited='$aud_status'";
                                        }
                                        
                                    }

                                    if(!empty($imp_by))
                                    {
                                        $filters[] = "Implementedby='$imp_by'";
                                        
                                    }

                                    if(!empty($aud_by))
                                    {
                                        $filters[] = "Auditedby='$aud_by'";
                                        
                                    }

                                    if(!empty($req_by))
                                    {
                                        $filters[] = "Requestedby='$req_by'";
                                        
                                    }

                                    if(!empty($req_type))
                                    {
                                        if($req_type !== 'All')
                                        {
                                            $filters[] = "data_base='$req_type'";
                                        }
                                        
                                    }

                                    $filters[] = "Userid='$userid'";

                                    $where_clause = '';
                                    if(count($filters) > 0)
                                    {
                                        $where_clause = "WHERE " . implode(" AND ", $filters);
                                    }

                                    $sql = "
                                        SELECT Ticketid,Requestedby,Date,Status,Implementedby,Audited,Auditedby,data_base,ImpDate,AudDate
                                        FROM erp 
                                        $where_clause
                                        
                                        UNION ALL
                                        
                                        SELECT Ticketid,Requestedby,Date,Status,Implementedby,Audited,Auditedby,data_base,ImpDate,AudDate
                                        FROM email 
                                        $where_clause
                                        
                                        UNION ALL
                                        
                                        SELECT Ticketid,Requestedby,Date,Status,Implementedby,Audited,Auditedby,data_base,ImpDate,AudDate
                                        FROM biometric 
                                        $where_clause
                                        
                                        UNION ALL
                                        
                                        SELECT Ticketid,Requestedby,Date,Status,Implementedby,Audited,Auditedby,data_base,ImpDate,AudDate
                                        FROM internet 
                                        $where_clause
                                        
                                        UNION ALL
                                        
                                        SELECT Ticketid,Requestedby,Date,Status,Implementedby,Audited,Auditedby,data_base,ImpDate,AudDate
                                        FROM infrastructure 
                                        $where_clause
                                        
                                        ORDER BY Date DESC LIMIT $limit OFFSET $start";

                                    $result = $conn->query($sql);
                                    $data = [];

                                    if($result->num_rows > 0)
                                    {
                                        while($row = $result->fetch_assoc())
                                        {
                                            $data[] = $row;
                                            echo "<tr>
                                                <td>". $row["Ticketid"] ." </td>
                                                <td>". $row["Requestedby"] ." </td>
                                                <td>". $row["Date"] ." </td>
                                                <td>". $row["Status"] ." </td>
                                                <td>". $row["Implementedby"] ." </td>
                                                <td>". $row["ImpDate"] ." </td>
                                                <td>". $row["Audited"] ." </td>
                                                <td>". $row["Auditedby"] ." </td>
                                                <td>". $row["AudDate"] ." </td>
                                                <td>". strtoupper($row["data_base"]) ." </td>
                                                <td><a class='btn btn-primary' href='/RequestApp/view.php?id=". $row["Ticketid"] ."&type=". $row["data_base"] ."&page=$page'>View</a>
                                                </td>
                                                </tr>";
                                            
                                        }
                                        $_SESSION['query_res'] = $data;
                                        $data = [];
                                        
                                    }else{
                                        echo "<tr>
                                                <td colspan='11' >No records found</td>
                                                </tr>";
                                        $_SESSION['query_res'] = [];
                                    }
                                ?>
                                
                            </tbody>
                        </table>
                        <?php
                        $sql = "SELECT COUNT(*) AS total FROM(
                        SELECT Ticketid FROM erp $where_clause
                        UNION ALL
                        SELECT Ticketid FROM email $where_clause
                        UNION ALL
                        SELECT Ticketid FROM biometric $where_clause
                        UNION ALL
                        SELECT Ticketid FROM internet $where_clause
                        UNION ALL
                        SELECT Ticketid FROM infrastructure $where_clause) as total_table";

                        $result = $conn->query($sql);
                        $total_records = 0;
                        while($row_count = $result->fetch_assoc())
                        {
                            if(isset($row_count['total']))
                            {
                                $total_records +=$row_count['total'];
                            }
                            
                        }

                        $total_pages = ceil($total_records/$limit);
                        $qpar = $_GET;
                        unset($qpar['page']);

                        $qstring = http_build_query($qpar);

                        ?>
                        <div class="pg">
                            <?php
                            if($total_pages > 1)
                            {
                                if($page > 1)
                                {
                                    echo "<a class='btn btn-primary' href='?page=" . ($page - 1) . ($qstring ? '&' . $qstring : '') . "'>Prev</a>";
                                }else{
                                    echo "<button class='btn btn-primary' disabled>Prev</button>";
                                }
                                echo "<label style='margin: 10px;'>$page</label>";
                                echo "<label style='margin-top: 10px;margin-bottom: 10px;margin-right: 10px;'>of $total_pages</label>";
                                if($page < $total_pages)
                                {
                                    echo "<a class='btn btn-primary' href='home.php?page=" . ($page + 1) . ($qstring ? '&' . $qstring : '') . "'>Next</a>";
                                }else{
                                    echo "<button class='btn btn-primary' disabled>Next</button>";
                                }
                            }
                            
                            ?>
                        </div>
                        <?php
                        ?>
                        <div id="space">

                        </div>
                    </div>

                    <?php
                }

                if($_SESSION['role'] === 'ERP' || $_SESSION['role'] === 'EMAIL' || $_SESSION['role'] === 'BIOMETRIC' || $_SESSION['role'] === 'INTERNET' || $_SESSION['role'] === 'INFRASTRUCTURE')
                {
                    $role = $_SESSION['role'];
                    ?>
                    <div id="request" class="container">
                        <h2 class=""><?php echo isset($role) ? ucfirst(strtolower($role)): 'Implementor';?> Request Lists</h2>
                        <div class="filter">
                        <form method="GET" action="" id="form">
                            <div class="fil mb-5">
                                <div class="column">
                                    <label for="st_date_fil_imp" class="">Start Date</label>
                                    <div class="">
                                        <input type="date" name="st_date_fil_imp" id="st_date_fil_imp" value="<?= isset($_GET['st_date_fil_imp']) ? $_GET['st_date_fil_imp'] : '';?>" class="form-control">
                                    </div>
                                            
                                </div>
                                <div class="column">
                                    <label for="end_date_fil_imp" class="">End Date</label>
                                    <div class="">
                                        <input type="date" name="end_date_fil_imp" id="end_date_fil_imp" value="<?= isset($_GET['end_date_fil_imp']) ? $_GET['end_date_fil_imp'] : '';?>" class="form-control">
                                    </div>
                                            
                                </div>
                                <div class="column">
                                    <label for="imp-drop" class="">Implement Status</label>
                                    <div class="">
                                        <select name="imp_status" class="form-select" id="imp-drop">
                                            <option value="Status" <?= isset($_GET['imp_status']) && $_GET['imp_status'] == 'Status'? 'selected':'';?>>Status</option>
                                            <option value="APPROVED" <?= isset($_GET['imp_status']) && $_GET['imp_status'] == 'APPROVED'? 'selected':'';?>>Approved</option>
                                            <option value="PENDING" <?= isset($_GET['imp_status']) && $_GET['imp_status'] == 'PENDING'? 'selected':'';?>>Pending</option>
                                            <option value="DECLINED" <?= isset($_GET['imp_status']) && $_GET['imp_status'] == 'DECLINED'? 'selected':'';?>>Declined</option>
                                        </select>
                                    </div>
                                            
                                </div>
                                <div class="column mb-3">
                                    <label for="req_by_imp" class="">Requested By</label>
                                    <div class="">
                                        <input type="text" name="req_by_imp" id="req_by_imp" value="<?= isset($_GET['req_by_imp']) ? $_GET['req_by_imp'] : '';?>" class="form-control">
                                    </div>
                                            
                                </div>
                                <div class="col mt-4">
                                        <button  type="submit" class="btn btn-primary">
                                            Filter
                                        </button>
                                </div>
                                <div class="col mt-4">
                                        <a  type="submit" href="home.php" class="bt btn btn-outline-primary" role="button">
                                            Reset
                                        </a>
                                </div>
                    
                            </div>
                            <div class="opt">

                                <div class="fil mb-3">
                                    <label for="drop" style="align-self: center;">Show</label>
                                    <div class="">
                                        <select name="limit" onchange="this.form.submit()" class="form-select" id="drop">
                                            <option value="10" <?php if(isset($_GET['limit']) && $_GET['limit'] ==10) echo 'selected';?>>10</option>
                                            <option value="20" <?php if(isset($_GET['limit']) && $_GET['limit'] ==20) echo 'selected';?>>20</option>
                                            <option value="30" <?php if(isset($_GET['limit']) && $_GET['limit'] ==30) echo 'selected';?>>30</option>
                                            <option value="40" <?php if(isset($_GET['limit']) && $_GET['limit'] ==40) echo 'selected';?>>40</option>
                                            <option value="50" <?php if(isset($_GET['limit']) && $_GET['limit'] ==50) echo 'selected';?>>50</option>
                                        </select>
                                    </div>
                                    <label for="drop" style="align-self: center;">rows</label>
                                    
                                </div>
                                <h4 style="font-size: 15px; align-items: end;justify-content: center;cursor: pointer" onclick="exports_imp()">Export  <i class="fa-solid fa-download"></i></h4>

                            </div>
                            
                        </form>
                        
                    </div>
                        <table class="t table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Request ID</th>
                                    <th>Requested By</th>
                                    <th>Date of Request</th>
                                    <?php
                                    if($role == 'INFRASTRUCTURE')
                                    {
                                        echo '<th>Type</th>';
                                    }
                                    ?>
                                    <th>Status</th>
                                    <th>Implemented Date</th>
                                    <th>Audited Status</th>
                                    <th>Action</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    include "db_conn.php";
                                    $userid = $_SESSION['userid'];
                                    $name = $_SESSION['name'];
                                    $rol = $_SESSION['role'];

                                    $limit = isset($_GET['limit']) ? (int)$_GET['limit'] : 10;

                                    $page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;
                                    $start = ($page - 1) * $limit;

                                    $st_date = isset($_GET['st_date_fil_imp']) ? $_GET['st_date_fil_imp'] : '';
                                    $end_date = isset($_GET['end_date_fil_imp']) ? $_GET['end_date_fil_imp'] : '';
                                    $req_by = isset($_GET['req_by_imp']) ? $_GET['req_by_imp'] : ''; 
                                    $imp_status = isset($_GET['imp_status']) ? $_GET['imp_status'] : '';

                                    $limit = max(1, $limit);
                                    $page = max(1, $page);
                                    $start = max(0, $start);
                                    $sql = "";

                                    if($role == 'INFRASTRUCTURE'){

                                        $sql = "
                                                SELECT Ticketid,Requestedby,Date,Type,Status,ImpDate,Audited,data_base FROM $rol 
                                                WHERE 1=1
                                    
                                                ";

                                    }else{
                                        $sql = "
                                                SELECT Ticketid,Requestedby,Date,Status,ImpDate,Audited,data_base FROM $rol 
                                                WHERE 1=1
                                    
                                                ";
                                    }


                                    if(!empty($st_date))
                                    {
                                        $sql .= " AND DATE(Date)>='$st_date'";
                                        
                                    }

                                    if(!empty($end_date))
                                    {
                                        $sql .= " AND DATE(Date)<='$end_date'";
                                        
                                    }

                                    if(!empty($req_by))
                                    {
                                        $sql .= " AND Requestedby='$req_by'";
                                        
                                    }

                                    if(!empty($imp_status))
                                    {
                                        if($imp_status !== 'Status')
                                        {
                                            $sql .= " AND Status='$imp_status'";
                                        }
                                        
                                    }

                                    $sql .= "  ORDER BY Date DESC LIMIT $limit OFFSET $start";


                                    if($rol != "auditor" && $rol != "staff" )
                                    {
                                                $data = [];
                                                $result = $conn->query($sql);

                                                if($result->num_rows > 0)
                                                {
                                                    if($role == 'INFRASTRUCTURE')
                                                    {
                                                        while($row = $result->fetch_assoc())
                                                        {
                                                            $data[] = $row;
                                                            echo "<tr>
                                                                <td>". $row["Ticketid"] ." </td>
                                                                <td>". $row["Requestedby"] ." </td>
                                                                <td>". $row["Date"] ." </td>
                                                                <td>". $row["Type"] ." </td>
                                                                <td>". $row["Status"] ." </td>
                                                                <td>". $row["ImpDate"] ." </td>
                                                                <td>". $row["Audited"] ." </td>
                                                                <td><a class='btn btn-primary'  href='/RequestApp/impl.php?id=". $row["Ticketid"] ."&type=". $row["data_base"] ."&page=$page'>View</a></td>
                                                                </tr>";
                                                        }
                                                    }else{
                                                        while($row = $result->fetch_assoc())
                                                        {
                                                            $data[] = $row;
                                                            echo "<tr>
                                                                <td>". $row["Ticketid"] ." </td>
                                                                <td>". $row["Requestedby"] ." </td>
                                                                <td>". $row["Date"] ." </td>
                                                                <td>". $row["Status"] ." </td>
                                                                <td>". $row["ImpDate"] ." </td>
                                                                <td>". $row["Audited"] ." </td>
                                                                <td><a class='btn btn-primary'  href='/RequestApp/impl.php?id=". $row["Ticketid"] ."&type=". $row["data_base"] ."&page=$page'>View</a></td>
                                                                </tr>";
                                                        }
                                                    }
                                                    $_SESSION['query_res'] = $data;
                                                    $data = [];
                                                    
                                                }else{
                                                    if($role == 'INFRASTRUCTURE')
                                                    {
                                                        echo "<tr>
                                                            <td colspan='8' >No records found</td>
                                                            </tr>";
                                                    }else{
                                                        echo "<tr>
                                                            <td colspan='7' >No records found</td>
                                                            </tr>";
                                                    }

                                                    $_SESSION['query_res'] = [];
                                                    
                                                } 
                                    }else{
                                        echo "<tr>
                                                <td colspan='7' >No records found</td>
                                                </tr>";
                                    }
                                    
                                ?>
                                
                            </tbody>
                        </table>
                        <?php
                        $rol = $_SESSION['role'];
                        if($rol != "auditor" && $rol != "staff" )
                        {
                            $sql = "SELECT COUNT(*) AS total FROM $rol WHERE 1=1";

                            if(!empty($st_date))
                            {
                                $sql .= " AND DATE(Date)>='$st_date'";
                                
                            }

                            if(!empty($end_date))
                            {
                                $sql .= " AND DATE(Date)<='$end_date'";
                                
                            }

                            if(!empty($req_by))
                            {
                                $sql .= " AND Requestedby='$req_by'";
                                
                            }

                            if(!empty($imp_status))
                            {
                                $sql .= " AND Status='$imp_status'";
                                
                            }

                            $result = $conn->query($sql);
                            $total_records = 0;
                            while($row_count = $result->fetch_assoc())
                            {
                                if(isset($row_count['total']))
                                {
                                    $total_records +=$row_count['total'];
                                }
                                
                            }

                            $total_pages = ceil($total_records/$limit);

                            $qpar = $_GET;
                            unset($qpar['page']);

                            $qstring = http_build_query($qpar);

                            ?>
                            <div class="pg">
                                <?php
                                if($total_pages > 1)
                                {
                                    if($page > 1)
                                    {
                                        echo "<a class='btn btn-primary' href='?page=" . ($page - 1) . ($qstring ? '&' . $qstring : '') . "'>Prev</a>";
                                    }else{
                                        echo "<button class='btn btn-primary' disabled>Prev</button>";
                                    }
                                    echo "<label style='margin: 10px;'>$page</label>";
                                    echo "<label style='margin-top: 10px;margin-bottom: 10px;margin-right: 10px;'>of $total_pages</label>";
                                    if($page < $total_pages)
                                    {
                                        echo "<a class='btn btn-primary' href='home.php?page=" . ($page + 1) . ($qstring ? '&' . $qstring : '') . "'>Next</a>";
                                    }else{
                                        echo "<button class='btn btn-primary' disabled>Next</button>";
                                    }
                                }
                                
                                ?>
                            </div>
                            <?php
                            
                        }
                        
                        ?>
                        <div id="space">

                        </div>
                    </div>
                    <?php
                }

                if($_SESSION['role'] === 'AUDITOR')
                {
                    ?>
                    <div id="request" class="container">
                    <h2 class="">Auditor Request lists</h2>
                    <div class="filter">
                        <form method="GET" action="" id="form">
                            <div class="fil">
                                <div class="column">
                                    <label for="st_date_fil" class="">Start Date</label>
                                    <div class="">
                                        <input type="date" name="st_date_fil" id="st_date_fil" value="<?= isset($_GET['st_date_fil']) ? $_GET['st_date_fil'] : '';?>" class="form-control">
                                    </div>
                                            
                                </div>
                                <div class="column">
                                    <label for="end_date_fil" class="">End Date</label>
                                    <div class="">
                                        <input type="date" name="end_date_fil" id="end_date_fil" value="<?= isset($_GET['end_date_fil']) ? $_GET['end_date_fil'] : '';?>" class="form-control">
                                    </div>
                                            
                                </div>
                                <div class="column">
                                    <label for="aud-drop" class="">Audit Status</label>
                                    <div class="">
                                        <select name="aud_status" class="form-select" id="aud-drop">
                                            <option value="Status" <?= isset($_GET['aud_status']) && $_GET['aud_status'] == 'Status'? 'selected':'';?>>Status</option>
                                            <option value="APPROVED" <?= isset($_GET['aud_status']) && $_GET['aud_status'] == 'APPROVED'? 'selected':'';?>>Approved</option>
                                            <option value="PENDING" <?= isset($_GET['aud_status']) && $_GET['aud_status'] == 'PENDING'? 'selected':'';?>>Pending</option>
                                            <option value="DECLINED" <?= isset($_GET['aud_status']) && $_GET['aud_status'] == 'DECLINED'? 'selected':'';?>>Declined</option>
                                        </select>
                                    </div>
                                            
                                </div>
                                <div class="column">
                                    <label for="aud-drop" class="">Request Type</label>
                                    <div class="">
                                        <select name="req_type" class="form-select" id="req-type">
                                            <option value="All" <?= isset($_GET['req_type']) && $_GET['req_type'] == 'All'? 'selected':'';?>>All</option>
                                            <option value="erp" <?= isset($_GET['req_type']) && $_GET['req_type'] == 'erp'? 'selected':'';?>>Erp</option>
                                            <option value="email" <?= isset($_GET['req_type']) && $_GET['req_type'] == 'email'? 'selected':'';?>>Email</option>
                                            <option value="internet" <?= isset($_GET['req_type']) && $_GET['req_type'] == 'internet'? 'selected':'';?>>Internet</option>
                                            <option value="biometric" <?= isset($_GET['req_type']) && $_GET['req_type'] == 'biometric'? 'selected':'';?>>Biometric</option>
                                            <option value="infrastructure" <?= isset($_GET['req_type']) && $_GET['req_type'] == 'infrastructure'? 'selected':'';?>>Infrastructure</option>
                                        </select>
                                    </div>
                                            
                                </div>
                                <div class="column mb-3">
                                    <label for="imp_by" class="">Implemented By</label>
                                    <div class="">
                                        <input type="text" name="imp_by" id="imp_by" value="<?= isset($_GET['imp_by']) ? $_GET['imp_by'] : '';?>" class="form-control">
                                    </div>
                                            
                                </div>
                                
                                <div class="column mb-3">
                                    <label for="req_by" class="">Requested By</label>
                                    <div class="">
                                        <input type="text" name="req_by" id="req_by" value="<?= isset($_GET['req_by']) ? $_GET['req_by'] : '';?>" class="form-control">
                                    </div>
                                            
                                </div>
                                
                            </div>

                            <div class="fi mb-5" style="display: flex; width: 50px; gap: 10px;">
                                <div class="col">
                                        <button  type="submit" class="btn btn-primary">
                                            Filter
                                        </button>
                                </div>
                                <div class="col">
                                        <a  type="submit" href="home.php" class="bt btn btn-outline-primary" role="button">
                                            Reset
                                        </a>
                                </div>
                            </div>
                            <div class="opt">

                                <div class="fil mb-3">
                                    <label for="drop" style="align-self: center;">Show</label>
                                    <div class="">
                                        <select name="limit" onchange="this.form.submit()" class="form-select" id="drop">
                                            <option value="10" <?php if(isset($_GET['limit']) && $_GET['limit'] ==10) echo 'selected';?>>10</option>
                                            <option value="20" <?php if(isset($_GET['limit']) && $_GET['limit'] ==20) echo 'selected';?>>20</option>
                                            <option value="30" <?php if(isset($_GET['limit']) && $_GET['limit'] ==30) echo 'selected';?>>30</option>
                                            <option value="40" <?php if(isset($_GET['limit']) && $_GET['limit'] ==40) echo 'selected';?>>40</option>
                                            <option value="50" <?php if(isset($_GET['limit']) && $_GET['limit'] ==50) echo 'selected';?>>50</option>
                                        </select>
                                    </div>
                                    <label for="drop" style="align-self: center;">rows</label>
                                    
                                </div>
                                <h4 style="font-size: 15px; align-items: end;justify-content: center;cursor: pointer" onclick="exports_aud()">Export  <i class="fa-solid fa-download"></i></h4> 

                            </div>
                            
                        </form>
                        
                    </div>
                    <table class="t table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Request ID</th>
                                <th>Requested By</th>
                                <th>Date of Request</th>
                                <th>Implemented By</th>
                                <th>Implemented Date</th>
                                <th>Status</th>
                                <th>Audited Date</th>
                                <th>Request Type</th>
                                <th>Action</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                include "db_conn.php";
                                $userid = $_SESSION['userid'];
                                $name = $_SESSION['name'];

                                $limit = isset($_GET['limit']) ? (int)$_GET['limit'] : 10;

                                $page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;
                                $start = ($page - 1) * $limit;

                                $st_date = isset($_GET['st_date_fil']) ? $_GET['st_date_fil'] : '';
                                $end_date = isset($_GET['end_date_fil']) ? $_GET['end_date_fil'] : '';
                                $aud_status = isset($_GET['aud_status']) ? $_GET['aud_status'] : '';
                                $imp_by = isset($_GET['imp_by']) ? $_GET['imp_by'] : '';
                                $req_by = isset($_GET['req_by']) ? $_GET['req_by'] : '';
                                $req_type = isset($_GET['req_type']) ? $_GET['req_type'] : '';

                                $limit = max(1, $limit);
                                $page = max(1, $page);
                                $start = max(0, $start);
                                $filters = [];

                                if(!empty($st_date))
                                {
                                    $filters[] = "DATE(Date)>='$st_date'";
                                    
                                }

                                if(!empty($end_date))
                                {
                                    $filters[] = "DATE(Date)<='$end_date'";
                                    
                                }

                                if(!empty($imp_by))
                                {
                                    $filters[] = "Implementedby='$imp_by'";
                                    
                                }

                                if(!empty($req_by))
                                {
                                    $filters[] = "Requestedby='$req_by'";
                                    
                                }

                                if(!empty($aud_status))
                                {
                                    if($aud_status !== 'Status')
                                    {
                                        $filters[] = "Audited='$aud_status'";
                                    }
                                    
                                }

                                if(!empty($req_type))
                                {
                                    if($req_type !== 'All')
                                    {
                                        $filters[] = "data_base='$req_type'";
                                    }
                                    
                                }

                                $filters[] = "Status='Approved'";
                                $filters[] = "Status='APPROVED'";


                                $where_clause = '';
                                if(count($filters) > 0)
                                {
                                    $where_clause = "WHERE " . implode(" AND ", $filters);
                                }

                                $sql = "
                                SELECT Ticketid,Requestedby,Date,Implementedby,data_base,Audited,ImpDate,AudDate
                                FROM erp 
                                $where_clause
                                
                                UNION ALL
                                
                                SELECT Ticketid,Requestedby,Date,Implementedby,data_base,Audited,ImpDate,AudDate
                                FROM email 
                                $where_clause
                                
                                UNION ALL
                                
                                SELECT Ticketid,Requestedby,Date,Implementedby,data_base,Audited,ImpDate,AudDate
                                FROM biometric 
                                $where_clause
                                
                                UNION ALL
                                
                                SELECT Ticketid,Requestedby,Date,Implementedby,data_base,Audited,ImpDate,AudDate
                                FROM internet 
                                $where_clause
                                
                                UNION ALL
                                
                                SELECT Ticketid,Requestedby,Date,Implementedby,data_base,Audited,ImpDate,AudDate
                                FROM infrastructure 
                                $where_clause
                                
                                ORDER BY Date DESC LIMIT $start, $limit";

                                $result = $conn->query($sql);
                                $data = [];

                                if($result->num_rows > 0)
                                {
                                    while($row = $result->fetch_assoc())
                                    {
                                        $data[] = $row;
                                        echo "<tr>
                                            <td>". $row["Ticketid"] ." </td>
                                            <td>". $row["Requestedby"] ." </td>
                                            <td>". $row["Date"] ." </td>
                                            <td>". $row["Implementedby"] ." </td>
                                            <td>". $row["ImpDate"] ." </td>
                                            <td>". $row["Audited"] ." </td>
                                            <td>". $row["AudDate"] ." </td>
                                            <td>". strtoupper($row["data_base"]) ." </td>
                                            <td><a class='btn btn-primary' href='/RequestApp/aud.php?id=". $row["Ticketid"] ."&type=". $row["data_base"] ."&page=$page'>View</a></td>
                                            </tr>";
                                    }
                                    $_SESSION['query_res'] = $data;
                                    $data = [];
                                    
                                }else{
                                    echo "<tr>
                                            <td colspan='9' >No records found</td>
                                            </tr>";
                                    $_SESSION['query_res'] = [];
                                }
                            ?>
                            
                        </tbody>
                    </table>
                    <?php
                    $sql = "SELECT COUNT(*) AS total FROM(
                        SELECT Ticketid FROM erp $where_clause
                        UNION ALL
                        SELECT Ticketid FROM email $where_clause
                        UNION ALL
                        SELECT Ticketid FROM biometric $where_clause
                        UNION ALL
                        SELECT Ticketid FROM internet $where_clause
                        UNION ALL
                        SELECT Ticketid FROM infrastructure $where_clause) as total_table";

                    $result = $conn->query($sql);
                    $total_records = 0;
                    while($row_count = $result->fetch_assoc())
                    {
                        if(isset($row_count['total']))
                        {
                            $total_records +=$row_count['total'];
                        }
                        
                    }

                    $total_pages = ceil($total_records/$limit);

                    $qpar = $_GET;
                    unset($qpar['page']);

                    $qstring = http_build_query($qpar);

                    ?>
                    <div class="pg">
                        <?php
                        if($total_pages > 1)
                        {
                            if($page > 1)
                            {
                                echo "<a class='btn btn-primary' href='?page=" . ($page - 1) . ($qstring ? '&' . $qstring : '') . "'>Prev</a>";
                            }else{
                                echo "<button class='btn btn-primary' disabled>Prev</button>";
                            }
                            echo "<label style='margin: 10px;'>$page</label>";
                            echo "<label style='margin-top: 10px;margin-bottom: 10px;margin-right: 10px;'>of $total_pages</label>";
                            if($page < $total_pages)
                            {
                                echo "<a class='btn btn-primary' href='home.php?page=" . ($page + 1) . ($qstring ? '&' . $qstring : '') . "'>Next</a>";
                            }else{
                                echo "<button class='btn btn-primary' disabled>Next</button>";
                            }
                        }
                        
                        ?>
                    </div>
                    <?php
                    ?>
                    <div id="space">

                    </div>
                    </div>
                    <?php
                }

                if($_SESSION['level'] === 'YES')
                {
                    $name = $_SESSION['name'];
                    ?>
                    <div id="request" class="container">
                        <h2>Users</h2>
                        <button id="btn_user" class="bt btn btn-primary">Create User</button>
                        <div id="nr_user" class="newr mt-2">
                            
                            <form method="POST" id="forms" action="create_user.php" class="req">

                                <div class="content">
                                    <div class="staff-det">
                                        <h4>Personal Details</h4>   
                                        <div class="opt">

                                            <div class="column mb-3">
                                                <label for="u_name" class="">Username*</label>
                                                <div class="">
                                                    <input type="text" name="u_name" id="u_name" class="form-control" oninput="this.value = this.value.toUpperCase();" required>
                                                    
                                                </div>
                                                
                                            </div>
                                            <div class="column mb-3">
                                                <label for="name" class="">Name*</label>
                                                <div class="">
                                                    <input type="text" name="name" id="name" class="form-control" oninput="this.value = this.value.toUpperCase();" required>
                                                </div>
                                                
                                            </div>
                                            
                                        </div>

                                        <div class="opt">
                                            <div class="column mb-3">
                                                <label for="dep" class="">User Id (Staff Id)*</label>
                                                <div class="">
                                                    <input type="text" name="u_id" id="u_id" class="form-control" oninput="this.value = this.value.toUpperCase();" required>
                                                    <span id="err_id" style="color: red; display: none">User Id already exist</span>
                                                </div>
                                                
                                            </div>
                                            <div class="column mb-3">
                                                <label for="req" class="">Role</label>
                                                <div class="">
                                                    <select name="role" class="form-select" id="role">
                                                        <option value="STAFF" >STAFF</option>
                                                        <option value="AUDITOR" >AUDITOR</option>
                                                        <option value="EMAIL" >EMAIL</option>
                                                        <option value="ERP" >ERP</option>
                                                        <option value="BIOMETRIC" >BIOMETRIC</option>
                                                        <option value="INTERNET" >INTERNET</option>
                                                        <option value="INFRASTRUCTURE" >INFRASTRUCTURE</option>
                                                    </select>
                                                </div>
                                                
                                            </div>
                                        </div>

                                        <div class="opt">

                                            <div class="column mb-3">
                                                <label for="u_name" class="">Password*</label>
                                                <div class="">
                                                    <input type="password" name="pass" id="pass" class="form-control" minlength="8" placeholder="Password length should be at least 8" required>
                                                    <span id="err" style="color: red; display: none">Passwords do not match</span>
                                                </div>
                                                
                                            </div>
                                            <div class="column mb-3">
                                                <label for="name" class="">Confirm Password*</label>
                                                <div class="">
                                                    <input type="password" name="u_pass_con" id="pass_con" class="form-control" required>
                                                    <span id="err" style="color: red; display: none">Passwords do not match</span>
                                                </div>
                                                
                                            </div>
                                            
                                        </div>

                                        <div class="con">
                                            <div class="list">
                                                <div class="items_user">
                                                    <input type="checkbox" name="level" value="YES" class="check_user">
                                                    <h4>Admin</h4>
                                                </div>
                                                
                                            </div>
                                        </div>

                                    </div>
                                    
                                    <div class="row mb-3">
                                        <div class="col-sm-3 d-grid mt-5">
                                            <button  type="submit" class="btn btn-primary">
                                                Create
                                            </button>
                                        </div>
                                        <div class="col-sm-3 d-grid mt-5">
                                            <a  type="submit" href="" class="bt btn btn-outline-primary" role="button">
                                                Cancel
                                            </a>
                                        </div>
                                        
                                    </div>
                                    
                                </div>
                                        
                            </form>
                        </div>
                        <h3 class="mt-5">Users lists</h3>
                        <div class="filter">
                            <form method="GET" action="" id="form_fil">
                                <div class="fil mb-1">
                                    <div class="column">
                                        <label for="imp-drop" class="">Name</label>
                                        <div class="">
                                            <input type="text" name="name_fil" id="name_fil" value="<?= isset($_GET['name_fil']) ? $_GET['name_fil'] : '';?>" class="form-control">
                                        </div>
                                                
                                    </div>
                                    <div class="column">
                                        <label for="aud-drop" class="">User Id</label>
                                        <div class="">
                                            <input type="text" name="user_id_fil" id="user_id_fil" value="<?= isset($_GET['user_id_fil']) ? $_GET['user_id_fil'] : '';?>" class="form-control">
                                        </div>
                                                
                                    </div>
                                    <div class="column">
                                        <label for="aud-drop" class="">Username</label>
                                        <div class="">
                                            <input type="text" name="user_name_fil" id="user_name_fil" value="<?= isset($_GET['user_name_fil']) ? $_GET['user_name_fil'] : '';?>" class="form-control">
                                        </div>
                                    </div>
                                    <div class="column mb-3">
                                        <label for="imp_by" class="">Admin</label>
                                        <select name="admin" class="form-select" id="admin">
                                            <option value="---" <?= isset($_GET['admin']) && $_GET['admin'] == '---'? 'selected':'';?>>---</option>
                                            <option value="YES" <?= isset($_GET['admin']) && $_GET['admin'] == 'YES'? 'selected':'';?>>YES</option>
                                            <option value="NO" <?= isset($_GET['admin']) && $_GET['admin'] == 'NO'? 'selected':'';?>>NO</option>
                                        </select>
                                                
                                    </div>
                                
                                    <div class="col mt-4">
                                            <button  type="submit" class="btn btn-primary">
                                                Filter
                                            </button>
                                    </div>
                                    <div class="col mt-4">
                                            <a  type="submit" href="home.php" class="bt btn btn-outline-primary" role="button">
                                                Reset
                                            </a>
                                    </div>
                                </div>

                                <div class="fil mb-5">
                                    <div class="column" style="width: 20.5%;">
                                        <label for="aud-drop" class="">User Type</label>
                                        <div class="">
                                            <select name="role" class="form-select" id="role-users">
                                                <option value="ALL" <?= isset($_GET['role']) && $_GET['role'] == 'ALL'? 'selected':'';?>>ALL</option>
                                                <option value="AUDITOR" <?= isset($_GET['role']) && $_GET['role'] == 'AUDITOR'? 'selected':'';?>>AUDITOR</option>
                                                <option value="ERP" <?= isset($_GET['role']) && $_GET['role'] == 'ERP'? 'selected':'';?>>ERP</option>
                                                <option value="EMAIL" <?= isset($_GET['role']) && $_GET['role'] == 'EMAIL'? 'selected':'';?>>EMAIL</option>
                                                <option value="INTERNET" <?= isset($_GET['role']) && $_GET['role'] == 'INTERNET'? 'selected':'';?>>INTERNET</option>
                                                <option value="BIOMETRIC" <?= isset($_GET['role']) && $_GET['role'] == 'BIOMETRIC'? 'selected':'';?>>BIOMETRIC</option>
                                                <option value="INFRASTRUCTURE" <?= isset($_GET['role']) && $_GET['role'] == 'INFRASTRUCTURE'? 'selected':'';?>>INFRASTRUCTURE</option>
                                                <option value="STAFF" <?= isset($_GET['role']) && $_GET['role'] == 'STAFF'? 'selected':'';?>>STAFF</option>
                                            </select>
                                        </div> 
                                    </div>
                                    
                                </div>
                                
                                <div class="opt">
                                    <div class="fil mb-3">
                                        <label for="drop" style="align-self: center;">Show</label>
                                        <div class="">
                                            <select name="limit" onchange="this.form.submit()" class="form-select" id="limit_user">
                                                <option value="10" <?php if(isset($_GET['limit']) && $_GET['limit'] ==10) echo 'selected';?>>10</option>
                                                <option value="20" <?php if(isset($_GET['limit']) && $_GET['limit'] ==20) echo 'selected';?>>20</option>
                                                <option value="30" <?php if(isset($_GET['limit']) && $_GET['limit'] ==30) echo 'selected';?>>30</option>
                                                <option value="40" <?php if(isset($_GET['limit']) && $_GET['limit'] ==40) echo 'selected';?>>40</option>
                                                <option value="50" <?php if(isset($_GET['limit']) && $_GET['limit'] ==50) echo 'selected';?>>50</option>
                                            </select>
                                        </div>
                                        <label for="drop" style="align-self: center;">rows</label>
                                    </div>
                                    <h4 style="font-size: 15px; align-items: end;justify-content: center;cursor: pointer" onclick="exports_users()">Export  <i class="fa-solid fa-download"></i></h4> 
                                </div>

                            </form>
                            
                        </div>
                        <table class="t table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>User ID</th>
                                    <th>Name</th>
                                    <th>User Role</th>
                                    <th>Date Created</th>
                                    <th>Action</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    include "db_conn.php";
                                    //$userid = $_SESSION['userid'];
                                    $limit_user = isset($_GET['limit']) ? (int)$_GET['limit'] : 10;

                                    $page_user = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;
                                    $start_user = ($page - 1) * $limit;

                                
                                    $name = isset($_GET['name_fil']) ? $_GET['name_fil'] : '';
                                    $userid = isset($_GET['user_id_fil']) ? $_GET['user_id_fil'] : '';
                                    $username = isset($_GET['user_name_fil']) ? $_GET['user_name_fil'] : '';
                                    $admin = isset($_GET['admin']) ? $_GET['admin'] : '';
                                    $role = isset($_GET['role']) ? $_GET['role'] : '';

                                    $limit_user = max(1, $limit);
                                    $page_user = max(1, $page);
                                    $start_user = max(0, $start);
                                    $filters_user = [];

                                    if(!empty($name))
                                    {
                                        $filters_user[] = "name='$name'";
                                        
                                    }

                                    if(!empty($userid))
                                    {
                                        $filters_user[] = "userid='$userid'";
                                        
                                    }

                                    if(!empty($username))
                                    {
                                        $filters_user[] = "username='$username'";
                                        
                                    }

                                    if(!empty($role))
                                    {
                                        if($role !== 'ALL'){

                                            $filters_user[] = "role='$role'";

                                        }
                                        
                                    }

                                    if(!empty($admin))
                                    {
                                        if($admin !== '---')
                                        {
                                            $filters_user[] = "level='$admin'";
                                        }
                                        
                                    }


                                    $where_clause = '';
                                    if(count($filters_user) > 0)
                                    {
                                        $where_clause = "WHERE " . implode(" AND ", $filters_user);
                                    }

                                    $sql = "
                                        SELECT userid,name,role,date_created
                                        FROM employees 
                                        $where_clause
                                        
                                        ORDER BY date_created DESC LIMIT $limit_user OFFSET $start_user";

                                    $result = $conn->query($sql);
                                    $data = [];

                                    if($result->num_rows > 0)
                                    {
                                        while($row = $result->fetch_assoc())
                                        {
                                            $data[] = $row;
                                            echo "<tr>
                                                <td>". $row["userid"] ." </td>
                                                <td>". $row["name"] ." </td>
                                                <td>". $row["role"] ." </td>
                                                <td>". $row["date_created"] ." </td>
                                                <td><a class='btn btn-primary' href='/RequestApp/user.php?id=". $row["userid"] ."&role=". $row["role"] ."&page=$page_user'>View</a>
                                                </td>
                                                </tr>";
                                            
                                        }
                                        $_SESSION['query_users_res'] = $data;
                                        $data = [];
                                        
                                    }else{
                                        echo "<tr>
                                                <td colspan='5' >No records found</td>
                                                </tr>";
                                        $_SESSION['query_users_res'] = [];
                                    }
                                ?>
                                
                            </tbody>
                        </table>
                        <?php
                        $sql = "SELECT COUNT(*) AS total FROM(
                        SELECT userid FROM employees $where_clause) as total_table";

                        $result = $conn->query($sql);
                        $total_records = 0;
                        while($row_count = $result->fetch_assoc())
                        {
                            if(isset($row_count['total']))
                            {
                                $total_records +=$row_count['total'];
                            }
                            
                        }

                        $total_pages = ceil($total_records/$limit_user);
                        $qpar = $_GET;
                        unset($qpar['page']);

                        $qstring = http_build_query($qpar);

                        ?>
                        <div class="pg">
                            <?php
                            if($total_pages > 1)
                            {
                                if($page_user > 1)
                                {
                                    echo "<a class='btn btn-primary' href='?page=" . ($page_user - 1) . ($qstring ? '&' . $qstring : '') . "'>Prev</a>";
                                }else{
                                    echo "<button class='btn btn-primary' disabled>Prev</button>";
                                }
                                echo "<label style='margin: 10px;'>$page_user</label>";
                                echo "<label style='margin-top: 10px;margin-bottom: 10px;margin-right: 10px;'>of $total_pages</label>";
                                if($page_user < $total_pages)
                                {
                                    echo "<a class='btn btn-primary' href='home.php?page=" . ($page_user + 1) . ($qstring ? '&' . $qstring : '') . "'>Next</a>";
                                }else{
                                    echo "<button class='btn btn-primary' disabled>Next</button>";
                                }
                            }
                            
                            ?>
                        </div>
                        <?php
                        ?>
                        <div id="space">

                        </div>
                    </div>

                    <?php
                }
            ?>

        </div>
    </div>

    <!-- <div class="layout">
        <p>
            fgsjfvksgksksk,jnslkjfh;
        </p>
    </div>

    <div class="layout">
        <p>
            124654487465464
        </p>
    </div> -->
</div>
    <script src="main.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>
</html>
<?php
}else{
    header("Location: index.php");
    exit();
}
 ?>