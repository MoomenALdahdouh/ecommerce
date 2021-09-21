<!--Dashboard page it's the main page for admin after login to manage the site -->
<?php
session_start();//It's like share preference in android to save the user login or any other data
$pageTitle = 'Dashboard';
if (isset($_SESSION['GroupID'])) {
    $groupID = $_SESSION['GroupID'];
    if ($groupID == 1) { //Check If the admin login in or not if is login so continue to next page
        include 'init.php'; ?>
        <div class="dashboard text-center">
            <h2>Dashboard</h2>
            <div class="analysis container">
                <div class="row">
                    <div class="col-sm-6 col-md-6 col-lg-3">
                        <a class="link" href="members.php">
                            <div>
                                <div class="blueCard card-body">
                                    <h1><?php echo getRowsCount('UserID', 'users') ?></h1>
                                    <h6>Total Members</h6>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-sm-6 col-md-6 col-lg-3">
                        <div>
                            <div class="redCard card-body">
                                <h1><?php echo getRowsCountWhere('UserID', 'users', 'RegStatus', '0') ?></h1>
                                <h6>Pending Members</h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-6 col-lg-3">
                        <div>
                            <div class="greenCard card-body">
                                <h1><?php echo getRowsCount('UserID', 'users') ?></h1>
                                <h6>Total Items</h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-6 col-lg-3">
                        <div>
                            <div class="orangeCard card-body">
                                <h1><?php echo getRowsCount('UserID', 'users') ?></h1>
                                <h6>Total Comments</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="latest container">
            <div class="row">
                <div class="col-sm-6 col-md-6 col-lg-6">
                    <?php $limitUser = 5; ?>
                    <div class="card-header">
                        Latest <strong><?php echo $limitUser; ?></strong> Registered Users
                    </div>
                    <div class="card-body">
                        <ul class="list-unstyled">
                            <?php
                            $getLatestUser = getData("*", "users", "UserID", "DESC", $limitUser);
                            foreach ($getLatestUser as $user) {
                                echo '<li>' . $user['Username'];
                                echo '<a class="btn btn-success float-end" href="members.php?page=Edit&userid=' . $user['UserID'] . '">Edit</a>';
                                if ($user['RegStatus'] == 0) {
                                    echo '<a class="btn btn-info float-end" href="members.php?page=Activate&userid=' . $user['UserID'] . '">Activate</a>';
                                }
                                echo '</li>';
                            }
                            ?>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-6 col-md-6 col-lg-6">
                    <div class="card-header">
                        Latest Items
                    </div>
                    <div class="card-body">
                        <ul class="list-unstyled">
                            <?php
                            $getLatestUser = getData("*", "users", "UserID", "DESC", $limitUser);
                            foreach ($getLatestUser as $user) {
                                echo '<li>' . $user['Username'] . '<span class="btn btn-success float-end">Edit</span>' . '</li>';
                            }
                            ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
        </div>
        <?php
    } else {
        //echo 'You are not Authorized to view this page';
        header('location:login.php');
        exit();
    }
} else
    header('Location: login.php');