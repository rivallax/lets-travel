<?php

class Flasher
{
  public static function setFlash($message, $status, $type = '')
  {
    $_SESSION['flash'] = [
      'message' => $message,
      'status' => $status,
      'type' => $type
    ];
  }

  public static function flash()
  {
    if (isset($_SESSION['flash'])) {
      echo "<div class='alert alert-" . $_SESSION['flash']['status'] . ' alert-' . $_SESSION['flash']['type'] . "' role='alert'>";
      echo "<div class='message'>";
      if ($_SESSION['flash']['type'] == 'success') {
        echo "<i class='bx bx-badge-check'></i>";
      } else {
        echo "<i class='bx bx-error-alt'></i>";
      }
      echo "<span>" . $_SESSION['flash']['message'] . "</span>";
      echo '</div>';
      echo "<span class='close close-btn'>&times;</span>";
      echo '</div>';

      unset($_SESSION['flash']);
    }
  }
}
