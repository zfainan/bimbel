<?php

declare(strict_types=1);

namespace App\Jobs;

use App\Models\Alumni;
use App\Models\Siswa;
use Illuminate\Bus\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class CreateAlumni
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(
        public Siswa $siswa
    ) {}

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $alumni = Alumni::firstOrNew(['id_siswa' => $this->siswa->id_siswa]);

        $alumni->fill(request()->only(['nilai_ujian', 'pendidikan_lanjutan', 'tahun_angkatan']));
        $alumni->siswa()->associate($this->siswa);

        $alumni->save();
    }
}
