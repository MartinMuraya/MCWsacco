<?php
$files = glob(__DIR__ . '/app/Models/*.php');
foreach($files as $file) {
    $content = file_get_contents($file);
    if (strpos($content, 'protected $guarded') === false) {
        $content = preg_replace('/(use HasFactory;)/', "$1\n\n    protected \$guarded = [];", $content);
        file_put_contents($file, $content);
        echo "Updated " . basename($file) . "\n";
    }
}
