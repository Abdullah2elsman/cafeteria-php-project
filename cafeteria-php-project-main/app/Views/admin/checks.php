<?php include __DIR__ . '/../inc/header.php'; ?>

<div class="container mt-4">

<h3 class="mb-4">Checks</h3>

<form method="GET" class="row mb-4">

    <div class="col-md-3">
        <input type="date" name="from" class="form-control" value="<?= $data['from'] ?? '' ?>">
    </div>

    <div class="col-md-3">
        <input type="date" name="to" class="form-control" value="<?= $data['to'] ?? '' ?>">
    </div>

    <div class="col-md-3">
        <select name="user_id" class="form-control">
            <option value="">All Users</option>

            <?php foreach($data['users'] as $user): ?>
                <option value="<?= $user['id'] ?>"
                    <?= ($data['user_id'] == $user['id']) ? 'selected' : '' ?>>
                    <?= $user['name'] ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="col-md-3">
        <button class="btn btn-primary w-100">Filter</button>
    </div>

</form>

<table class="table table-bordered table-hover">

<tr class="table-dark">
    <th>User</th>
    <th>Total</th>
</tr>

<?php foreach($data['checks'] as $row): ?>

<tr onclick="toggleOrders(<?= $row['id'] ?>)" style="cursor:pointer;">
    <td><?= $row['name'] ?></td>
    <td><?= $row['total'] ?> EGP</td>
</tr>

<tr id="orders-<?= $row['id'] ?>" style="display:none;">
<td colspan="2">

    <?php if(!empty($row['orders'])): ?>

        <?php foreach($row['orders'] as $order): ?>

            <div class="card mb-2 p-2">

                <b>Order #<?= $order['id'] ?></b><br>

                Total: <?= $order['total_amount'] ?> EGP<br>

                Date: <?= $order['created_at'] ?>

            </div>

        <?php endforeach; ?>

    <?php else: ?>

        <p>No orders found</p>

    <?php endif; ?>

</td>
</tr>

<?php endforeach; ?>

</table>

</div>

<script>
function toggleOrders(userId) {
    let row = document.getElementById("orders-" + userId);

    if (row.style.display === "none") {
        row.style.display = "table-row";
    } else {
        row.style.display = "none";
    }
}
</script>

<?php include __DIR__ . '/../inc/footer.php'; ?>