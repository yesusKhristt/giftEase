<?php
function render_stars(float $rating): string
{
    $output = '';
    $totalStars = 5;

    for ($i = 1; $i <= $totalStars; $i++) {
        if ($rating >= $i) {
            $output .= '<span class="star filled">★</span>';
        } else {
            $fraction = $rating - ($i - 1);
            if ($fraction > 0) {
                $percent = (1 - $fraction) * 100;
                // Output partial star with inline style for clip-path percentage
                $output .= '<span class="star partial" style="--empty-percent: ' . $percent . '%;">★</span>';
            } else {
                $output .= '<span class="star">★</span>';
            }
        }
    }
    return $output;
}
?>