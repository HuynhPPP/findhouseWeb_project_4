<?php
if (!function_exists('formatCurrency')) {
  function formatCurrency($price)
  {
    $price = floatval($price); // Chuyển về số thực
    if ($price >= 1000000) {
      $formatted = $price / 1000000; // Chuyển sang triệu
      return (fmod($formatted, 1) == 0) ? number_format($formatted, 0) . 'triệu' : number_format($formatted, 1) . ' triệu';
    }
    return number_format($price, 0, ',', '.') . ' đ';
  }
}
