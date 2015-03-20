<?php
// Add the correct Content-Type for the cache manifest
header('Content-Type: text/cache-manifest');

// Write the first line
echo "CACHE MANIFEST\n";

// Initialize the $hashes string

function create_manifest($folder) {
  $hash = ""; 
  $blacklist = [".\manifest.php","./manifest.php"];
  $dir = new RecursiveDirectoryIterator($folder);
 
    // Iterate through all the files/folders in the current directory
    foreach (new RecursiveIteratorIterator($dir) as $file) {
        //$info = pathinfo($file);

        // If the object is a file
        // and it's not called manifest.php (this file),
        // and it's not a dotfile, add it to the list
        if ($file->IsFile() && !in_array($file, $blacklist) && substr($file -> getFilename(), 0, 1) != ".") {
            // Replace spaces with %20 or it will break
                   
            echo str_replace(' ', '%20', $file) . "\n";

            // Add this file's hash to the $hashes string
            $hash = $hash.md5_file($file);
        }
    }
    
    echo "# Hash: " . md5($hash) . "\n";
    
}

create_manifest('.'); 

echo "\nNETWORK:\n";
echo "users/login\n";
echo "users/signup\n";
echo "users/profile\n";
echo "users/orders\n";
echo "users/posts\n";


echo "\nFALLBACK:\n";
echo "* ./static.html\n";
// Write the $hashes string
