<?php
session_start();
require_once('inc/header.php');
if(!isset($_SESSION['user']['id'])){
    header('Location: /index.php');
}
$id=0;
if(isset($_GET['user']) && !empty($_GET['user'])){
    $id = strip_tags($_GET['user']);
}

if(!empty($_POST)){
    if(isset($_POST['dest']) && !empty($_POST['dest']) &&
       isset($_POST['message']) && !empty($_POST['message'])){
        $id = strip_tags($_POST['dest']);
        $sql = 'INSERT INTO messages(exp_id, dest_id, message) VALUES (:exp, :dest, :message)';

        $query = $db->prepare($sql);

        $query->bindValue(':exp', $_SESSION['user']['id'], PDO::PARAM_INT);
        $query->bindValue(':dest', $id, PDO::PARAM_INT);
        $query->bindValue(':message', strip_tags($_POST['message']), PDO::PARAM_STR);

        $query->execute();

        // Attention, requête à sécuriser par un bindValue
        $query = $db->query('SELECT count(id) as nombre FROM messages WHERE dest_id = '.$id.' AND unread = 1;');

        $compte = $query->fetch();

        require_once 'inc/mercure_post.php';

        $topic = 'https://intro-mercure.test/users/message/'.$id;

        $data = [
            'sujet' => 'message',
            'exp' => $_SESSION['user']['pseudo'],
            'dest' => $id,
            'total' => $compte['nombre']
        ];

        mercurePost($topic, $data);

        header('Location: messagerie.php');
    }
}

$sql = 'SELECT * FROM users;';

$query = $db->query($sql);

$users = $query->fetchAll();

?>
<div class="col-12 my-1 d-flex justify-content-between">
    <h1>Votre message</h1>
</div>
<div class="col-12">
    <form method="post">
    <div class="form-group">
            <label for="dest">Destinataire :</label>
            <select name="dest" id="dest">
                <option value="">-- Choisissez un destinataire --</option>
                <?php foreach($users as $user): ?>
                    <option value="<?= $user['id'] ?>" <?= ($user['id'] == $id) ? 'selected' : '' ?>><?= $user['pseudo'].' - '.$user['email'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group">
            <label for="message">Message :</label>
            <textarea name="message" id="message"></textarea>
        </div>
        <button class="btn btn-primary">Envoyer</button>
    </form>
</div>
<?php
include_once('inc/footer.php');
