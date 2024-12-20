<?php
require_once '../signup/config_seesion.inc.php';  
require_once '../signup/dbh.inc.php'; 

if (!isset($_SESSION['user_id'])) {
    header('Location: ../signup/sign_index.php?error=unauthorized');
    exit();
}

include '../signup/header_author.php';

$query = "
 SELECT a.id, a.title, a.views_count, a.created_time, 
       COUNT(c.id) AS comment_count,
       l.number_likes
FROM article a
LEFT JOIN commentes c ON a.id = c.article_id
LEFT JOIN likes l ON a.id = l.article_id
GROUP BY a.id
ORDER BY a.created_time DESC;
";

$stmt = $pdo->prepare($query);
$stmt->execute();
$posts = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<main class="main_dash">
    <div class="table">
        <div class="table_header">
            <div class="adddd">
                <form action="creat_post.php">
                    <button class="add_new">+Add new</button>
                </form>
            </div>
        </div>

        <div class="tables_section">
            <table>
                <thead>
                    <tr>
                        <th>Arc.title</th>
                        <th>Vues</th>
                        <th>Commentaires</th>
                        <th>Likes</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($posts): ?>
                        <?php foreach ($posts as $post): ?>
                            <tr>
                                <td><?= htmlspecialchars($post['title']) ?></td>
                                <td><?= htmlspecialchars($post['views_count']) ?></td>
                                <td><?= htmlspecialchars($post['comment_count']) ?></td>
                                <td><?= htmlspecialchars($post['number_likes']) ?></td>
                                <td>
                                    <a href="view_post.php?id=<?= $post['id'] ?>">View</a> | 
                                    <a href="edit_post.php?id=<?= $post['id'] ?>">Edit</a> | 
                                    <a href="delete_post.php?id=<?= $post['id'] ?>">Delete</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr><td colspan="5">No posts found.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</main>

<?php include '../authore/footer.php'; ?>
