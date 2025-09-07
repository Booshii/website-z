<?php

?> 

<h1>Login</h1>
<form id="loginForm">
    <label for="email">Email</label>
    <input type="email" id="email" name="email" required>
    <br>
    <label for="password">Password:</label>
    <input type="password" id="password" name="password" required>
    <br>
    <button type="submit">Login</button>
</form>
<div id="message"></div>
<script src="assets/js/auth.js"></script>