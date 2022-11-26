<a href="index.php?pg=signup" class="btn btn-sm btn-primary mb-3 float-end">
  <i class="fa fa-plus me-2"></i>User Account Create</a>
<table class="table table-hovered">
  <?php
  if (!empty($users)) :
  ?>
    <tr>
      <th>#</th>
      <th>Username</th>
      <th>Email</th>
      <th>Gender</th>
      <th>Image</th>
      <th>Role</th>
      <th>Date</th>
      <th>Action</th>
    </tr>
    <?php
    $id = 1;
    foreach ($users as $user) :
    ?>
      <tr>
        <td><?php echo $id; ?></td>
        <td>
          <a href="index.php?pg=profile&id=<?php echo $user['id']; ?>">
            <?php echo esc($user['username']); ?>
          </a>
        </td>
        <td><?php echo esc($user['email']); ?></td>
        <td><?php echo esc($user['gender']); ?></td>
        <td>
          <a href="index.php?pg=profile&id=<?php echo $user['id']; ?>">
            <img src="<?= crop($user['image'], 400, $user['gender']); ?>" width="80" alt="User-Image"></a>
        </td>
        <td class="text-primary"><?php echo esc($user['role']); ?></td>
        <td><?php echo date("jS M, Y", strtotime($user['date'])); ?></td>
        <td>
          <a href="index.php?pg=user-edit&id=<?= $user['id']; ?>" class="btn btn-sm btn-warning">Edit</a>
          <a href="index.php?pg=user-delete&id=<?= $user['id']; ?>" class="btn btn-danger btn-sm">Delete</a>
        </td>
      </tr>
    <?php
      $id++;
    endforeach;
  else :
    ?>
    <div class="alert alert-danger text-center">
      <h3>Nothing to show User!</h3>
    </div>
  <?php
  endif;
  ?>
</table>