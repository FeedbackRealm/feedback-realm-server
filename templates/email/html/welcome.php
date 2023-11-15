<?php

use App\Model\Entity\User;
use App\View\AppView;
/**
 * @var AppView $this
 * @var User $user
 */
?>

Welcome <?=h($user->name)?>!
<br />
Thank you for signing up with FeedbackRealm.
