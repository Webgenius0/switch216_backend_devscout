<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class MakeService extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:service {name : The name of the service class, including optional subfolders}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new service class with standard methods and try-catch blocks';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $name = $this->argument('name');

        // Extract subdirectories and class name
        $pathParts = explode('/', $name);
        $className = array_pop($pathParts);
        $namespace = implode('\\', $pathParts);

        $directory = app_path('Services/' . implode('/', $pathParts));
        $filePath = $directory . '/' . $className . '.php';

        // Ensure the directory exists
        if (!File::exists($directory)) {
            File::makeDirectory($directory, 0755, true);
            $this->info('Services directory created.');
        }

        // Check if the file already exists
        if (File::exists($filePath)) {
            $this->error("Service {$className} already exists!");
            return Command::FAILURE;
        }

        // Generate the service class content with methods and try-catch blocks
        $namespaceDeclaration = 'App\\Services' . ($namespace ? "\\{$namespace}" : '');
        $content = <<<EOT
<?php

namespace {$namespaceDeclaration};

use Exception;

class {$className}
{
    /**
     * Fetch all resources.
     *
     * @return mixed
     */
    public function index()
    {
        try {
            // Logic to fetch all resources
        } catch (Exception \$e) {
            throw \$e;
             
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return void
     */
    public function create()
    {
        try {
            // Logic for create form
        } catch (Exception \$e) {
            throw \$e;
        }
    }

    /**
     * Store a new resource.
     *
     * @param array \$data
     * @return mixed
     */
    public function store(array \$data)
    {
        try {
            // Logic to store a new resource
        } catch (Exception \$e) {
            throw \$e;
        }
    }

    /**
     * Display a specific resource.
     *
     * @param int \$id
     * @return mixed
     */
    public function show(int \$id)
    {
        try {
            // Logic to show a specific resource
        } catch (Exception \$e) {
            throw \$e;
        }
    }

    /**
     * Show the form for editing a resource.
     *
     * @param int \$id
     * @return void
     */
    public function edit(int \$id)
    {
        try {
            // Logic for edit form
        } catch (Exception \$e) {
            throw \$e;
        }
    }

    /**
     * Update a specific resource.
     *
     * @param int \$id
     * @param array \$data
     * @return mixed
     */
    public function update(int \$id, array \$data)
    {
        try {
            // Logic to update a specific resource
        } catch (Exception \$e) {
            throw \$e;
        }
    }

    /**
     * Delete a specific resource.
     *
     * @param int \$id
     * @return bool
     */
    public function destroy(int \$id)
    {
        try {
            // Logic to delete a specific resource
        } catch (Exception \$e) {
            throw \$e;
        }
    }

}
EOT;

        // Create the file
        File::put($filePath, $content);

        $this->info("Service {$className} created successfully in namespace {$namespaceDeclaration}!");
        return Command::SUCCESS;
    }
}
