<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rain Hotel <- user queries</title>
    <link rel="stylesheet" href="//cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css" />
            <?php require('inc/links.php') ?>
</head>

<body class="bg-light">
    <?php require('inc/header.php'); ?>
    <div class="container-fluid" id="main-content">
        <div class="row">
            <div class="col-lg-10 ms-auto p-4 overflow-hidden">
                <h3 class="mb-4">User Queries</h3>

                
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body">
                        <div class="text-end mb-4">
                            <a href="?seen=all" class="btn btn-dark rounded-pill shadow-none btn -sm">
                            <i class="bi bi-eye-fill me-1"></i> Mark all read</a>
                            <a href="?del=all" class="btn btn-danger rounded-pill shadow-none btn -sm">
                            <i class="bi bi-trash"></i> all delete</a>

                        </div>

                        <div class="table-responsive-md " style="height:450; overflow-y:scroll;">
                            <table class="table table-hover border">
                                <thead class="sticky-top bg-dark">
                                    <tr class=".bg-info text-light">
                                        <th scope="col">Sr No</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Email</th>
                                        <th scope="col" width="20%">Subject</th>
                                        <th scope="col" width="20%">Message</th>
                                        <th scope="col">Date</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $q = "SELECT * FROM `user_queries` ORDER BY `sr_no` DESC";
                                    $data = mysqli_query($conn,$q);
                                    $i = 1;
                                    while($row = mysqli_fetch_assoc($data))
                                    {
                                        $seen='';
                                        if($row['seen']!=1){
                                            $seen = "<a href='?seen=$row[sr_no]' class='btn btn-sm rounded-pill btn-primary'>Mark as Read</a>";
                                        }
                                        $seen.="<a href='?del=$row[sr_no]' class='btn btn-sm rounded-pill btn-danger mt-2'>Delete</a>";

                                        echo <<<query
                                            <tr>
                                            <td>$i</td>
                                            <td>$row[name]</td>
                                            <td>$row[email]</td>
                                            <td>$row[subject]</td>
                                            <td>$row[message]</td>
                                            <td>$row[date]</td>
                                            <td>$seen</td>
                                            
                                            </tr>

                                        query;
                                        $i++;
                                    }
                                    ?>
                                </tbody>

                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="//cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <?php require('inc/script.php'); ?>


</body>

</html>