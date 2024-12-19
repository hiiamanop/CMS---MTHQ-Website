<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    use HasFactory;

    // Nama tabel yang digunakan
    protected $table = 'sections';

    // Kolom yang dapat diisi
    protected $fillable = [
        'item',
        'section',
    ];

    public function berandas()
    {
        return $this->hasMany(Beranda::class, 'section_id', 'id');
    }

    public function kegiatan_santris()
    {
        return $this->hasMany(KegiatanSantri::class, 'section_id', 'id');
    }

    public function mhtq_duas()
    {
        return $this->hasMany(MhtqDua::class, 'section_id', 'id');
    }

    public function detail_beritas()
    {
        return $this->hasMany(DetailBerita::class, 'section_id', 'id');
    }

    public function galeris()
    {
        return $this->hasMany(Galeri::class, 'section_id', 'id');
    }

    public function kalender_akademiks()
    {
        return $this->hasMany(KalenderAkademik::class, 'section_id', 'id');
    }
    
    public function kontaks()
    {
        return $this->hasMany(Kontak::class, 'section_id', 'id');
    }

    public function list_beritas()
    {
        return $this->hasMany(ListBerita::class, 'section_id', 'id');
    }

    public function mhtq_fasilitass()
    {
        return $this->hasMany(MhtqFasilitas::class, 'section_id', 'id');
    }

    public function mhtq_keunggulans()
    {
        return $this->hasMany(MhtqKeunggulan::class, 'section_id', 'id');
    }

    public function program_bahasas()
    {
        return $this->hasMany(ProgramBahasa::class, 'section_id', 'id');
    }

    public function program_keamanans()
    {
        return $this->hasMany(ProgramKeamanan::class, 'section_id', 'id');
    }

    public function program_kesehatans()
    {
        return $this->hasMany(ProgramKesehatan::class, 'section_id', 'id');
    }

    public function program_olahragas()
    {
        return $this->hasMany(ProgramOlahraga::class, 'section_id', 'id');
    }
    
    public function program_Pengasuhans()
    {
        return $this->hasMany(ProgramPengasuhan::class, 'section_id', 'id');
    }

    public function program_Tahfidzs()
    {
        return $this->hasMany(ProgramTahfidz::class, 'section_id', 'id');
    }

    public function program_Talims()
    {
        return $this->hasMany(ProgramTalim::class, 'section_id', 'id');
    }

    public function program_Ubudiyahs()
    {
        return $this->hasMany(ProgramUbudiyah::class, 'section_id', 'id');
    }

    public function program_Wirausahas()
    {
        return $this->hasMany(ProgramWirausaha::class, 'section_id', 'id');
    }

    public function TentangMhtqPendiris()
    {
        return $this->hasMany(TentangMhtqPendiri::class, 'section_id', 'id');
    }

    public function TentangMhtqPimpinans()
    {
        return $this->hasMany(TentangMhtqPimpinan::class, 'section_id', 'id');
    }
    
    public function TentangMhtqProfiles()
    {
        return $this->hasMany(TentangMhtqProfile::class, 'section_id', 'id');
    }
}
