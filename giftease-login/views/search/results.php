<?php if (!empty($results)) : ?>
    <ul class="search-results">
        <?php foreach ($results as $row) : ?>
            <li class="search-result-item">
                <?php
                    $display = '';
                    $icon = '📄';
                    
                    if (isset($row['type']) && $row['type'] === 'page_content') {
                        $display = htmlspecialchars($row['text']);
                        if (stripos($row['text'], 'welcome') !== false) $icon = '👋';
                        elseif (stripos($row['text'], 'order') !== false) $icon = '📦';
                        elseif (stripos($row['text'], 'delivery') !== false) $icon = '🚚';
                        elseif (stripos($row['text'], 'ready') !== false) $icon = '✅';
                        elseif (is_numeric($row['text'])) $icon = '📊';
                        elseif (stripos($row['text'], 'rating') !== false) $icon = '⭐';
                    }
                    
                    echo '<span class="result-icon">' . $icon . '</span> ' . $display;
                ?>
            </li>
        <?php endforeach; ?>
    </ul>
<?php else : ?>
    <div class="search-no-results">No matching results</div>
<?php endif; ?>



