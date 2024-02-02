<?php
$title = 'Message' . (isset($data['receiver']) ? ' avec ' . $data['receiver']->username : '');
view('Part/header', ['title' => $title]);
?>


<div id="main">
    <div id="messageWith">
        <h2>
            Commencez à parler avec :
        </h2>
        <ul>
            <?php foreach ($data['canspeakWith'] as $user) : ?>
                <li><a href="?receiver=<?= $user->username ?>"><?= $user->username ?></a></li>
            <?php endforeach; ?>
        </ul>
        <h2>Continuez avec :</h2>
        <ul>
            <?php foreach ($data['speakingWith'] as $user) : ?>
                <li><a href="?receiver=<?= $user->username ?>"><?= $user->username ?></a></li>
            <?php endforeach; ?>
        </ul>

    </div>
    <div id="messages">
        <?php if (isset($data['receiver'])) : ?>
            <h2>Messages</h2>
            <div id="messagesContainer">
                <?php
                $currentUser = $data['currentUser'];
                foreach ($data['messages'] as $message) :
                    $side = $message->sender_id == $currentUser->id ? 'messageSideRight' : 'messageSideLeft';
                ?>
                    <div class="message <?= $side ?>">
                        <p><?= $message->message ?></p>
                    </div>
                <?php endforeach; ?>
            </div>
            <form method="post">
                <input type="hidden" name="receiver_id" value="<?= $data['receiver']->id ?>">
                <input type="text" name="content">
                <input type="submit" value="Envoyer">
            </form>
        <?php endif; ?>


    </div>

</div>

<?php
view('Part/footer');
?>