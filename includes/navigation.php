    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index">Visit Home Page</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="#">About</a>
                    </li>
                    <li>
                        <a href="#">Services</a>
                    </li>
                    <li style="color:white;">
                <?php if(isset($_SESSION['myname'])){

                    echo "HY, " . $_SESSION['myname'];

                } ?>
                </li>
          
                    <li>
                        
                        <a href="admin/logout.php"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                    </li>
                    <li>
                    <?php 
                    include "admin/access.php";
                    
                    if(access('ADMIN', false)): ?>

                    <form method="post">
                <select>
                    <option>user</option>
                    <option>admin</option>

                </select>
                </form>
                <?php endif; ?>
                </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>