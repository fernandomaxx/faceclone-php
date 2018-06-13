<?php
  session_start();

  // destroy all sessions
  session_destroy();

  header('Location: ../index.php');