<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use File;

class CreateLangFile extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:lang {locale}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new language file with default validation messages';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $locale = $this->argument('locale');
        $path = resource_path("lang/$locale");

        // Buat folder jika belum ada
        if (!File::exists($path)) {
            File::makeDirectory($path, 0755, true);
        }

        // Buat file validation.php
        $filePath = $path . '/validation.php';
        if (!File::exists($filePath)) {
            $deafultMessages = "<?php\n\nreturn [\n";
            $deafultMessages .= " 'required' => 'Kolom :attribute harus diisi.',\n";
            $deafultMessages .= " 'mimes' => 'Kolom :attribute harus berupa file dengan jenis: :values.',\n";
            $deafultMessages .= " 'max' => [\n";
            $deafultMessages .= " 'file' => 'Kolom :atrribute tidak boleh lebih dari :max kilobyte.',\n";
            $deafultMessages .= " ],\n";
            $deafultMessages .= " ];\n";

            File::put($filePath, $deafultMessages);
            $this->info("File bahasa '{$locale}/validation.php' telah dibuat.");
        } else {
            $this->warn("File '{$locale}/validation.php' sudah ada.");
        }
    }
}
