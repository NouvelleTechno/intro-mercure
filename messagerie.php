<?php
session_start();
include_once('inc/header.php');
if(!isset($_SESSION['user']['id'])){
    header('Location: /index.php');
}

$sql = 'SELECT messages.*, users.pseudo as expediteur FROM messages LEFT JOIN users ON messages.exp_id = users.id WHERE dest_id = '.$_SESSION['user']['id'].' ORDER BY messages.created_at DESC';

$query = $db->query($sql);

$messages = $query->fetchAll();
?>
<div class="col-12 my-1 d-flex justify-content-between">
    <h1>Votre messagerie</h1>
    <p><a class="btn btn-primary" href="newmessage.php">Nouveau message</a></p>
</div>
<div class="col-12">
    <table class="table">
        <thead>
            <th><i class="la la-envelope"></i></th>
            <th>De</th>
            <th>Message</th>
            <th>Date</th>
            <th>Supprimer</th>
        </thead>
        <tbody>
            <?php foreach($messages as $message): ?>
                <tr>
                    <td><?= ($message['unread']) ? '<i class="las la-envelope"></i>' : '<i class="las la-envelope-open"></i>' ?></td>
                    <td><?= $message['expediteur'] ?></td>
                    <td><?= $message['message'] ?></td>
                    <td><?= $message['created_at'] ?></td>
                    <td><a href="message.php?id=<?= $message['id'] ?>" class="btn btn-success" title="Lire"><i class="la la-search"></i></a><a href="#" class="btn btn-danger" title="supprimer"><i class="la la-minus"></i></a></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<?php
include_once('inc/footer.php');
