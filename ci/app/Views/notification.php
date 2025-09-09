
  <?php
$session = session();

$types = ['success', 'error', 'warning', 'info'];
$message = null;
$type = null;

foreach ($types as $t) {
    if ($session->getFlashdata($t)) {
        $message = $session->getFlashdata($t);
        $type = $t;
        break;
    }
}

$colors = [
    'success' => 'bg-green-100 border-green-500 text-green-700',
    'error'   => 'bg-red-100 border-red-500 text-red-700',
    'warning' => 'bg-yellow-100 border-yellow-500 text-yellow-700',
    'info'    => 'bg-blue-100 border-blue-500 text-blue-700',
];
?>

<div class="bg-gray-50 flex items-center justify-center h-80 p-4">
<?php if ($message && $type): ?>
    <div class="max-w-md w-full border-l-4 p-4 rounded shadow <?php echo $colors[$type]; ?>" role="alert">
        <p class="font-bold capitalize"><?php echo ucfirst($type); ?></p>
        <p class="mt-1"><?php echo esc($message); ?></p>
    </div>
<?php else: ?>
    <div class="text-gray-500">No notification message to display.</div>
<?php endif; ?>
</div>
