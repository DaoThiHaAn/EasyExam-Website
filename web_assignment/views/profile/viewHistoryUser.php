<?php
include __DIR__.'/../../models/getHistoryUser.php';
?>

<h2 class="text-center mt-5 mb-4" style="color: #5D5A88">📚 Test History</h2>

<?php if (empty($history)): ?>
    <div class="alert alert-info text-center">
        You haven't taken any tests yet!
    </div>
<?php else: ?>
    <div class="container px-0">
        <div class="card shadow-sm border-0">
            <div class="card-body table-responsive">
                <table class="table table-striped table-bordered table-hover text-center align-middle">
                    <thead class="table-header">
                        <tr>
                            <th></th>
                            <th scope="col">Test Name</th>
                            <th scope="col">Category</th>
                            <th scope="col">Start Time</th>
                            <th scope="col">Total Questions</th>
                            <th scope="col">Point</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $i = $offset + 1; // Adjust numbering based on the current page
                        foreach ($history as $entry): ?>
                            <tr>
                                <td><?= $i++ ?></td>
                                <td><?= htmlspecialchars($entry['test_name']) ?></td>
                                <td><?= htmlspecialchars($entry['test_category']) ?></td>
                                <td><?= date("d/m/Y H:i", strtotime($entry['start_time'])) ?></td>
                                <td><?= $entry['total_questions'] ?></td>
                                <td>
                                    <?php if (is_null($entry['score'])): ?>
                                        <span class="badge bg-warning text-dark">Not Graded</span>
                                    <?php else: ?>
                                        <span class="badge bg-success">
                                            <?= $entry['score'] ?>/<?= $entry['total_questions'] ?>
                                        </span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <a href="index.php?page=result&result_id=<?= $entry['result_id'] ?>" class="btn view-btn" title="View Result">
                                        <i class="far fa-eye"></i> View
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Pagination -->
    <section>
        <ul class="pagination justify-content-center mt-4">
            <?php if ($page > 1): ?>
                <li class="page-item">
                    <a class="page-link" href="index.php?page=viewHistoryUser&page_num=<?= $page - 1 ?>">Previous</a>
                </li>
            <?php endif; ?>

            <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                <li class="page-item <?= ($i == $page) ? 'active' : '' ?>">
                    <a class="page-link" href="index.php?page=viewHistoryUser&page_num=<?= $i ?>"><?= $i ?></a>
                </li>
            <?php endfor; ?>

            <?php if ($page < $totalPages): ?>
                <li class="page-item">
                    <a class="page-link" href="index.php?page=viewHistoryUser&page_num=<?= $page + 1 ?>">Next</a>
                </li>
            <?php endif; ?>
        </ul>
    </section>
<?php endif; ?>


