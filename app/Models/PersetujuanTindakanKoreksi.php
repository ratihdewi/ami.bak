<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PersetujuanTindakanKoreksi extends Model
{
    use HasFactory;

    protected $fillable = [
        'tindakankoreksi_id',
        'rencanatindakan_id',
        'tinjauanEfektivitas_id',
        'batasPengisian0',
        'batasPengisian1',
    ]

    Schema::create('persetujuan_tindakan_koreksis', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('tindakankoreksi_id');
        $table->unsignedBigInteger('rencanatindakan_id');
        $table->unsignedBigInteger('tinjauanEfektivitas_id');
        $table->String('eSign');
        $table->String('penandaTangan');
        $table->foreign('tinjauanEfektivitas_id')->references('id')->on('tinjau_efektivitas')->onUpdate('cascade')
        ->onDelete('cascade');
        $table->foreign('rencanatindakan_id')->references('id')->on('rencana_tindakans')->onUpdate('cascade')
        ->onDelete('cascade');
        $table->foreign('tindakankoreksi_id')->references('id')->on('tindakan_koreksis')->onUpdate('cascade')
        ->onDelete('cascade');
        $table->timestamps();
    });
}
