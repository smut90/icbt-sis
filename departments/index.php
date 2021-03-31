<?php
    include_once('../header.php');
    include_once('../db.php');
    include_once('../nav.php');


    $sql = "SELECT COUNT(*) FROM departments";
    $result = mysqli_query($conn, $sql);
    $r = mysqli_fetch_row($result);
    $numrows = $r[0];


    // number of rows to show per page
    $rowsperpage = 10;
    // find out total pages
    $totalpages = ceil($numrows / $rowsperpage);

    // get the current page or set a default
    if (isset($_GET['currentpage']) && is_numeric($_GET['currentpage'])) {
        // cast var as int
        $currentpage = (int) $_GET['currentpage'];
    } else {
        // default page num
        $currentpage = 1;
    } // end if

    // the offset of the list, based on current page 
    $offset = ($currentpage - 1) * $rowsperpage;


?>
<body>
    

        <div class="breadcrumbs">
            <div class="breadcrumbs-inner">
                <div class="row m-0">
                    <div class="col-sm-4">
                        <div class="page-header float-left">
                            <div class="page-title">
                                <h1>Departments</h1>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <div class="page-header float-right">
                            <div class="page-title">
                                <ol class="breadcrumb text-right">
                                    <li><a href="#">Departments</a></li>
                                    <li class="active">Index</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="content">
            <div class="animated fadeIn">


                <div class="row">
                    <div class="col-lg-12">
                        
                        <div class="card">
                            <div class="card-header">
                                <strong class="card-title">Departments Table</strong>
                            </div>
                            
                            <div class="card-body">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th scope="col">Name</th>
                                            <th scope="col">Description</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php
                                            $sql = "SELECT * FROM departments LIMIT $offset, $rowsperpage";
                                            $result = mysqli_query($conn, $sql);
                                            while ($list = mysqli_fetch_assoc($result)) {
                                        ?>

                                            <tr>
                                                <th scope="row"><?= $list['department_name']?></th>
                                                <td><?= nl2br($list['department_description']) ?></td>
                                                <td>
                                                    <a title="View Information" href="view?view&id=<?= $list['department_id'] ?>" class="btn btn-info btn-sm ">View <span class="fa fa-info-circle fw-fa"></span></a>
                                                </td>
                                            </tr>

                                        <?php } ?>

                                    </tbody>
                                </table>

                                <label for="">Showing <?= $offset+1?> to <?= $rowsperpage?> of <?= $numrows?> entries</label>

                                <nav class="pagination">
                                    <ul class="crumbs">
                                     
                                    <?php
                                        
                                        // range of num links to show
                                        $range = 3;
                                        // if not on page 1, don't show back links
                                        if ($currentpage > 1) {
                                            // show << link to go back to page 1
                                            //echo " <a href='{$_SERVER['PHP_SELF']}?currentpage=1'><<</a> ";
                                            // get previous page num
                                            $prevpage = $currentpage - 1;
                                            // show < link to go back to 1 page
                                            echo "<li><a class='crumb crumb__prev' href='{$_SERVER['PHP_SELF']}?currentpage=$prevpage'>Previous</a></li>";
                                        } // end if 
 
                                        // loop to show links to range of pages around current page
                                        for ($x = ($currentpage - $range); $x < (($currentpage + $range) + 1); $x++) {
                                            // if it's a valid page number...
                                            if (($x > 0) && ($x <= $totalpages)) {
                                            // if we're on current page...
                                            if ($x == $currentpage) {
                                                // 'highlight' it but don't make a link
                                                echo " [<b>$x</b>] ";
                                            // if not current page...
                                            } else {
                                                // make it a link
                                                echo "<li><a class='crumb crumb__active' href='{$_SERVER['PHP_SELF']}?currentpage=$x'>$x</a></li>";
                                            } // end else
                                            } // end if 
                                        } // end for
                  
                                        // if not on last page, show forward and last page links        
                                        if ($currentpage != $totalpages) {
                                            // get next page
                                            $nextpage = $currentpage + 1;
                                            // echo forward link for next page 
                                            echo "<li><a class='crumb crumb__next' href='{$_SERVER['PHP_SELF']}?currentpage=$nextpage'>Next</a></li>";
                                            // echo forward link for lastpage
                                            //echo " <a href='{$_SERVER['PHP_SELF']}?currentpage=$totalpages'>>></a> ";
                                        } // end if
                                        /****** end build pagination links ******/
                                                
                                    ?>
                                    </ul>

                                </nav>
                                
                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>

    <div class="clearfix"></div>

    <?php include_once('../footer-2.php') ?>

</div><!-- /#right-panel -->

<!-- Right Panel -->

<?php include_once('../footer.php') ?>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/font-awesome@4.7.0/css/font-awesome.min.css">
        <link rel='stylesheet' type='text/css' href="https://bitnami-mx-kdbnbjq.el.r.appspot.com/assets/css/style.css">

        <script type="text/javascript" src="/assets/js/jquery.min.js"></script>

<!--<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>-->


<style>


.pagination {
  display: flex;
  padding: 1rem;
  background-color: #f5f5f5;
  width: fit-content;
  border-radius: 0.25rem;
  float: right;
}

.crumbs {
  display: flex;
  flex-wrap: wrap;
  justify-content: center;
  align-items: center;
  list-style-type: none;
  margin: 0;
  padding: 0;
  gap: 0.5rem;
}

.crumb {
  display: block;
  padding: 0.5rem 1rem;
  text-decoration: none;
  color: currentColor;
  border-radius: 0.2rem;
  border: 0.0625rem solid #d7d7d7; /* 1px */
}

.crumb:hover, .crumb__active {
  background-color: #1d1f20;
  color: #fdfdfd;
  border-color: #1d1f20;
}

.crumb__prev { margin-right: 0.5rem; cursor: w-resize; }
.crumb__next { margin-left: 0.5rem; cursor: e-resize; }
</style>



</body>
</html>
