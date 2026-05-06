<?php
require __DIR__.'/vendor/autoload.php';
$app = require __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\User;
use Illuminate\Support\Facades\Hash;

$user = User::where('email', 'Admin@ERPPRO.Site')
    ->orWhere('email', 'admin@erppro.site')
    ->orWhere('role', 'admin')
    ->first();
if ($user) {
    $user->password = Hash::make('admin123');
    $user->is_active = true;
    $user->save();

    echo 'Admin password reset complete.' . PHP_EOL;
    echo 'Login email: ' . $user->email . PHP_EOL;
    echo 'Login password: admin123' . PHP_EOL;
} else {
    echo 'User not found' . PHP_EOL;
}
?>
