<?php
function sortLink(string $column, string $label, string $currentSort, string $currentOrder): string
{
    $order = 'asc';

    if ($currentSort === $column && $currentOrder === 'asc') {
        $order = 'desc';
    }

    return '<a href="?action=monitoring&sort=' . $column . '&order=' . $order . '">' . $label . '</a>';
}
?>


<h1>Monitoring du blog</h1>

<table>
   <thead>
<tr>
    <th><?= sortLink('title', 'Titre', $currentSort, $currentOrder) ?></th>
    <th><?= sortLink('views', 'Vues', $currentSort, $currentOrder) ?></th>
    <th><?= sortLink('comments', 'Commentaires', $currentSort, $currentOrder) ?></th>
    <th><?= sortLink('date', 'Date de publication', $currentSort, $currentOrder) ?></th>
</tr>
</thead>


    <tbody>
        <?php foreach ($articles as $article): ?>
            <tr>
                <td><?= htmlspecialchars($article['title']) ?></td>
                <td><?= (int) $article['views'] ?></td>
                <td><?= (int) $article['comment_count'] ?></td>
                <td>
                    <?= Utils::convertDateToFrenchFormat(
                        new DateTime($article['date_creation'])
                    ) ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
