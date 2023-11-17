<?php
/**
 * @var AppView $this
 */

use App\View\AppView;

?>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container px-5">
        <a class="navbar-brand" href="/">FeedbackForge</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span
                class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mb-2 mb-lg-0">
                <?php if ($this->Identity->isLoggedIn()) : ?>
                    <li class="nav-item"><a class="nav-link" href="/users">Users</a></li>
                    <li class="nav-item"><a class="nav-link" href="/notifications">Notifications</a></li>
                    <li class="nav-item"><a class="nav-link" href="/apps">Apps</a></li>
                    <li class="nav-item"><a class="nav-link" href="/app-users">App Users</a></li>
                    <li class="nav-item"><a class="nav-link" href="/feedbacks">Feedbacks</a></li>
                    <li class="nav-item"><a class="nav-link" href="/app_members">AppMember</a></li>
                    <li class="nav-item"><a class="nav-link" href="/auth/logout">Log Out</a></li>
                <?php else : ?>
                    <li class="nav-item"><a class="nav-link" href="/auth/login">Log In</a></li>
                    <li class="nav-item"><a class="nav-link" href="/auth/register">Register</a></li>
                <?php endif; ?>

            </ul>
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item"><a class="nav-link" href="/">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="/about">About</a></li>
                <li class="nav-item"><a class="nav-link" href="/contact">Contact</a></li>
                <li class="nav-item"><a class="nav-link" href="/pricing">Pricing</a></li>
                <li class="nav-item"><a class="nav-link" href="/faq">FAQ</a></li>
                <li class="nav-item"><a class="nav-link" href="/blog">Blog</a></li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdownPortfolio" href="#" role="button"
                       data-bs-toggle="dropdown" aria-expanded="false">Portfolio</a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownPortfolio">
                        <li><a class="dropdown-item" href="portfolio-overview.html">Portfolio Overview</a></li>
                        <li><a class="dropdown-item" href="portfolio-item.html">Portfolio Item</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>
