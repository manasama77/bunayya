<?php
session_start();
if (!(isset($_SESSION['nis']))) {

	// remove all session varibles
	session_unset();
	// destroy the session
	session_destroy();
	header("Location: login?state=expired");
}
