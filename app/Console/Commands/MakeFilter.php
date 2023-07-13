<?php

namespace App\Console\Commands;

use App\Http\Traits\NamespaceFixer;
use Illuminate\Console\Command;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class MakeFilter extends Command
{
    use NamespaceFixer;

    protected $basePath = 'App\Http\Filters';

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:filter {class : The name of the migration}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new filter class';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $filter = $this->argument('class');

        if ($filter === '' || is_null($filter) || empty($filter)) {
            $this->error('filter name invalid..!');
        }

        if (!File::exists($this->getBaseDirectory($filter))) {
            File::makeDirectory($this->getBaseDirectory($filter), 0775, true);
        }

        $title = title($filter);
        $baseName = $this->getBaseFileName($filter);

        $filterPath = 'app/Http/Filters/' . $title;
        $filePath = $filterPath . '.php';
        $filterNameSpacePath = $this->getNameSpacePath($this->getNameSpace($filterPath));

        if (!File::exists($filePath)) {
            $eloquentFileContent = "<?php\nnamespace " . $filterNameSpacePath . ";\n\nuse Closure;\nuse Illuminate\Database\Eloquent\Builder;\n\nclass " . $baseName . "\n{\n\tpublic function handle(Builder \$query, Closure \$next)\n\t{\n\t\tif (!request()->has('" . Str::snake($baseName) . "')) {\n\t\t\treturn \$next(\$query);\n\t\t}\n\t\t\$query->where('" . Str::snake($baseName) . "', 'LIKE', '%' . request('" . Str::camel($baseName) . "') . '%');\n\n\t\treturn \$next(\$query);\n\t}\n}";

            File::put($filePath, $eloquentFileContent);

            $this->info('filter created successfully...!');
        } else {
            $this->error('filter already exist...!');
        }
    }
}
