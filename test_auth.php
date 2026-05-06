<?php
require __DIR__.'/vendor/autoload.php';
$app = require __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Contracts\Auth\StatefulGuard;

$user = User::where('email', 'Admin@ERPPRO.Site')->first();
if (!$user) {
    echo "User not found" . PHP_EOL;
    exit;
}

echo "User found: " . $user->email . PHP_EOL;
echo "Is active: " . ($user->is_active ? 'yes' : 'no') . PHP_EOL;

// Check password
if (Hash::check('admin123', $user->password)) {
    echo "Password is correct" . PHP_EOL;
} else {
    echo "Password is incorrect" . PHP_EOL;
}

// Try to authenticate using Laravel's auth
/** @var StatefulGuard $auth */
$auth = $app->make('auth')->guard();
$auth->logout(); // Ensure we are not already logged in

$credentials = [
    'email' => 'Admin@ERPPRO.Site',
    'password' => 'admin123',
];

if ($auth->attempt($credentials)) {
    echo "Authentication successful" . PHP_EOL;
    echo "User: " . $auth->user()->email . PHP_EOL;
    $auth->logout();
} else {
    echo "Authentication failed" . PHP_EOL;
}
?>