<?php
echo "<h1 class='text-center'>Insert Member</h1>";
echo "<div class='container'></div>";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $name = $_POST['name'];
    $description = $_POST['description'];
    $ordering = $_POST['ordering'];
    $visibility = $_POST['visibility'];
    $commenting = $_POST['commenting'];
    $ads = $_POST['ads'];

    $formErrors = array();
    if (strlen($name) < 4)
        $formErrors[] = '<div class="alert alert-danger">Category name must be more than <strong>4 Characters</strong></div>';
    elseif (strlen($name) > 255)
        $formErrors[] = '<div class="alert alert-danger">Category name must be less than <strong>255 Characters</strong></div>';
    elseif (empty($name))
        $formErrors[] = '<div class="alert alert-danger">Category name Cant Be <strong>Empty</strong></div>';
    if (empty($description))
        $formErrors[] = '<div class="alert alert-danger">Description Cant Be <strong>Empty</strong></div>';
    if (empty($ordering))
        $formErrors[] = '<div class="alert alert-danger">Ordering Cant Be <strong>Empty</strong></div>';

    foreach ($formErrors as $error) {
        echo $error;
    }
    if (empty($formErrors)) {
        //Check user is exists
        $count = checkItem('name', 'categories', $name);
        if ($count > 0) {
            $error = 'This Category <strong>' . $name . '</strong> already exists';
            redirect2Page('Categories', 'categories.php', $error, 4);
        } else {
            $stmt = $conn->prepare("INSERT INTO categories(Name, Description,Ordering, Visibility,Allow_Comment,Allow_Ads) VALUES(:name,:description,:ordering,:visibility,:commenting,:ads)");
            if ($stmt->execute(array(
                'name' => $name,
                'description' => $description,
                'ordering' => $ordering,
                'visibility' => $visibility,
                'commenting' => $commenting,
                'ads' => $ads))) {
                echo "<div class='alert alert-success'>" . 'Successfully Insert</div>';
            } else {
                echo 'Failed Update';
            }
        }
    }

} else {
    $error = 'Some things error!';
    redirect2Page('Members', 'members.php', $error, 4);
}
echo '</div>';