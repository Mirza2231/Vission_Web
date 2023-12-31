<?php
include '../_Layout/_navbar.php';

// Handle adding tasks
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['add_task']) && !empty($_POST['task'])) {
        $task = $_POST['task'];
        // Insert the task into the database
        $insertSql = "INSERT INTO tasks (task) VALUES ('$task')";
        mysqli_query($conn, $insertSql);
    }
}

// Handle marking a task as done
if (isset($_POST['mark_done']) && isset($_POST['task_id'])) {
    $taskID = $_POST['task_id'];
    // Update the task as completed in the database
    $updateSql = "UPDATE tasks SET completed = 1 WHERE id = $taskID";
    mysqli_query($conn, $updateSql);
}

// Handle deleting a task
if (isset($_POST['delete_task']) && isset($_POST['task_id'])) {
    $taskID = $_POST['task_id'];
    // Delete the task from the database
    $deleteSql = "DELETE FROM tasks WHERE id = $taskID";
    mysqli_query($conn, $deleteSql);
}

// Fetch tasks from the database
$tasks = [];
$selectSql = "SELECT * FROM tasks";
$result = mysqli_query($conn, $selectSql);
if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $tasks[] = $row;
    }
}
?>
<!-- partial -->
<div class="main-panel">
  <div class="content-wrapper">
    <div class="row">

    <div class="col-md-6 col-xl-6 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <div class="d-flex flex-row justify-content-between">
                <h4 class="card-title">Users</h4>
            </div>
            <div class="preview-list">
                <?php
                // Fetch all users
                $userSql = "SELECT id, image, username, email, created_at FROM users";
                $userResult = mysqli_query($conn, $userSql);

                if ($userResult) {
                    while ($user = mysqli_fetch_assoc($userResult)) {
                        ?>
                        <div class="preview-item border-bottom">
                            <div class="preview-thumbnail">
                                <?php
                                // Display the blob image
                                $imageData = base64_encode($user['image']);
                                echo '<img src="data:image/jpeg;base64,' . $imageData . '" alt="user-image" class="rounded-circle" />';
                                ?>
                            </div>
                            <div class="preview-item-content d-flex flex-grow">
                                <div class="flex-grow">
                                    <div class="d-flex d-md-block d-xl-flex justify-content-between">
                                        <h6 class="preview-subject"><?php echo $user['username']; ?></h6>
                                        <p class="text-muted text-small"><?php echo $user['created_at']; ?></p>
                                    </div>
                                    <p class="text-muted">Email: <?php echo $user['email']; ?></p>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                }
                ?>
            </div>
        </div>
    </div>
</div>
      <div class="col-md-12 col-xl-6 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">To do list</h4>
            <form method="POST">
              <div class="add-items d-flex">
                <input type="text" class="form-control todo-list-input" name='task' placeholder="Enter task..">
                <button type='submit' name='add_task' class="btn btn-primary">Add</button>
              </div>
            </form>
            <div class="list-wrapper">
              <ul class="d-flex flex-column-reverse text-white todo-list todo-list-custom">
                <?php foreach ($tasks as $task) : ?>
                <li>
                  <div class="d-flex justify-content-between align-items-center" style="
    width: 100%;
">
                    <div class="form-check form-check-primary" style="
    width: 100%;
    padding:0
">
                      <form method="POST" style="
    display: flex;
    justify-content: space-between;
">
                        <label class="form-check-label">
                          <?php if ($task['completed'] == 1) : ?>
                          <s>
                            <?php echo $task['task']; ?>
                          </s>
                          <?php else : ?>
                          <?php echo $task['task']; ?>
                          <?php endif; ?>
                        </label>
                        <div>
                          <?php if ($task['completed'] == 0) : ?>
                          <input type="hidden" name="task_id" value="<?php echo $task['id']; ?>">
                          <button type='submit' name='mark_done' class="btn btn-success btn-sm">Done</button>
                          <?php endif; ?>
                          <input type="hidden" name="task_id" value="<?php echo $task['id']; ?>">
                          <button type='submit' name='delete_task' class="btn btn-danger btn-sm">Delete</button>
                        </div>
                      </form>
                    </div>
                  </div>
                </li>
                <?php endforeach; ?>
              </ul>
            </div>
          </div>
        </div>
      </div>

    </div>

  </div>
  <!-- content-wrapper ends -->


  <?php 
include '../_Layout/_footer.php'
?>